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
