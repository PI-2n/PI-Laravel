<script setup>
import { useAuthStore } from '../stores/auth';
import { useRouter } from 'vue-router';
import { computed, ref } from 'vue';

import { useCartStore } from '../stores/cart';
import { useRole } from '../composables/useRole';

const authStore = useAuthStore();
const cartStore = useCartStore();
const router = useRouter();
const { can } = useRole();

const searchQuery = ref('');

const handleSearch = () => {
    if (searchQuery.value.trim()) {
        router.push({ name: 'products', query: { q: searchQuery.value } });
        searchQuery.value = '';
    }
};

</script>

<template>
    <div class="header_image">
        <RouterLink to="/">
            <img src="/images/logo.png" alt="Logo" />
        </RouterLink>
    </div>

    <div class="header_searchBar">
        <form class="search-form" @submit.prevent="handleSearch">
            <input id="q" class="search-input" v-model="searchQuery" type="search" placeholder="Buscar..." required />
            <button class="search-btn" type="submit">
                <img src="/images/icons/lupa.png" alt="Buscar" />
            </button>
        </form>
    </div>

    <div class="header_btn-container">
        <div class="platform-btn-container">
            <RouterLink to="/products?platform=steam"><img src="/images/icons/steam.png" alt="Steam"
                    class="platform-btn" /></RouterLink>
            <RouterLink to="/products?platform=playstation"><img src="/images/icons/ps.png" alt="PlayStation"
                    class="platform-btn" /></RouterLink>
            <RouterLink to="/products?platform=xbox"><img src="/images/icons/xbox.png" alt="Xbox"
                    class="platform-btn" />
            </RouterLink>
            <RouterLink to="/products?platform=switch"><img src="/images/icons/switch.png" alt="Nintendo Switch"
                    class="platform-btn" /></RouterLink>
            <RouterLink to="/products?platform=software"><img src="/images/icons/pc.png" alt="PC Software"
                    class="platform-btn" /></RouterLink>
        </div>
        <div class="separator"></div>
        <div class="user-btn-container">
            <template v-if="authStore.isAuthenticated">
                <RouterLink to="/profile" custom v-slot="{ href, navigate, isActive: isRouterActive }">
                    <a :href="href" @click="navigate">
                        <img src="/images/icons/user.png" alt="Usuario" class="user-btn"
                            :class="{ 'is-active': isRouterActive }" />
                    </a>
                </RouterLink>
            </template>
            <template v-else>
                <RouterLink to="/login" custom v-slot="{ href, navigate, isActive: isRouterActive }">
                    <a :href="href" @click="navigate">
                        <img src="/images/icons/user.png" alt="Usuario" class="user-btn"
                            :class="{ 'is-active': isRouterActive }" />
                    </a>
                </RouterLink>
            </template>

            <RouterLink to="/cart" custom v-slot="{ href, navigate, isActive: isRouterActive }">
                <a :href="href" @click="navigate" class="cart-btn-wrapper" :class="{ 'is-active': isRouterActive }">
                    <img src="/images/icons/carrito.png" alt="Carrito" class="user-btn" />
                    <span v-if="cartStore.cartCount > 0" class="cart-badge">{{ cartStore.cartCount }}</span>
                </a>
            </RouterLink>
        </div>
    </div>

    <div class="platform-btn-mobile">
        <RouterLink to="/products?platform=steam"><img src="/images/icons/steam.png" alt="Steam" class="platform-btn" />
        </RouterLink>
        <RouterLink to="/products?platform=playstation"><img src="/images/icons/ps.png" alt="PlayStation"
                class="platform-btn" /></RouterLink>
        <RouterLink to="/products?platform=xbox"><img src="/images/icons/xbox.png" alt="Xbox" class="platform-btn" />
        </RouterLink>
        <RouterLink to="/products?platform=switch"><img src="/images/icons/switch.png" alt="Nintendo Switch"
                class="platform-btn" /></RouterLink>
        <RouterLink to="/products?platform=software"><img src="/images/icons/pc.png" alt="PC Software"
                class="platform-btn" />
        </RouterLink>
    </div>
</template>
