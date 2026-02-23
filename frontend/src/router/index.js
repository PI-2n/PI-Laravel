import { createRouter, createWebHistory } from 'vue-router'
import { useAuthStore } from '../stores/auth'
import HomeView from '../views/HomeView.vue'

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        {
            path: '/',
            name: 'home',
            component: HomeView
        },
        {
            path: '/login',
            name: 'login',
            component: () => import('../views/LoginView.vue'),
            meta: { requiresGuest: true }
        },
        {
            path: '/register',
            name: 'register',
            component: () => import('../views/RegisterView.vue'),
            meta: { requiresGuest: true }
        },
        {
            path: '/products',
            name: 'products',
            component: () => import('../views/ProductsView.vue'),
            beforeEnter: (to, from, next) => {
                if (Object.keys(to.query).length === 0 || (!to.query.platform && !to.query.q)) {
                    next({ name: 'home' });
                } else {
                    next();
                }
            }
        },
        {
            path: '/products/:id',
            name: 'product-detail',
            component: () => import('../views/ProductDetailView.vue')
        },
        {
            path: '/products/create',
            name: 'product-create',
            component: () => import('../views/ProductForm.vue'),
            meta: { requiresAuth: true, roles: ['admin'] }
        },
        {
            path: '/products/:id/edit',
            name: 'product-edit',
            component: () => import('../views/ProductForm.vue'),
            meta: { requiresAuth: true, roles: ['admin'] }
        },
        {
            path: '/forbidden',
            name: 'forbidden',
            component: () => import('../views/HomeView.vue'),
        },
        {
            path: '/cart',
            name: 'cart',
            component: () => import('../views/CartView.vue'),
            meta: { requiresAuth: true }
        },
        {
            path: '/checkout',
            name: 'checkout',
            component: () => import('../views/CheckoutView.vue'),
            meta: { requiresAuth: true }
        },
        {
            path: '/checkout/success/:id',
            name: 'checkout-success',
            component: () => import('../views/SuccessView.vue'),
            meta: { requiresAuth: true }
        },
        {
            path: '/profile',
            name: 'profile',
            component: () => import('../views/ProfileView.vue'),
            meta: { requiresAuth: true }
        },
        {
            path: '/profile/library',
            name: 'library',
            component: () => import('../views/LibraryView.vue'),
            meta: { requiresAuth: true }
        },
        {
            path: '/auth/callback',
            name: 'auth-callback',
            component: () => import('../views/AuthCallback.vue')
        }
    ]
})

router.beforeEach(async (to, from, next) => {
    const authStore = useAuthStore()

    if (authStore.token && !authStore.user) {
        await authStore.fetchUser()
    }

    if (to.meta.requiresAuth && !authStore.isAuthenticated) {
        next({ name: 'login' })
        return
    }

    if (to.meta.requiresGuest && authStore.isAuthenticated) {
        next({ name: 'home' })
        return
    }

    if (to.meta.roles) {
        const roleId = authStore.user?.role_id;
        let userRole = 'user';

        switch (roleId) {
            case 1: userRole = 'admin'; break;
            case 2: userRole = 'editor'; break;
            case 3: userRole = 'user'; break;
            case 4: userRole = 'vendor'; break;
            default: userRole = 'guest';
        }

        if (!authStore.user || !to.meta.roles.includes(userRole)) {
            next({ name: 'forbidden' });
            return;
        }
    }

    next()
})

export default router
