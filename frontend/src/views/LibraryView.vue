<script setup>
import { ref, onMounted } from 'vue';
import { useAuthStore } from '../stores/auth';
import api from '../services/api';

const authStore = useAuthStore();
const products = ref([]);
const loading = ref(true);
const error = ref(null);

onMounted(async () => {
    try {
        const response = await api.get('/profile/library');
        products.value = response.data.data;
    } catch (err) {
        error.value = 'No se pudo cargar la biblioteca.';
        console.error(err);
    } finally {
        loading.value = false;
    }
});

const getUserRating = (product) => {
    if (product.comments && product.comments.length > 0) {
        return product.comments[0].rating;
    }
    return null;
};
</script>

<template>
    <div class="library-page">
        <div class="library-container">
            <header class="library-header">
                <h2>Mi Biblioteca</h2>
                <p>Juegos que has comprado</p>
            </header>

            <div v-if="loading" class="loading-state">
                <p>Cargando biblioteca...</p>
            </div>

            <div v-else-if="error" class="error-state">
                <p>{{ error }}</p>
            </div>

            <div v-else-if="products.length === 0" class="empty-state">
                <p>Aún no has comprado ningún juego.</p>
                <RouterLink to="/products" class="btn-primary">Ver Catálogo</RouterLink>
            </div>

            <div v-else class="library-view-main">
                <div class="user-header-box">
                    <div class="user-info">
                        <img src="/images/icons/user.png" alt="User" class="user-avatar" />
                        <span class="user-name">{{ authStore.user?.username || 'Usuario' }}</span>
                    </div>
                    <div class="card-options">
                        <span>...</span>
                    </div>
                </div>

                <div class="library-full-list">
                    <div v-for="product in products" :key="product.id" class="library-list-item">
                        <RouterLink :to="`/products/${product.id}`" class="product-image-link">
                            <img :src="product.image_url" :alt="product.name" class="product-image" />
                        </RouterLink>

                        <div class="product-info-col">
                            <RouterLink :to="`/products/${product.id}`" class="product-title-link">
                                <h3>{{ product.name }}</h3>
                            </RouterLink>

                            <div class="rating-display">
                                <template v-if="getUserRating(product)">
                                    <span class="star">★</span>
                                    <span class="rating-value">{{ getUserRating(product) }}</span>
                                </template>
                                <template v-else>
                                    <RouterLink :to="`/products/${product.id}`" class="rate-link">Opinar</RouterLink>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
