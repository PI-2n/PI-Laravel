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

<style scoped lang="scss">
.comment-form-container {
    margin-top: 30px;
    padding: 20px;
    background-color: #1a1a1a;
    border-radius: 8px;

    h3 {
        margin-bottom: 15px;
        color: #fff;
    }

    .msg-alert {
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 15px;

        &.error {
            background: #4a1212;
            color: #ff8a8a;
        }
    }

    .form-group {
        margin-bottom: 15px;

        label {
            display: block;
            margin-bottom: 5px;
            color: #fff;
        }

        textarea {
            background-color: #333333;
            border: 1px solid #777777;
            color: #fff;
            padding: 10px;
            border-radius: 4px;
            width: 100%;
            font-family: inherit;
            font-size: 1rem;
            resize: vertical;

            &:focus {
                outline: none;
                border-color: #dd7710ec;
            }
        }
    }

    .rating-input {
        display: flex;
        gap: 5px;

        button {
            background: none;
            border: none;
            font-size: 1.5rem;
            color: #777;
            cursor: pointer;
            transition: color 0.2s;
            padding: 0;

            &.active,
            &:hover {
                color: #dd7710ec;
            }
        }
    }

    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
    }

    .btn-submit {
        padding: 10px 20px;
        background-color: #dd7710ec;
        color: white;
        border: none;
        cursor: pointer;
        font-weight: bold;
        border-radius: 4px;
        transition: all 0.2s ease;

        &:hover {
            background-color: rgba(255, 165, 0, 1);
        }

        &:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }
    }

    .btn-cancel {
        padding: 10px 20px;
        background-color: #333;
        color: white;
        border: none;
        cursor: pointer;
        border-radius: 4px;

        &:hover {
            background-color: #444;
        }
    }
}
</style>
