<script setup>
import { ref, computed } from 'vue';
import { useAuthStore } from '../../stores/auth';
import { useCommentStore } from '../../stores/comment';
import CommentForm from './CommentForm.vue';

const props = defineProps({
    comment: {
        type: Object,
        required: true
    },
    productId: {
        type: [Number, String],
        required: true
    }
});

const emit = defineEmits(['updated', 'deleted']);

const authStore = useAuthStore();
const commentStore = useCommentStore();
const isEditing = ref(false);
const isDeleting = ref(false);

const canEdit = computed(() => {
    return authStore.user && authStore.user.id === props.comment.user.id;
});

const canDelete = computed(() => {
    return authStore.user && (
        authStore.user.id === props.comment.user.id ||
        authStore.isAdmin ||
        (authStore.user.role_id === 2) // Assuming role_id 2 is moderator, adjust if necessary based on DB
    );
});

const handleDelete = async () => {
    if (!confirm('¿Estás seguro de querer eliminar este comentario?')) return;

    isDeleting.value = true;
    try {
        await commentStore.deleteComment(props.comment.id);
        emit('deleted', props.comment.id);
    } catch (error) {
        console.error('Error deleting comment:', error);
        alert('No se pudo eliminar el comentario.');
    } finally {
        isDeleting.value = false;
    }
};

const handleSaved = () => {
    isEditing.value = false;
    emit('updated');
};
</script>

<template>
    <div class="comment-item">
        <div v-if="isEditing">
            <CommentForm :product-id="productId" :comment="comment" :is-editing="true" @saved="handleSaved"
                @cancelled="isEditing = false" />
        </div>
        <div v-else>
            <div class="comment-header">
                <div>
                    <strong>{{ comment.user.name }}</strong>
                    <span class="comment-date">{{ comment.formatted_date || comment.created_at }}</span>
                </div>
                <div class="rating">
                    <span v-for="n in 5" :key="n">{{ n <= comment.rating ? '★' : '☆' }}</span>
                </div>
            </div>

            <p class="comment-content">{{ comment.message || comment.content }}</p>

            <div v-if="authStore.isAuthenticated" class="comment-actions">
                <button v-if="canEdit" @click="isEditing = true" class="btn-edit-comment">
                    Editar
                </button>
                <button v-if="canDelete" @click="handleDelete" class="btn-delete-comment" :disabled="isDeleting">
                    {{ isDeleting ? 'Eliminando...' : 'Eliminar' }}
                </button>
            </div>
        </div>
    </div>
</template>

<style scoped lang="scss">
.comment-item {
    border-bottom: 1px solid #333333;
    padding: 15px 0;
    position: relative;
    color: #fff;

    .comment-header {
        display: flex;
        justify-content: space-between;
        margin-bottom: 5px;

        strong {
            display: block;
            font-size: 1rem;
        }

        .rating {
            color: #dd7710ec;
            font-size: 1.2rem;
        }
    }

    .comment-date {
        display: block;
        color: #777777;
        font-size: 0.85rem;
    }

    .comment-content {
        color: rgba(255, 255, 255, 0.9);
        white-space: pre-line;
        margin-top: 5px;
    }

    .comment-actions {
        margin-top: 10px;
        display: flex;
        gap: 10px;

        .btn-edit-comment,
        .btn-delete-comment {
            padding: 5px 10px;
            font-size: 0.85rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-edit-comment {
            background-color: rgba(221, 119, 16, 0.2); // $color-accent with opacity
            color: #dd7710ec;

            &:hover {
                background-color: rgba(221, 119, 16, 0.4);
            }
        }

        .btn-delete-comment {
            background-color: rgba(255, 100, 100, 0.2);
            color: #ff6464;

            &:hover {
                background-color: rgba(255, 100, 100, 0.4);
            }
        }
    }
}
</style>
