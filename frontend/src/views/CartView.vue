<script setup>
import { useAuthStore } from '../stores/auth';
import { useCartStore } from '../stores/cart';
import { RouterLink } from 'vue-router';
import { computed } from 'vue';

const authStore = useAuthStore();
const cartStore = useCartStore();

const cartItems = computed(() => cartStore.items);
const total = computed(() => cartStore.cartTotal);

const removeItem = (index) => {
    cartStore.removeFromCart(index);
};

const updateQty = (index, qty) => {
    cartStore.updateQuantity(index, qty);
};

const formatPrice = (value) => {
    return parseFloat(value).toFixed(2) + ' €';
};

const getPlatformIcon = (platformName) => {
    if (!platformName) return 'pc';
    const name = platformName.toLowerCase();
    if (name.includes('xbox')) return 'xbox';
    if (name.includes('ps') || name.includes('playstation')) return 'ps';
    if (name.includes('switch') || name.includes('nintendo')) return 'switch';
    if (name.includes('steam')) return 'steam';
    return 'pc';
};

</script>

<template>
    <div class="cart-page-main">
        <div class="cart-page-container">
            <h1>Cesta</h1>

            <div v-if="cartItems.length > 0" class="cart-grid">

                <div class="cart-items">
                    <div v-for="(item, index) in cartItems" :key="index" class="cart-item-card">
                        <div class="item-image">
                            <img :src="item.product.image_url" :alt="item.product.name">
                        </div>

                        <div class="item-details">
                            <h3 class="item-title">{{ item.product.name }}</h3>
                            <div class="item-platform">
                                <template v-if="item.platform">
                                    <img :src="`/images/icons/${getPlatformIcon(item.platform.name)}.png`"
                                        :alt="item.platform.name">
                                    <span>{{ item.platform.name }}</span>
                                </template>
                                <template v-else>
                                    <span>Plataforma no especificada</span>
                                </template>
                            </div>
                        </div>

                        <div class="item-pricing">
                            <span v-if="item.product.final_price < item.product.price" class="item-price-discounted">{{
                                formatPrice(item.product.final_price) }}</span>
                            <span v-if="item.product.final_price < item.product.price" class="item-price-original">{{
                                formatPrice(item.product.price) }}</span>
                            <span v-else class="item-price">{{ formatPrice(item.product.final_price) }}</span>

                            <div class="actions-container">
                                <div class="update-form">
                                    <input type="number" :value="item.quantity" min="1" max="10" class="quantity-input"
                                        @change="updateQty(index, parseInt($event.target.value))">
                                </div>

                                <button @click="removeItem(index)" class="btn-delete" title="Eliminar producto">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <polyline points="3 6 5 6 21 6"></polyline>
                                        <path
                                            d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                        </path>
                                        <line x1="10" y1="11" x2="10" y2="17"></line>
                                        <line x1="14" y1="11" x2="14" y2="17"></line>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="cart-summary">
                    <h2>Resumen</h2>
                    <div class="summary-row">
                        <span>Artículos</span>
                        <span>{{ cartStore.cartCount }}</span>
                    </div>
                    <div class="summary-row total">
                        <span>Total</span>
                        <span>{{ formatPrice(total) }}</span>
                    </div>

                    <RouterLink to="/checkout" class="btn-checkout">Comprar</RouterLink>
                </div>
            </div>

            <div v-else class="cart-empty-state">
                <h2>Tu carrito está vacío</h2>
                <p>¿Por qué no echas un vistazo a nuestras ofertas?</p>
                <RouterLink to="/" class="btn-view-store">Ver tienda</RouterLink>
            </div>
        </div>
    </div>
</template>
