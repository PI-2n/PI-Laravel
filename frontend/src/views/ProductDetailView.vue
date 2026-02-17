<script setup>
import { ref, onMounted, computed } from 'vue';
import { useRoute } from 'vue-router';
import api from '../services/api';
import { useCartStore } from '../stores/cart';
import { useAuthStore } from '../stores/auth'; // Import Auth Store
import ToastNotification from '../components/ToastNotification.vue';
import CommentList from '../components/comments/CommentList.vue';

const route = useRoute();
const product = ref(null);
const loading = ref(true);
const cartStore = useCartStore();
const authStore = useAuthStore(); // Use Auth Store
const selectedPlatform = ref('steam'); // Default
const toast = ref(null);
const toastMessage = ref('Producto añadido al carrito');

const fetchProduct = async () => {
    try {
        const response = await api.get(`/products/${route.params.id}`);
        product.value = response.data.data; // generic API resource wrap 'data'
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

// Helper to calculate discount
const discountedPrice = computed(() => {
    if (product.value && product.value.offer_percentage > 0) {
        return (product.value.price * (1 - product.value.offer_percentage / 100)).toFixed(2);
    }
    return parseFloat(product.value?.price).toFixed(2);
});

const getPlatformIcon = (name) => {
    name = name.toLowerCase();
    if (name.includes('xbox')) return 'xbox';
    if (name.includes('ps') || name.includes('playstation')) return 'ps';
    if (name.includes('switch') || name.includes('nintendo')) return 'switch';
    if (name.includes('steam')) return 'steam';
    return 'pc';
};

const handleAddToCart = () => {
    if (!product.value) return;

    // Use full platform object from product data if possible, or construct it
    const selectedPlatformObj = product.value.platforms.find(p => p.name.toLowerCase() === selectedPlatform.value);

    // If no platform is selected (or product has no platforms), we might send null or handle it
    cartStore.addToCart(product.value, selectedPlatformObj);

    toastMessage.value = 'Producto añadido al carrito';
    toast.value.show();
};
</script>

<template>
    <div class="product-page-main">
        <div v-if="loading" class="loading-container">Loading...</div>

        <div v-else-if="product" class="product-page-container">
            <div class="product-detail">
                <!-- Image Section -->
                <div class="product-image">
                    <img :src="product.image_url" :alt="product.name">

                    <div v-if="authStore.isAdmin" class="edit-container">
                        <router-link :to="`/products/${product.id}/edit`" class="btn-secondary">
                            Editar Producto
                        </router-link>
                    </div>
                </div>

                <!-- Info Section -->
                <div class="product-info">
                    <h1>{{ product.name }}</h1>

                    <div class="price">
                        <span v-if="product.offer_percentage > 0" class="old-price">{{
                            parseFloat(product.price).toFixed(2) }}€</span>
                        <span class="current-price">{{ discountedPrice }}€</span>
                    </div>

                    <div class="description">
                        {{ product.description }}
                    </div>

                    <!-- Platform Selector -->
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

                    <!-- Actions -->
                    <div class="product-actions">
                        <form @submit.prevent="handleAddToCart">
                            <button type="submit" class="btn-add-cart">
                                Añadir al carrito
                                <img src="/images/icons/carrito.png" alt="Cart">
                            </button>
                        </form>

                        <button class="btn-fast-buy" title="Comprar ahora">
                            <img src="/images/icons/fast-buy.png" alt="Fast Buy">
                        </button>
                    </div>
                </div>
            </div>

            <!-- Comments Section -->
            <CommentList v-if="product" :comments="product.comments || []" :product-id="product.id"
                @refresh="fetchProduct" />

            <ToastNotification ref="toast" :message="toastMessage" />
        </div>

        <div v-else class="loading-container">Product not found.</div>
    </div>
</template>
