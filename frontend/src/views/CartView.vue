<script setup>
import { useAuthStore } from '../stores/auth';
import { useCartStore } from '../stores/cart';
import { RouterLink } from 'vue-router';
import { computed, ref, watch, onMounted } from 'vue';
import api from '../services/api';
import ToastNotification from '../components/ToastNotification.vue';

const authStore = useAuthStore();
const cartStore = useCartStore();

const cartItems = computed(() => cartStore.items);
const total = computed(() => cartStore.cartTotal);

const recommendedProducts = ref([]);
const toastMessage = ref('');
const toast = ref(null);

const animateToCart = (startEl, imageUrl) => {
    const cartEl = document.querySelector('.cart-btn-wrapper img');
    if (!cartEl || !startEl) return;

    const startRect = startEl.getBoundingClientRect();
    const cartRect = cartEl.getBoundingClientRect();

    const flyingImg = document.createElement('img');
    flyingImg.src = imageUrl;
    flyingImg.style.position = 'fixed';
    flyingImg.style.left = `${startRect.left}px`;
    flyingImg.style.top = `${startRect.top}px`;
    flyingImg.style.width = `${startRect.width}px`;
    flyingImg.style.height = `${startRect.height}px`;
    flyingImg.style.objectFit = 'cover';
    flyingImg.style.borderRadius = '15px';
    flyingImg.style.zIndex = '9999';
    flyingImg.style.transition = 'all 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94)';
    flyingImg.style.pointerEvents = 'none';
    flyingImg.style.boxShadow = '0 10px 25px rgba(230, 110, 0, 0.5)';

    document.body.appendChild(flyingImg);

    // Trigger animation
    requestAnimationFrame(() => {
        flyingImg.style.left = `${cartRect.left + cartRect.width / 2 - 15}px`;
        flyingImg.style.top = `${cartRect.top + cartRect.height / 2 - 15}px`;
        flyingImg.style.width = '30px';
        flyingImg.style.height = '30px';
        flyingImg.style.opacity = '0';
        flyingImg.style.transform = 'scale(0.5)';
    });

    // Clean up
    setTimeout(() => {
        if (document.body.contains(flyingImg)) {
            document.body.removeChild(flyingImg);
        }

        // Add a little pop effect to the cart icon
        if (cartEl) {
            cartEl.style.transform = 'scale(1.2)';
            setTimeout(() => {
                cartEl.style.transform = 'scale(1)';
            }, 200);
        }
    }, 800);
};

const addToCartRelated = (relatedProduct, e) => {
    if (e) {
        const btn = e.currentTarget;
        const card = btn.closest('.related-card');
        const imgEl = card ? card.querySelector('.related-image img') : null;
        if (imgEl) animateToCart(imgEl, relatedProduct.image_url);
    }

    let platform = null;
    if (relatedProduct.platforms && relatedProduct.platforms.length > 0) {
        platform = relatedProduct.platforms.find(p => p.name.toLowerCase() === relatedProduct.selected_platform);
        if (!platform) platform = relatedProduct.platforms[0];
    }

    cartStore.addToCart(relatedProduct, platform);
    toastMessage.value = `${relatedProduct.name} añadido al carrito`;
    toast.value.show();
};


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

const fetchRecommendations = async () => {
    if (cartItems.value.length === 0) {
        recommendedProducts.value = [];
        return;
    }

    try {
        const productIds = cartItems.value.map(item => item.product.id);
        const params = new URLSearchParams();
        productIds.forEach(id => params.append('product_ids[]', id));

        const response = await api.get(`/cart/recommendations?${params.toString()}`);
        recommendedProducts.value = response.data.data;
    } catch (error) {
        console.error('Error fetching recommendations:', error);
    }
};

const addToCart = (product) => {
    let platform = null;
    if (product.platforms && product.platforms.length > 0) {
        platform = product.platforms[0]; // Default to first platform
    }
    cartStore.addToCart(product, platform);
};

onMounted(() => {
    fetchRecommendations();
});

watch(cartItems, () => {
    fetchRecommendations();
}, { deep: true });

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

            <div v-if="recommendedProducts.length > 0" class="related-products-section">
                <h2>Recomendaciones para ti</h2>
                <div class="related-grid">
                    <router-link v-for="related in recommendedProducts" :key="related.id"
                        :to="`/products/${related.id}`" class="related-card">
                        <div class="related-image">
                            <img :src="related.image_url" :alt="related.name">
                        </div>
                        <div class="related-info">
                            <h3>{{ related.name }}</h3>
                            <div class="price">
                                <span v-if="related.offer_percentage > 0" class="old-price">
                                    {{ parseFloat(related.price).toFixed(2) }}€
                                </span>
                                <span class="current-price" :class="{ 'is-offer': related.offer_percentage > 0 }">
                                    {{ parseFloat(related.final_price || related.price).toFixed(2) }}€
                                </span>
                            </div>

                            <div class="related-platforms" v-if="related.platforms && related.platforms.length > 0"
                                @click.prevent>
                                <div v-for="platform in related.platforms" :key="platform.id"
                                    class="related-platform-icon"
                                    :class="{ 'active': related.selected_platform === platform.name.toLowerCase() }"
                                    @click="related.selected_platform = platform.name.toLowerCase()">
                                    <img :src="`/images/icons/${getPlatformIcon(platform.name)}.png`"
                                        :alt="platform.name" :title="platform.name">
                                </div>
                            </div>

                            <button class="btn-view" @click.prevent="addToCartRelated(related, $event)">
                                <img src="/images/icons/carrito.png" alt="Añadir al carrito">
                            </button>
                        </div>
                    </router-link>
                </div>
            </div>
            <ToastNotification ref="toast" :message="toastMessage" />
        </div>
    </div>
</template>
