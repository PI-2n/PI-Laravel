<script setup>
import { useRole } from '../composables/useRole';

const props = defineProps({
    permission: {
        type: String,
        required: true
    }
});

const { can } = useRole();
</script>

<template>
    <template v-if="can(permission)">
        <slot />
    </template>
</template>
