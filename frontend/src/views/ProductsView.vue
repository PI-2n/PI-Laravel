<script setup>
import { ref, onMounted } from 'vue';
import api from '../services/api';
import { RouterLink } from 'vue-router';

const products = ref([]);
const loading = ref(true);
const currentPage = ref(1);
const lastPage = ref(1);

const fetchProducts = async (page = 1) => {
    loading.value = true;
    try {
        const response = await api.get(`/products?page=${page}`);
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
    fetchProducts();
});
</script>

<template>
    <div class="page-index" style="display: block; min-height: 80vh;">
        <section class="offers" style="background: transparent; padding-top: 40px;">
            <h2 class="text-center mb-8">Catálogo Completo</h2>

            <div v-if="loading" class="text-center text-white">Loading...</div>

            <div v-else class="products">
                <div v-for="product in products" :key="product.id" class="product">
                    <RouterLink :to="`/products/${product.id}`">
                        <span v-if="product.is_offer" class="discount-badge">-{{ parseInt(product.offer_percentage)
                            }}%</span>
                        <img :src="product.image_url" :alt="product.name">
                        <div class="product-text">
                            <span class="title">{{ product.name }}</span>
                            <div class="price">
                                <span v-if="product.is_offer" class="old-price">{{ parseFloat(product.price).toFixed(2)
                                    }}€</span>
                                <span>{{ product.is_offer ? (product.price * (1 - product.offer_percentage /
                                    100)).toFixed(2) : parseFloat(product.price).toFixed(2) }}€</span>
                            </div>
                        </div>
                    </RouterLink>
                </div>
            </div>

            <!-- Simple Pagination -->
            <div class="flex justify-center mt-8 gap-4" v-if="lastPage > 1">
                <button @click="fetchProducts(currentPage - 1)" :disabled="currentPage === 1"
                    class="px-4 py-2 bg-gray-700 text-white rounded disabled:opacity-50">
                    Previous
                </button>
                <span class="text-white py-2">Page {{ currentPage }} of {{ lastPage }}</span>
                <button @click="fetchProducts(currentPage + 1)" :disabled="currentPage === lastPage"
                    class="px-4 py-2 bg-gray-700 text-white rounded disabled:opacity-50">
                    Next
                </button>
            </div>
        </section>
    </div>
</template>
