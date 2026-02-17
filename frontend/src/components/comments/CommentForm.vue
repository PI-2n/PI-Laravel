<script setup>
import { ref, watch } from 'vue';
import { useCommentStore } from '../../stores/comment';
// import { useToast } from 'vue-toast-notification';

const props = defineProps({
    productId: {
        type: [Number, String],
        required: true
    },
    comment: {
        type: Object,
        default: null
    },
    isEditing: {
        type: Boolean,
        default: false
    }
});

const emit = defineEmits(['saved', 'cancelled']);

const store = useCommentStore();
const rating = ref(5);
const message = ref('');
const loading = ref(false);
const error = ref(null);

watch(() => props.comment, (newComment) => {
    if (newComment) {
        rating.value = newComment.rating;
        message.value = newComment.message || newComment.content; // Handle both fields
    }
}, { immediate: true });

const submitComment = async () => {
    loading.value = true;
    error.value = null;

    try {
        if (props.isEditing) {
            await store.updateComment(props.comment.id, {
                rating: rating.value,
                message: message.value
            });
        } else {
            await store.addComment(props.productId, {
                rating: rating.value,
                message: message.value
            });
            // Reset form
            rating.value = 5;
            message.value = '';
        }
        emit('saved');
    } catch (err) {
        if (err.response && err.response.data && err.response.data.message) {
            error.value = err.response.data.message;
        } else {
            error.value = 'Ocurrió un error al guardar el comentario.';
        }
    } finally {
        loading.value = false;
    }
};
</script>

<template>
    <div class="comment-form-container">
        <h3>{{ isEditing ? 'Editar Comentario' : 'Deja tu opinión' }}</h3>

        <div v-if="error" class="msg-alert error">
            {{ error }}
        </div>

        <form @submit.prevent="submitComment">
            <div class="form-group">
                <label>Puntuación:</label>
                <div class="rating-input">
                    <button v-for="star in 5" :key="star" type="button" @click="rating = star"
                        :class="{ 'active': star <= rating }">
                        ★
                    </button>
                </div>
            </div>

            <div class="form-group">
                <label>Tu comentario:</label>
                <textarea v-model="message" rows="3" placeholder="Escribe aquí tu opinión sobre el producto..."
                    required></textarea>
            </div>

            <div class="form-actions">
                <button v-if="isEditing" type="button" @click="$emit('cancelled')" class="btn-cancel"
                    :disabled="loading">
                    Cancelar
                </button>
                <button type="submit" class="btn-submit" :disabled="loading">
                    {{ loading ? 'Guardando...' : (isEditing ? 'Actualizar' : 'Publicar') }}
                </button>
            </div>
        </form>
    </div>
</template>
