<script setup>
import { ref, onMounted, watch } from 'vue';
import api from '../services/api';
import { RouterLink, useRoute, useRouter } from 'vue-router';

const route = useRoute();
const router = useRouter();
const products = ref([]);
const availableTags = ref([]);
const loading = ref(true);
const currentPage = ref(1);
const lastPage = ref(1);

// Filter states
const showFilters = ref(false);
const filterPlatform = ref(route.query.platform || '');
const filterTags = ref(route.query.tags ? route.query.tags.split(',') : []);
const filterMinPrice = ref(route.query.min_price || '');
const filterMaxPrice = ref(route.query.max_price || '');
const filterReleaseFrom = ref(route.query.release_date_from || '');
const filterReleaseTo = ref(route.query.release_date_to || '');

// sync initial state if route changes directly (like back button)
watch(() => route.query, (newQuery) => {
    filterPlatform.value = newQuery.platform || '';
    filterTags.value = newQuery.tags ? newQuery.tags.split(',') : [];
    filterMinPrice.value = newQuery.min_price || '';
    filterMaxPrice.value = newQuery.max_price || '';
    filterReleaseFrom.value = newQuery.release_date_from || '';
    filterReleaseTo.value = newQuery.release_date_to || '';
    fetchProducts();
});

const applyFilters = () => {
    const query = { ...route.query, page: 1 };

    // Remove old filters
    delete query.platform;
    delete query.tags;
    delete query.min_price;
    delete query.max_price;
    delete query.release_date_from;
    delete query.release_date_to;

    // Apply new
    if (filterPlatform.value) query.platform = filterPlatform.value;
    if (filterTags.value.length) query.tags = filterTags.value.join(',');
    if (filterMinPrice.value) query.min_price = filterMinPrice.value;
    if (filterMaxPrice.value) query.max_price = filterMaxPrice.value;
    if (filterReleaseFrom.value) query.release_date_from = filterReleaseFrom.value;
    if (filterReleaseTo.value) query.release_date_to = filterReleaseTo.value;

    router.push({ query });
};

const clearFilters = () => {
    filterPlatform.value = '';
    filterTags.value = [];
    filterMinPrice.value = '';
    filterMaxPrice.value = '';
    filterReleaseFrom.value = '';
    filterReleaseTo.value = '';
    applyFilters();
};

const fetchTags = async () => {
    try {
        const response = await api.get('/tags');
        // adjust based on whether resource wraps in data
        availableTags.value = response.data.data || response.data;
    } catch (e) {
        console.error('Error fetching tags', e);
    }
};

const fetchProducts = async (page = 1) => {
    loading.value = true;
    try {
        const params = {
            page,
            platform: route.query.platform,
            q: route.query.q,
            tags: route.query.tags,
            min_price: route.query.min_price,
            max_price: route.query.max_price,
            release_date_from: route.query.release_date_from,
            release_date_to: route.query.release_date_to
        };

        const response = await api.get('/products', { params });
        products.value = response.data.data;
        currentPage.value = response.data.meta.current_page;
        lastPage.value = response.data.meta.last_page;
    } catch (error) {
        console.error('Error fetching products:', error);
    } finally {
        loading.value = false;
    }
};

onMounted(() => {
    fetchTags();
    fetchProducts();
});

// Watcher merged into script setup top
</script>

<template>
    <div class="page-products">
        <section class="catalog">
            <h2 v-if="route.query.q">Resultados de búsqueda: "{{ route.query.q }}"</h2>
            <h2 v-else-if="route.query.platform === 'software'">Software</h2>
            <h2 v-else-if="route.query.platform">Juegos de {{ route.query.platform }}</h2>
            <h2 v-else>Catálogo</h2>

            <div class="filters-toggle">
                <button type="button" @click="showFilters = !showFilters" class="btn-toggle-filters">
                    <span class="filter-icon" v-if="!showFilters">≡</span>
                    {{ showFilters ? 'Ocultar Filtros' : 'Mostrar Filtros' }}
                </button>
            </div>

            <div v-show="showFilters" class="filters-panel">
                <form @submit.prevent="applyFilters" class="filters-form">
                    <div class="filter-group">
                        <label>Plataforma</label>
                        <select v-model="filterPlatform">
                            <option value="">Todas las plataformas</option>
                            <option value="steam">Steam</option>
                            <option value="playstation">PlayStation</option>
                            <option value="xbox">Xbox</option>
                            <option value="switch">Nintendo Switch</option>
                            <option value="software">Software / PC</option>
                        </select>
                    </div>

                    <div class="filter-group price-group">
                        <label>Precio</label>
                        <div class="multi-inputs">
                            <input type="number" v-model="filterMinPrice" placeholder="Mínimo" step="0.01" min="0">
                            <span>-</span>
                            <input type="number" v-model="filterMaxPrice" placeholder="Máximo" step="0.01" min="0">
                        </div>
                    </div>

                    <div class="filter-group date-group">
                        <label>Fecha de Salida</label>
                        <div class="multi-inputs">
                            <input type="date" v-model="filterReleaseFrom" title="Desde">
                            <span>-</span>
                            <input type="date" v-model="filterReleaseTo" title="Hasta">
                        </div>
                    </div>

                    <div class="filter-group tags-group" v-if="availableTags.length">
                        <label>Tags</label>
                        <div class="tags-list">
                            <label v-for="tag in availableTags" :key="tag.id" class="tag-label">
                                <input type="checkbox" :value="tag.id" v-model="filterTags">
                                {{ tag.name }}
                            </label>
                        </div>
                    </div>

                    <div class="filter-actions">
                        <button type="submit" class="btn-apply">Aplicar Filtros</button>
                        <button type="button" @click="clearFilters" class="btn-clear">Limpiar</button>
                    </div>
                </form>
            </div>

            <div v-if="loading" class="loading-container">Loading...</div>

            <div v-else-if="products.length === 0" class="empty-state">
                <p>No se encontraron productos.</p>
                <p class="subtitle">Selecciona una plataforma o realiza una búsqueda para ver nuestro catálogo.</p>
            </div>

            <div v-else class="products-grid">
                <div v-for="product in products" :key="product.id" class="product-card">
                    <RouterLink :to="`/products/${product.id}`">
                        <span v-if="product.is_offer" class="discount-badge">-{{ parseInt(product.offer_percentage)
                        }}%</span>
                        <img :src="product.image_url" :alt="product.name">
                        <div class="product-info">
                            <span class="title">{{ product.name }}</span>
                            <div class="price-container">
                                <span v-if="product.is_offer" class="old-price">{{ parseFloat(product.price).toFixed(2)
                                }}€</span>
                                <span class="current-price">{{ product.is_offer ? (product.price * (1 -
                                    product.offer_percentage / 100)).toFixed(2) : parseFloat(product.price).toFixed(2)
                                }}€</span>
                            </div>
                        </div>
                    </RouterLink>
                </div>
            </div>

            <div class="pagination" v-if="lastPage > 1">
                <button @click="fetchProducts(currentPage - 1)" :disabled="currentPage === 1" class="btn-nav">
                    Anterior
                </button>
                <span class="page-info">Página {{ currentPage }} de {{ lastPage }}</span>
                <button @click="fetchProducts(currentPage + 1)" :disabled="currentPage === lastPage" class="btn-nav">
                    Siguiente
                </button>
            </div>
        </section>
    </div>
</template>
