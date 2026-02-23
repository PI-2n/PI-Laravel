<script setup>
import { ref, onMounted, computed, watch } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import api from '../services/api';
import { useCartStore } from '../stores/cart';
import { useAuthStore } from '../stores/auth'; // Import Auth Store
import ToastNotification from '../components/ToastNotification.vue';
import CommentList from '../components/comments/CommentList.vue';

const route = useRoute();
const router = useRouter();
const product = ref(null);
const loading = ref(true);
const cartStore = useCartStore();
const authStore = useAuthStore(); // Use Auth Store
const selectedPlatform = ref('steam'); // Default
const toast = ref(null);
const toastMessage = ref('Producto añadido al carrito');

const relatedProducts = ref([]);

const fetchProduct = async () => {
    try {
        const response = await api.get(`/products/${route.params.id}`);
        product.value = response.data.data;

        const related = response.data.related_products || [];
        relatedProducts.value = related.map(p => {
            let defaultPlatform = 'pc';
            if (p.platforms && p.platforms.length > 0) {
                defaultPlatform = p.platforms[0].name.toLowerCase();
            }
            return {
                ...p,
                selected_platform: defaultPlatform
            };
        });

    } catch (error) {
        console.error('Error fetching product:', error);
    } finally {
        loading.value = false;
    }
};

onMounted(async () => {
    await fetchProduct();
    if (product.value && product.value.platforms && product.value.platforms.length > 0) {
        selectedPlatform.value = product.value.platforms[0].name.toLowerCase();
    }
});

watch(() => route.params.id, async (newId) => {
    if (newId) {
        loading.value = true;
        await fetchProduct();
        if (product.value && product.value.platforms && product.value.platforms.length > 0) {
            selectedPlatform.value = product.value.platforms[0].name.toLowerCase();
        }
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }
});

const discountedPrice = computed(() => {
    if (product.value && product.value.offer_percentage > 0) {
        return (product.value.price * (1 - product.value.offer_percentage / 100)).toFixed(2);
    }
    return parseFloat(product.value?.price).toFixed(2);
});

const averageRating = computed(() => {
    return parseFloat(product.value?.average_rating || 0).toFixed(1);
});

const totalComments = computed(() => {
    return product.value?.comments?.length || 0;
});

const getPlatformIcon = (name) => {
    name = name.toLowerCase();
    if (name.includes('xbox')) return 'xbox';
    if (name.includes('ps') || name.includes('playstation')) return 'ps';
    if (name.includes('switch') || name.includes('nintendo')) return 'switch';
    if (name.includes('steam')) return 'steam';
    return 'pc';
};

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

    // Trigger reflow
    void flyingImg.offsetWidth;

    // Distances
    const destX = cartRect.left + cartRect.width / 2;
    const destY = cartRect.top + cartRect.height / 2;

    flyingImg.style.left = `${destX}px`;
    flyingImg.style.top = `${destY}px`;
    flyingImg.style.width = '20px';
    flyingImg.style.height = '20px';
    flyingImg.style.opacity = '0.2';
    flyingImg.style.transform = 'translate(-50%, -50%) scale(0.1) rotate(15deg)';

    setTimeout(() => {
        if (document.body.contains(flyingImg)) {
            document.body.removeChild(flyingImg);
            if (cartEl) {
                cartEl.style.transform = 'scale(1.2)';
                cartEl.style.transition = 'transform 0.2s';
                setTimeout(() => { cartEl.style.transform = 'scale(1)'; }, 200);
            }
        }
    }, 400);
};

const handleAddToCart = () => {
    if (!product.value) return;

    const imgEl = document.querySelector('.product-image > img');
    if (imgEl) animateToCart(imgEl, product.value.image_url);

    const selectedPlatformObj = product.value.platforms.find(p => p.name.toLowerCase() === selectedPlatform.value);

    cartStore.addToCart(product.value, selectedPlatformObj);
};

const addToCartRelated = (relatedProduct, e) => {
    if (!relatedProduct) return;

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

const handleInstantBuy = () => {
    if (!product.value) return;
    const selectedPlatformObj = product.value.platforms.find(p => p.name.toLowerCase() === selectedPlatform.value);
    cartStore.instantBuy(product.value, selectedPlatformObj);
    router.push({ name: 'checkout' });
};
</script>

<template>
    <div class="product-page-main">
        <div v-if="loading" class="loading-container">Loading...</div>

        <div v-else-if="product" class="product-page-container">
            <div class="product-detail">
                <div class="product-image">
                    <img :src="product.image_url" :alt="product.name">

                    <div v-if="authStore.isAdmin" class="edit-container">
                        <router-link :to="`/products/${product.id}/edit`" class="btn-secondary">
                            Editar Producto
                        </router-link>
                    </div>
                </div>

                <div class="product-info">
                    <h1>{{ product.name }}</h1>

                    <div class="rating-summary" v-if="totalComments > 0" title="Valoración promedio de los usuarios">
                        <span class="star">★</span> <span class="rating-value">{{ averageRating }}</span>
                        <span class="reviews-count">({{ totalComments }} opiniones)</span>
                    </div>

                    <div class="price">
                        <span v-if="product.offer_percentage > 0" class="old-price">{{
                            parseFloat(product.price).toFixed(2) }}€</span>
                        <span class="current-price">{{ discountedPrice }}€</span>
                    </div>

                    <div class="description">
                        {{ product.description }}
                    </div>

                    <div v-if="product.platforms && product.platforms.length > 0" class="platform-selector">
                        <span class="selector-label">Plataforma:</span>
                        <div class="platforms-grid">
                            <label v-for="platform in product.platforms" :key="platform.id" class="platform-option">
                                <input type="radio" :value="platform.name.toLowerCase()" v-model="selectedPlatform">
                                <span class="platform-badge">
                                    <img :src="`/images/icons/${getPlatformIcon(platform.name)}.png`"
                                        :alt="platform.name"> {{ platform.name }}
                                </span>
                            </label>
                        </div>
                    </div>

                    <div class="product-actions">
                        <form @submit.prevent="handleAddToCart">
                            <button type="submit" class="btn-add-cart">
                                Añadir al carrito
                                <img src="/images/icons/carrito.png" alt="Cart">
                            </button>
                        </form>

                        <button class="btn-fast-buy" title="Comprar ahora" @click="handleInstantBuy">
                            <img src="/images/icons/fast-buy.png" alt="Fast Buy">
                        </button>
                    </div>
                </div>
            </div>

            <div v-if="relatedProducts.length > 0" class="related-products-section">
                <h2>Productos relacionados</h2>
                <div class="related-grid">
                    <router-link v-for="related in relatedProducts" :key="related.id" :to="`/products/${related.id}`"
                        class="related-card">
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

            <CommentList v-if="product" :comments="product.comments || []" :product-id="product.id"
                @refresh="fetchProduct" />

            <ToastNotification ref="toast" :message="toastMessage" />
        </div>

        <div v-else class="loading-container">Product not found.</div>
    </div>
</template>
