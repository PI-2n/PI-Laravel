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
                // If accessing /products directly without query params, redirect to home
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
            component: () => import('../views/HomeView.vue'), // Temporary placeholder
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
        }
    ]
})

router.beforeEach(async (to, from, next) => {
    const authStore = useAuthStore()

    // Refresh user if token exists but user is null
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

    // Role check
    if (to.meta.roles) {
        const userRole = authStore.user?.role_id === 1 ? 'admin' : 'user';
        if (!authStore.user || !to.meta.roles.includes(userRole)) {
            next({ name: 'home' }) // Redirect to home, forbidden page is placeholder
            return
        }
    }

    next()
})

export default router
