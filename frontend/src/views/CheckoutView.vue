<script setup>
import { ref, computed, onMounted } from 'vue';
import { useCartStore } from '../stores/cart';
import { useAuthStore } from '../stores/auth';
import api from '../services/api';
import { useRouter } from 'vue-router';
import ToastNotification from '../components/ToastNotification.vue';

const cartStore = useCartStore();
const authStore = useAuthStore();
const router = useRouter();

const cartItems = computed(() => cartStore.items);
const total = computed(() => cartStore.cartTotal);

const savedCards = ref([]);
const paymentMethod = ref('new_card'); // 'new_card' or 'saved_card'
const selectedCardId = ref(null);
const newCard = ref({
    card_number: '',
    card_holder_name: '',
    expiration_date: '',
    cvv: '',
    save_card: false
});
const errors = ref({});
const isLoading = ref(false);
const toast = ref(null);
const toastMessage = ref('');

const fetchCheckoutData = async () => {
    try {
        // Sync cart first
        if (cartStore.items.length > 0) {
            try {
                await api.post('/cart/sync', { items: cartStore.items });
                // Small delay to ensure DB transaction is committed before read? 
                // Should not be needed if API awaits, but let's be safe for debugging.
                await new Promise(resolve => setTimeout(resolve, 500));
            } catch (syncError) {
                console.error('Cart Sync Failed:', syncError);
                // Continue to checkout anyway to see if backend has data? 
                // Or maybe show error?
            }
        }

        // Fetch saved cards and validate cart state from backend perspective
        const response = await api.get('/checkout');
        savedCards.value = response.data.data.saved_cards || [];
        if (savedCards.value.length > 0) {
            paymentMethod.value = 'saved_card';
            selectedCardId.value = savedCards.value[0].id;
        }
    } catch (error) {
        console.error('Error fetching checkout data', error);
        if (error.response && error.response.status === 400) {
            toastMessage.value = 'El carrito está vacío';
            toast.value.show();
            setTimeout(() => router.push('/cart'), 2000);
        }
    }
};

onMounted(() => {
    if (cartStore.cartCount === 0) {
        router.push('/cart');
    } else {
        fetchCheckoutData();
    }
});

const handlePayment = async () => {
    isLoading.value = true;
    errors.value = {};

    const payload = {
        payment_method: paymentMethod.value,
    };

    if (paymentMethod.value === 'saved_card') {
        payload.card_id = selectedCardId.value;
    } else {
        payload.card_number = newCard.value.card_number;
        payload.card_holder_name = newCard.value.card_holder_name;
        payload.expiration_date = newCard.value.expiration_date;
        payload.cvv = newCard.value.cvv;
        payload.save_card = newCard.value.save_card;
    }

    try {
        // Single payment call
        const response = await api.post('/checkout', payload);

        cartStore.clearCart();

        if (response.data && response.data.data && response.data.data.order_id) {
            router.push(`/checkout/success/${response.data.data.order_id}`);
        } else {
            // Fallback if no order ID
            toastMessage.value = '¡Pago realizado con éxito!';
            toast.value.show();
            setTimeout(() => {
                router.push('/');
            }, 2000);
        }
    } catch (error) {
        console.error('Payment failed', error);
        if (error.response && error.response.data && error.response.data.info) {
            errors.value = error.response.data.info;
        } else if (error.response && error.response.data.message) {
            toastMessage.value = error.response.data.message;
            toast.value.show();
        } else {
            toastMessage.value = 'Error procesando el pago';
            toast.value.show();
        }
    } finally {
        isLoading.value = false;
    }
};

const formatPrice = (value) => {
    return parseFloat(value).toFixed(2) + ' €';
};

</script>

<template>
    <div class="checkout-page">
        <div class="checkout-container">
            <h1>Finalizar Compra</h1>

            <div class="checkout-grid">
                <!-- Order Summary -->
                <div class="order-summary">
                    <h2>Resumen del Pedido</h2>

                    <div v-for="(item, index) in cartItems" :key="index" class="order-item">
                        <div class="item-info">
                            <h4>{{ item.product.name }}</h4>
                            <p>{{ item.quantity }} x {{ formatPrice(item.product.final_price || item.product.price) }}
                            </p>
                            <small v-if="item.platform">Plataforma: {{ item.platform.name }}</small>
                        </div>
                        <span class="item-total">{{ formatPrice((item.product.final_price || item.product.price) *
                            item.quantity) }}</span>
                    </div>

                    <div class="order-total">
                        <strong>Total:</strong>
                        <span>{{ formatPrice(total) }}</span>
                    </div>
                </div>

                <!-- Payment Form -->
                <div class="payment-section">
                    <h2>Método de Pago</h2>

                    <form @submit.prevent="handlePayment">
                        <!-- Payment Method Selection -->
                        <div class="payment-methods">
                            <label>
                                <input type="radio" value="saved_card" v-model="paymentMethod"
                                    :disabled="savedCards.length === 0">
                                <span class="radio-label">Tarjeta guardada</span>
                            </label>

                            <label>
                                <input type="radio" value="new_card" v-model="paymentMethod">
                                <span class="radio-label">Nueva tarjeta</span>
                            </label>
                        </div>

                        <!-- Saved Cards -->
                        <div v-if="paymentMethod === 'saved_card'" class="saved-cards">
                            <div class="form-group">
                                <label for="card_id">Selecciona tu tarjeta</label>
                                <select v-model="selectedCardId" id="card_id" class="form-select" required>
                                    <option v-for="card in savedCards" :key="card.id" :value="card.id">
                                        {{ card.masked_card_number }} - {{ card.card_holder_name }}
                                    </option>
                                </select>
                                <span v-if="errors.card_id" class="error-text">{{ errors.card_id[0] }}</span>
                            </div>
                        </div>

                        <!-- New Card -->
                        <div v-if="paymentMethod === 'new_card'" class="new-card-form">
                            <div class="form-group">
                                <label for="card_number">Número de tarjeta *</label>
                                <input type="text" v-model="newCard.card_number" id="card_number" class="form-control"
                                    placeholder="1234 5678 9012 3456" :class="{ 'is-invalid': errors.card_number }">
                                <span v-if="errors.card_number" class="error-text">{{ errors.card_number[0] }}</span>
                            </div>

                            <div class="form-group">
                                <label for="card_holder_name">Titular de la tarjeta *</label>
                                <input type="text" v-model="newCard.card_holder_name" id="card_holder_name"
                                    class="form-control" placeholder="JUAN PÉREZ"
                                    :class="{ 'is-invalid': errors.card_holder_name }">
                                <span v-if="errors.card_holder_name" class="error-text">{{ errors.card_holder_name[0]
                                }}</span>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="expiration_date">Fecha de expiración *</label>
                                    <input type="text" v-model="newCard.expiration_date" id="expiration_date"
                                        class="form-control" placeholder="MM/AA"
                                        :class="{ 'is-invalid': errors.expiration_date }">
                                    <span v-if="errors.expiration_date" class="error-text">{{ errors.expiration_date[0]
                                    }}</span>
                                </div>

                                <div class="form-group">
                                    <label for="cvv">CVV *</label>
                                    <input type="text" v-model="newCard.cvv" id="cvv" class="form-control"
                                        placeholder="123" :class="{ 'is-invalid': errors.cvv }">
                                    <span v-if="errors.cvv" class="error-text">{{ errors.cvv[0] }}</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="checkbox-label">
                                    <input type="checkbox" v-model="newCard.save_card">
                                    <span>Guardar tarjeta para futuras compras</span>
                                </label>
                            </div>
                        </div>

                        <div class="form-actions">
                            <RouterLink to="/cart" class="btn-secondary">Volver al carrito</RouterLink>
                            <button type="submit" class="btn-primary" :disabled="isLoading">
                                {{ isLoading ? 'Procesando...' : `Pagar ${formatPrice(total)}` }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <ToastNotification ref="toast" :message="toastMessage" />
    </div>
</template>

<style scoped lang="scss">
@use "../assets/scss/pages/_checkout.scss";
</style>
