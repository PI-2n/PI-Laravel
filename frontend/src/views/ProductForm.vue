<script setup>
import { ref, onMounted, computed, watch } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import api from '../services/api';
import { useAuthStore } from '../stores/auth';

const route = useRoute();
const router = useRouter();
const authStore = useAuthStore();

const isEditing = computed(() => !!route.params.id);
const productId = route.params.id;

const form = ref({
    sku: '',
    name: '',
    price: '',
    description: '',
    tag_ids: [],
    image_url: null,
    video_url: null,
    is_offer: false,
    offer_percentage: '',
    offer_start_date: '',
    offer_end_date: '',
    active: true,
    featured: false
});

const tags = ref([]);
const errors = ref({});
const isLoading = ref(false);
const currentImage = ref(null);
const currentVideo = ref(null);

onMounted(async () => {
    try {
        const response = await api.get('/tags');
        tags.value = response.data;
    } catch (error) {
        console.error('Error fetching tags:', error);
    }

    if (isEditing.value) {
        fetchProduct();
    }
});

const fetchProduct = async () => {
    isLoading.value = true;
    try {
        const response = await api.get(`/products/${productId}`);
        const product = response.data.data;

        form.value.sku = product.sku;
        form.value.name = product.name;
        form.value.price = product.price;
        form.value.description = product.description;
        form.value.is_offer = !!product.is_offer;
        form.value.offer_percentage = product.offer_percentage;
        form.value.offer_start_date = product.offer_start_date;
        form.value.offer_end_date = product.offer_end_date;
        form.value.active = !!product.active;
        form.value.featured = !!product.featured;

        if (product.tags) {
            form.value.tag_ids = product.tags.map(tag => tag.id);
        }

        currentImage.value = product.image_url;
        currentVideo.value = product.video_url;

    } catch (error) {
        console.error('Error fetching product:', error);
        router.push('/products');
    } finally {
        isLoading.value = false;
    }
};

const handleFileChange = (event, field) => {
    form.value[field] = event.target.files[0];
};

const submitForm = async () => {
    errors.value = {};
    isLoading.value = true;

    const formData = new FormData();

    formData.append('sku', form.value.sku);
    formData.append('name', form.value.name);
    formData.append('price', form.value.price);
    formData.append('description', form.value.description);
    formData.append('is_offer', form.value.is_offer ? 1 : 0);
    formData.append('active', form.value.active ? 1 : 0);
    formData.append('featured', form.value.featured ? 1 : 0);

    if (form.value.offer_percentage) formData.append('offer_percentage', form.value.offer_percentage);
    if (form.value.offer_start_date) formData.append('offer_start_date', form.value.offer_start_date);
    if (form.value.offer_end_date) formData.append('offer_end_date', form.value.offer_end_date);

    form.value.tag_ids.forEach(id => formData.append('tag_ids[]', id));

    if (form.value.image_url instanceof File) {
        formData.append('image_url', form.value.image_url);
    }
    if (form.value.video_url instanceof File) {
        formData.append('video_url', form.value.video_url);
    }

    try {
        if (isEditing.value) {
            formData.append('_method', 'PUT');
            await api.post(`/products/${productId}`, formData, {
                headers: { 'Content-Type': 'multipart/form-data' }
            });
        } else {
            await api.post('/products', formData, {
                headers: { 'Content-Type': 'multipart/form-data' }
            });
        }
        router.push('/products');
    } catch (error) {
        console.error('Submission error:', error);
        if (error.response && error.response.data.errors) {
            errors.value = error.response.data.errors;
            window.scrollTo({ top: 0, behavior: 'smooth' });
            console.log('Validation errors:', errors.value);
        } else {
            console.error('Error saving product:', error);
            alert('Error al guardar: ' + JSON.stringify(error.response?.data || error.message));
        }
    } finally {
        isLoading.value = false;
    }
};

watch(() => form.value.is_offer, (newValue) => {
    if (newValue) {
        form.value.offer_start_date = new Date().toISOString().split('T')[0];
        form.value.offer_end_date = '';
    } else {
        form.value.offer_percentage = '';
    }
});

const formTitle = computed(() => isEditing.value ? 'Editar Producto' : 'Crear Nuevo Producto');
const formSubtitle = computed(() => isEditing.value ? `Modifica la información del producto "${form.value.name}"` : 'Completa la información del producto');
const imageLabel = computed(() => isEditing.value ? 'Nueva Imagen (dejar vacío para mantener actual)' : 'Imagen del Producto *');
const videoLabel = computed(() => isEditing.value ? 'Nuevo Video (dejar vacío para mantener actual)' : 'Video del Producto (Opcional)');
const offerLabel = computed(() => isEditing.value ? 'Listar en ofertas' : '¿Este producto está en oferta AHORA?');
const submitButtonText = computed(() => {
    if (isLoading.value) return 'Guardando...';
    return isEditing.value ? 'Actualizar Producto' : 'Crear Producto';
});

</script>

<template>
    <div class="product-form-container">
        <div class="form-header">
            <h1 class="form-title">{{ formTitle }}</h1>
            <p class="form-subtitle">{{ formSubtitle }}</p>
        </div>

        <div v-if="Object.keys(errors).length > 0" class="error-summary">
            <p>Por favor, corrige los siguientes errores:</p>
            <ul>
                <li v-for="(fieldErrors, field) in errors" :key="field">
                    {{ fieldErrors[0] }}
                </li>
            </ul>
        </div>

        <form @submit.prevent="submitForm" class="product-form" enctype="multipart/form-data">

            <div class="form-section">
                <h2 class="section-title">Información Básica</h2>

                <div class="form-group">
                    <label for="sku" class="form-label">SKU (Código de Producto) *</label>
                    <input type="text" id="sku" v-model="form.sku" required class="form-input"
                        placeholder="Ej: SMART-001" maxlength="50">
                    <p class="form-hint">Código único para identificar el producto</p>
                    <span v-if="errors.sku" class="error-message">{{ errors.sku[0] }}</span>
                </div>

                <div class="form-group">
                    <label for="name" class="form-label">Nombre del Producto *</label>
                    <input type="text" id="name" v-model="form.name" required class="form-input"
                        placeholder="Ej: Smartphone Pro Max">
                    <span v-if="errors.name" class="error-message">{{ errors.name[0] }}</span>
                </div>

                <div class="form-group">
                    <label class="form-label">Categorías (Tags)</label>
                    <div class="tags-container">
                        <div v-for="tag in tags" :key="tag.id" class="tag-checkbox-group">
                            <input type="checkbox" :id="`tag_${tag.id}`" :value="tag.id" v-model="form.tag_ids"
                                class="form-checkbox">
                            <label :for="`tag_${tag.id}`" class="form-checkbox-label">
                                {{ tag.name }}
                            </label>
                        </div>
                        <p v-if="tags.length === 0" class="no-tags-message">No hay categorías disponibles.</p>
                    </div>
                    <p class="form-hint">Selecciona todas las categorías que apliquen al producto</p>
                    <span v-if="errors.tag_ids" class="error-message">{{ errors.tag_ids[0] }}</span>
                </div>

                <div class="form-group">
                    <label for="price" class="form-label">Precio (€) *</label>
                    <input type="number" id="price" step="0.01" v-model="form.price" required class="form-input"
                        placeholder="Ej: 999.99" min="0">
                    <span v-if="errors.price" class="error-message">{{ errors.price[0] }}</span>
                </div>

                <div class="form-group">
                    <label for="description" class="form-label">Descripción *</label>
                    <textarea id="description" rows="4" v-model="form.description" class="form-input" required
                        placeholder="Describe las características del producto..."></textarea>
                    <span v-if="errors.description" class="error-message">{{ errors.description[0] }}</span>
                </div>
            </div>

            <div class="form-section">
                <h2 class="section-title">{{ isEditing ? 'Multimedia Actual' : 'Multimedia' }}</h2>

                <div v-if="isEditing" class="current-media">
                    <div v-if="currentImage" class="current-image">
                        <img :src="currentImage" :alt="form.name" class="current-media-preview">
                        <p class="current-media-label">Imagen actual</p>
                    </div>
                    <div v-if="currentVideo" class="current-video">
                        <video :src="currentVideo" controls class="current-media-preview"></video>
                        <p class="current-media-label">Video actual</p>
                    </div>
                </div>

                <div class="form-group">
                    <label for="image_url" class="form-label">
                        {{ isEditing ? 'Nueva Imagen (dejar vacío para mantener actual) ' : 'Imagen del Producto * ' }}
                    </label>
                    <input type="file" id="image_url" @change="e => handleFileChange(e, 'image_url')" accept="image/*"
                        :required="!isEditing" class="form-input-file">
                    <p class="form-hint">Formatos aceptados: JPG, PNG, GIF (máx. 2MB)</p>
                    <span v-if="errors.image_url" class="error-message">{{ errors.image_url[0] }}</span>
                </div>

                <div class="form-group">
                    <label for="video_url" class="form-label">
                        {{ isEditing ? 'Nuevo Video (dejar vacío para mantener actual) '
                            : 'Video del Producto(Opcional)' }}
                    </label>
                    <input type="file" id="video_url" @change="e => handleFileChange(e, 'video_url')" accept="video/*"
                        class="form-input-file">
                    <p class="form-hint">Formatos aceptados: MP4, WEBM (máx. 10MB)</p>
                    <span v-if="errors.video_url" class="error-message">{{ errors.video_url[0] }}</span>
                </div>
            </div>

            <div class="form-section">
                <h2 class="section-title">Configuración de Oferta</h2>

                <div class="form-group form-checkbox-group">
                    <input type="checkbox" id="is_offer" v-model="form.is_offer" class="form-checkbox">
                    <label for="is_offer" class="form-checkbox-label">
                        {{ isEditing ? 'Listar en ofertas' : '¿Este producto está en oferta AHORA ? ' }}</label>
                </div>

                <div id="offer-dates-section" v-show="!form.is_offer">
                    <div class="form-group">
                        <label for="offer_start_date" class="form-label">Fecha de Inicio de Oferta</label>
                        <input type="date" id="offer_start_date" v-model="form.offer_start_date" class="form-input">
                        <p class="form-hint">Deja vacío si no quieres programar una oferta futura</p>
                        <span v-if="errors.offer_start_date" class="error-message">{{ errors.offer_start_date[0]
                            }}</span>
                    </div>

                    <div class="form-group">
                        <label for="offer_end_date" class="form-label">Fecha de Fin de Oferta</label>
                        <input type="date" id="offer_end_date" v-model="form.offer_end_date" class="form-input">
                        <p class="form-hint">Deja vacío si la oferta no tiene fecha de fin</p>
                        <span v-if="errors.offer_end_date" class="error-message">{{ errors.offer_end_date[0] }}</span>
                    </div>
                </div>

                <div class="form-group" id="offer_percentage_group" v-show="form.is_offer">
                    <label for="offer_percentage" class="form-label">Porcentaje de Descuento (%)</label>
                    <input type="number" id="offer_percentage" v-model="form.offer_percentage" min="1" max="100"
                        class="form-input" placeholder="Ej: 20">
                    <p class="form-hint">El precio final será calculado automáticamente</p>

                    <div v-if="isEditing && form.offer_percentage && form.price" class="current-offer-info">
                        Precio actual con oferta: <strong>{{ (form.price * (1 - form.offer_percentage / 100)).toFixed(2)
                            }}€</strong>
                        <br>
                        <span class="old-price">Precio original: {{ parseFloat(form.price).toFixed(2) }}€</span>
                    </div>

                    <span v-if="errors.offer_percentage" class="error-message">{{ errors.offer_percentage[0] }}</span>
                </div>
            </div>

            <div class="form-section">
                <h2 class="section-title">Estado y Visibilidad</h2>

                <div class="form-group form-checkbox-group">
                    <input type="checkbox" id="active" v-model="form.active" class="form-checkbox">
                    <label for="active" class="form-checkbox-label">Producto activo (visible en la tienda)</label>
                </div>

                <div class="form-group form-checkbox-group">
                    <input type="checkbox" id="featured" v-model="form.featured" class="form-checkbox">
                    <label for="featured" class="form-checkbox-label">Destacar como producto principal</label>
                </div>
            </div>

            <div class="form-actions">
                <RouterLink to="/products" class="btn btn-secondary">Cancelar</RouterLink>
                <button type="submit" class="btn btn-primary" :disabled="isLoading">
                    {{ isLoading ? 'Guardando...' : (isEditing ? 'Actualizar Producto' : 'Crear Producto') }}
                </button>
            </div>
        </form>
    </div>
</template>
