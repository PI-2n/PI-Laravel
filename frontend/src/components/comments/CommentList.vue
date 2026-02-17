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

// Check if current user has already commented
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

        <!-- Form to add new comment -->
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

        <!-- List of comments -->
        <div v-if="comments.length > 0" class="comments-list">
            <CommentItem v-for="comment in comments" :key="comment.id" :comment="comment" :product-id="productId"
                @updated="handleRefresh" @deleted="handleRefresh" />
        </div>
        <div v-else class="no-comments">
            No hay comentarios aún. ¡Sé el primero en opinar!
        </div>
    </div>
</template>

<style scoped lang="scss">
.comments-section {
    margin-top: 40px;

    h2 {
        color: #fff;
        margin-bottom: 20px;
        font-size: 1.5rem;
        font-weight: bold;
    }

    .msg-alert {
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 15px;
        background-color: #333;
        color: #fff;
        text-align: center;
        font-style: italic;
    }

    .login-alert {
        background-color: #1a1a1a; // $color-bg-secondary
        padding: 20px;
        border-radius: 8px;
        text-align: center;
        margin-bottom: 20px;
        border: 1px solid #333333;

        p {
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 15px;
        }

        .btn-login {
            display: inline-block;
            padding: 10px 20px;
            background-color: #dd7710ec;
            color: white;
            border-radius: 4px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.2s;

            &:hover {
                background-color: rgba(255, 165, 0, 1);
            }
        }
    }

    .comments-list {
        display: flex;
        flex-direction: column;
    }

    .no-comments {
        text-align: center;
        color: #777;
        padding: 30px;
        background-color: #1a1a1a;
        border-radius: 8px;
        border: 1px dashed #333;
    }
}
</style>
