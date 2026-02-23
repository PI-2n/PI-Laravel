<script setup>
import { ref, onMounted } from 'vue';
import { useAuthStore } from '../stores/auth';
import api from '../services/api';

const authStore = useAuthStore();
const purchasedProducts = ref([]);
const ratedProducts = ref([]);
const activeTab = ref('purchased');
const loading = ref(true);
const error = ref(null);

const generateKey = () => {
    return Math.random().toString(36).substring(2, 7).toUpperCase() + '-' +
        Math.random().toString(36).substring(2, 7).toUpperCase() + '-' +
        Math.random().toString(36).substring(2, 7).toUpperCase();
};

const getPlatformIcon = (name) => {
    if (!name) return 'pc';
    name = name.toLowerCase();
    if (name.includes('xbox')) return 'xbox';
    if (name.includes('ps') || name.includes('playstation')) return 'ps';
    if (name.includes('switch') || name.includes('nintendo')) return 'switch';
    if (name.includes('steam')) return 'steam';
    return 'pc';
};

onMounted(async () => {
    try {
        const response = await api.get('/profile/library');
        purchasedProducts.value = response.data.data.purchased.map(p => ({
            ...p,
            cd_key: generateKey()
        }));
        ratedProducts.value = response.data.data.rated;
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

            <div v-else-if="purchasedProducts.length === 0 && ratedProducts.length === 0" class="empty-state">
                <p>Aún no tienes juegos en tu biblioteca.</p>
                <RouterLink to="/products" class="btn-primary">Ver Catálogo</RouterLink>
            </div>

            <div v-else class="library-view-main">
                <div class="user-header-box">
                    <div class="user-header-top">
                        <div class="user-info">
                            <img src="/images/icons/user.png" alt="User" class="user-avatar" />
                            <span class="user-name">{{ authStore.user?.username || 'Usuario' }}</span>
                        </div>
                        <div class="card-options">
                            <span>...</span>
                        </div>
                    </div>

                    <div class="library-tabs">
                        <button class="tab-btn" :class="{ 'active': activeTab === 'purchased' }"
                            @click="activeTab = 'purchased'" title="Comprados">
                            <span class="tab-icon">$</span>
                            <span class="tab-count">{{ purchasedProducts.length }}</span>
                        </button>
                        <button class="tab-btn" :class="{ 'active': activeTab === 'rated' }"
                            @click="activeTab = 'rated'" title="Valorados">
                            <span class="tab-icon">★</span>
                            <span class="tab-count">{{ ratedProducts.length }}</span>
                        </button>
                    </div>
                </div>

                <div v-if="activeTab === 'purchased'" class="library-full-list">
                    <div v-if="purchasedProducts.length === 0" class="empty-tab-state">
                        <p>No tienes juegos comprados.</p>
                    </div>
                    <div v-for="product in purchasedProducts" :key="product.id" class="library-list-item">
                        <RouterLink :to="`/products/${product.id}`" class="product-image-link">
                            <img :src="product.image_url" :alt="product.name" class="product-image" />
                        </RouterLink>

                        <div class="product-info-col">
                            <div class="info-top">
                                <RouterLink :to="`/products/${product.id}`" class="product-title-link">
                                    <h3>{{ product.name }}</h3>
                                </RouterLink>

                                <div class="rating-display">
                                    <template v-if="getUserRating(product)">
                                        <span class="star">★</span>
                                        <span class="rating-value">{{ getUserRating(product) }}</span>
                                    </template>
                                    <template v-else>
                                        <RouterLink :to="`/products/${product.id}`" class="rate-link">Opinar
                                        </RouterLink>
                                    </template>
                                </div>
                            </div>

                            <div class="product-metadata">
                                <div class="metadata-row">
                                    <div v-if="product.purchased_platform" class="platform-badge">
                                        <img :src="`/images/icons/${getPlatformIcon(product.purchased_platform.name)}.png`"
                                            :alt="product.purchased_platform.name" class="platform-icon" />
                                    </div>
                                    <div v-if="product.tags && product.tags.length > 0" class="tags-list">
                                        <span v-for="tag in product.tags" :key="tag.id" class="tag-badge">{{ tag.name
                                        }}</span>
                                    </div>
                                </div>
                                <div class="cd-key-row">
                                    <span class="key-label">Licencia:</span>
                                    <span class="cd-key">{{ product.cd_key }}</span>
                                </div>
                            </div>

                            <div class="release-date" v-if="product.release_date">
                                <span>Lanzamiento: {{ new Date(product.release_date).toLocaleDateString() }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div v-if="activeTab === 'rated'" class="library-full-list">
                    <div v-if="ratedProducts.length === 0" class="empty-tab-state">
                        <p>No has valorado ningún juego aún.</p>
                    </div>
                    <div v-for="product in ratedProducts" :key="product.id" class="library-list-item">
                        <RouterLink :to="`/products/${product.id}`" class="product-image-link">
                            <img :src="product.image_url" :alt="product.name" class="product-image" />
                        </RouterLink>

                        <div class="product-info-col">
                            <div class="info-top">
                                <RouterLink :to="`/products/${product.id}`" class="product-title-link">
                                    <h3>{{ product.name }}</h3>
                                </RouterLink>

                                <div class="rating-display">
                                    <template v-if="getUserRating(product)">
                                        <span class="star">★</span>
                                        <span class="rating-value">{{ getUserRating(product) }}</span>
                                    </template>
                                </div>
                            </div>

                            <div class="product-metadata">
                                <div class="metadata-row">
                                    <div v-if="product.tags && product.tags.length > 0" class="tags-list">
                                        <span v-for="tag in product.tags" :key="tag.id" class="tag-badge">{{ tag.name
                                            }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="release-date" v-if="product.release_date">
                                <span>Lanzamiento: {{ new Date(product.release_date).toLocaleDateString() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
