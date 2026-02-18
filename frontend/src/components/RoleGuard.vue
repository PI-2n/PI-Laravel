<script setup>
import { computed } from 'vue';
import { computed } from 'vue';
import { useRole } from '../composables/useRole';

const props = defineProps({
    roles: {
        type: Array, // ['admin', 'editor']
        default: () => []
    },
    permission: {
        type: String, // 'create', 'edit'
        default: ''
    }
});

const { role, can } = useRole();

const hasAccess = computed(() => {
    if (props.roles.length > 0) {
        return props.roles.includes(role.value);
    }
    if (props.permission) {
        return can(props.permission);
    }
    return true;
});
</script>

<template>
    <template v-if="hasAccess">
        <slot></slot>
    </template>
</template>
