<script setup>
import { ref, onMounted } from 'vue';

const props = defineProps({
    message: String,
    type: {
        type: String,
        default: 'success'
    },
    duration: {
        type: Number,
        default: 3000
    }
});

const isVisible = ref(false);

const show = () => {
    isVisible.value = true;
    setTimeout(() => {
        isVisible.value = false;
    }, props.duration);
};

defineExpose({ show });
</script>

<template>
    <div v-if="isVisible" :class="['toast-notification', type, { 'show': isVisible }]">
        <span>{{ type === 'success' ? '✅' : 'ℹ️' }}</span> {{ message }}
    </div>
</template>

<style scoped lang="scss">
.toast-notification {
    position: fixed;
    bottom: 20px;
    right: 20px;
    padding: 15px 25px;
    background-color: white;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    border-radius: 8px;
    display: flex;
    align-items: center;
    gap: 10px;
    z-index: 1000;
    transform: translateY(100px);
    opacity: 0;
    transition: all 0.3s ease;
    font-weight: 500;
    color: #333;

    &.success {
        border-left: 5px solid #28a745;
    }

    &.error {
        border-left: 5px solid #dc3545;
    }

    &.show {
        transform: translateY(0);
        opacity: 1;
    }
}
</style>
