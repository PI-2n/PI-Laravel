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

<style scoped lang="scss">
.success-page {
    padding: 3rem 0;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 60vh;
    background-color: #121212;
    /* Ensure dark background */
}

.success-container {
    background: #1a1a1a;
    padding: 3rem;
    border-radius: 12px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.5);
    max-width: 700px;
    width: 100%;
    text-align: center;
}

.success-icon {
    /* Using orange checkmark as per screenshot if that's what user prefers?
Wait, user said "like Laravel". Laravel screenshot shows ORANGE checkmark.
My previous code had green (#48bb78).
*/
    background-color: transparent;
    color: #e58e27;
    /* Orange */
    font-size: 80px;
    margin: 0 auto 1rem;
    display: block;
    /* It's just a checkmark icon */
    width: auto;
    height: auto;
    /* Actually the screenshot shows a checkmark without a circle background, or maybe with?
Let's stick to the user's "Laravel" screenshot.
It looks like a simple orange check mark vector.
*/
}

h1 {
    color: #e58e27;
    /* Orange title */
    margin-bottom: 2.5rem;
    font-size: 2rem;
    font-weight: bold;
}

.order-details {
    background: #252525;
    padding: 2rem;
    border-radius: 8px;
    margin-bottom: 2.5rem;
    border: 1px solid #333;

    .detail-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 1rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid #333;

        &:last-child {
            margin-bottom: 0;
            padding-bottom: 0;
            border-bottom: none;
        }

        .label {
            color: #a0aec0;
            font-weight: 500;
        }

        .value {
            color: #fff;
            font-weight: bold;
            font-size: 1.1rem;

            &.success {
                color: #48bb78;
                /* Completed is usually green */
            }
        }
    }
}

h2 {
    color: #fff;
    margin: 0 0 1.5rem;
    text-align: center;
    /* Screenshot shows "Productos comprados:" centered? Or left? Laravel blade usually centers or left.
Let's center for now. */
    font-size: 1.5rem;
    border: none;
    padding: 0;
}

.products-list {
    background: #252525;
    padding: 2rem;
    border-radius: 8px;
    text-align: left;
    border: 1px solid #333;

    .product-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1.5rem 0;
        border-bottom: 1px solid #333;

        &:first-child {
            padding-top: 0;
        }

        &:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .product-info {
            h4 {
                color: #fff;
                margin: 0 0 0.5rem;
                font-size: 1.2rem;
            }

            p {
                color: #cbd5e0;
                font-size: 0.95rem;
                margin: 0.25rem 0;
            }
        }

        .product-total {
            color: #e58e27;
            font-weight: bold;
            font-size: 1.2rem;
        }
    }
}

.actions {
    margin-top: 3rem;
}

.btn-primary {
    display: inline-block;
    text-decoration: none;
    background-color: #e58e27;
    color: white;
    padding: 1rem 3rem;
    /* Larger button */
    border-radius: 6px;
    font-weight: bold;
    font-size: 1.1rem;
    transition: all 0.3s ease;

    &:hover {
        background-color: #d6811f;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(229, 142, 39, 0.3);
    }
}
</style>
