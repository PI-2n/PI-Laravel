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
