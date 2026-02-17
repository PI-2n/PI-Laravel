<script setup>
import { useAuthStore } from '../stores/auth';
import { useRouter } from 'vue-router';
import { computed } from 'vue';

import { useCartStore } from '../stores/cart';

const authStore = useAuthStore();
const cartStore = useCartStore();
const router = useRouter();

</script>

<template>
    <!-- Navbar content -->
    <!-- Header Image / Logo -->
    <div class="header_image">
        <RouterLink to="/">
            <img src="/images/logo.png" alt="Logo" />
        </RouterLink>
    </div>

    <!-- Search Bar -->
    <div class="header_searchBar">
        <form class="search-form" action="#" method="get" role="search">
            <input id="q" class="search-input" name="q" type="search" placeholder="Buscar..." required />
            <button class="search-btn" type="submit">
                <img src="/images/icons/lupa.png" alt="Buscar" />
            </button>
        </form>
    </div>

    <!-- Buttons Container -->
    <div class="header_btn-container">
        <div class="platform-btn-container">
            <a href="#"><img src="/images/icons/steam.png" alt="Steam" class="platform-btn" /></a>
            <a href="#"><img src="/images/icons/ps.png" alt="PlayStation" class="platform-btn" /></a>
            <a href="#"><img src="/images/icons/xbox.png" alt="Xbox" class="platform-btn" /></a>
            <a href="#"><img src="/images/icons/switch.png" alt="Nintendo Switch" class="platform-btn" /></a>
            <a href="#"><img src="/images/icons/pc.png" alt="PC Software" class="platform-btn" /></a>
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

    <!-- Mobile Platform Buttons -->
    <div class="platform-btn-mobile">
        <a href="#"><img src="/images/icons/steam.png" alt="Steam" class="platform-btn" /></a>
        <a href="#"><img src="/images/icons/ps.png" alt="PlayStation" class="platform-btn" /></a>
        <a href="#"><img src="/images/icons/xbox.png" alt="Xbox" class="platform-btn" /></a>
        <a href="#"><img src="/images/icons/switch.png" alt="Nintendo Switch" class="platform-btn" /></a>
        <a href="#"><img src="/images/icons/pc.png" alt="PC Software" class="platform-btn" /></a>
    </div>
</template>
