<script setup>
import { computed } from 'vue';
import { useAuthStore } from '../../stores/auth';
import CommentItem from './CommentItem.vue';
import CommentForm from './CommentForm.vue';

const props = defineProps({
    comments: {
        type: Array,
        default: () => []
    },
    productId: {
        type: [Number, String],
        required: true
    }
});

const emit = defineEmits(['refresh']);

const authStore = useAuthStore();

const userHasCommented = computed(() => {
    if (!authStore.user || !props.comments) return false;
    return props.comments.some(c => c.user.id === authStore.user.id);
});

const handleRefresh = () => {
    emit('refresh');
};
</script>

<template>
    <div class="comments-section">
        <h2>Comentarios ({{ comments.length }})</h2>

        <div v-if="authStore.isAuthenticated" class="mb-4">
            <div v-if="!userHasCommented">
                <CommentForm :product-id="productId" @saved="handleRefresh" />
            </div>
            <div v-else class="msg-alert info">
                Ya has opinado sobre este producto. Puedes editar tu comentario abajo.
            </div>
        </div>
        <div v-else class="login-alert">
            <p>Inicia sesión para dejar tu opinión.</p>
            <router-link to="/login" class="btn-login">
                Iniciar Sesión
            </router-link>
        </div>

        <div v-if="comments.length > 0" class="comments-list">
            <CommentItem v-for="comment in comments" :key="comment.id" :comment="comment" :product-id="productId"
                @updated="handleRefresh" @deleted="handleRefresh" />
        </div>
        <div v-else class="no-comments">
            No hay comentarios aún. ¡Sé el primero en opinar!
        </div>
    </div>
</template>
