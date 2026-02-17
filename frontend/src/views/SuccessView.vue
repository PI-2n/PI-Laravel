<script setup>
import { ref, onMounted } from 'vue';
import { useRoute } from 'vue-router';
import api from '../services/api';

const route = useRoute();
const order = ref(null);
const isLoading = ref(true);
const error = ref(null);

const fetchOrder = async () => {
    try {
        const response = await api.get(`/orders/${route.params.id}`);
        order.value = response.data.data;
    } catch (err) {
        console.error('Error fetching order:', err);
        error.value = 'No se pudo cargar la información del pedido.';
    } finally {
        isLoading.value = false;
    }
};

onMounted(() => {
    fetchOrder();
});

const formatDate = (dateString) => {
    if (!dateString) return '';
    const date = new Date(dateString);
    return date.toLocaleDateString('es-ES', {
        day: '2-digit',
        month: '2-digit',
        year: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    });
};

const formatPrice = (value) => {
    return parseFloat(value).toFixed(2) + ' €';
};

const padId = (id) => {
    return id.toString().padStart(6, '0');
};
</script>

<template>
    <div class="success-page">
        <div v-if="isLoading" class="loading">Cargando...</div>
        <div v-else-if="error" class="error">{{ error }}</div>

        <div v-else class="success-container">
            <div class="success-icon">✓</div>
            <h1>¡Pago Realizado con Éxito!</h1>

            <div class="order-details">
                <div class="detail-row">
                    <span class="label">Número de pedido:</span>
                    <span class="value">#{{ padId(order.id) }}</span>
                </div>
                <div class="detail-row">
                    <span class="label">Fecha:</span>
                    <span class="value">{{ formatDate(order.created_at) }}</span>
                </div>
                <div class="detail-row">
                    <span class="label">Total pagado:</span>
                    <span class="value">{{ formatPrice(order.total) }}</span>
                </div>
                <div class="detail-row" v-if="order.transaction_id">
                    <span class="label">Transacción:</span>
                    <span class="value">{{ order.transaction_id }}</span>
                </div>
                <div class="detail-row">
                    <span class="label">Estado:</span>
                    <span class="value success">Completado</span>
                </div>
            </div>

            <h2>Productos comprados:</h2>
            <div class="products-list">
                <div v-for="item in order.items" :key="item.id" class="product-item">
                    <div class="product-info">
                        <h4>{{ item.product_name }}</h4>
                        <!-- <p class="quantity">Cantidad: {{ item.quantity }}</p> -->
                        <!-- Laravel view shows quantity and unit price in one line in p.quantity or similar? 
                              Let's match the screenshot or blade logic.
                              Blade: <p class="quantity">Cantidad: {{ $item->quantity }}</p>
                                     <p class="price">Precio unitario: {{ number_format($item->price, 2) }} €</p>
                              Vue logic below:
                         -->
                        <p class="quantity">Cantidad: {{ item.quantity }}</p>
                        <p class="price">Precio unitario: {{ formatPrice(item.price) }}</p>
                    </div>
                    <div class="product-total">
                        <span>{{ formatPrice(item.price * item.quantity) }}</span>
                    </div>
                </div>
            </div>

            <div class="actions">
                <router-link to="/" class="btn-primary">Seguir comprando</router-link>
            </div>
        </div>
    </div>
</template>
