import { computed } from 'vue';
import { useAuthStore } from '../stores/auth';

export function useRole() {
    const authStore = useAuthStore();

    const role = computed(() => {
        if (!authStore.user) return 'guest';
        switch (authStore.user.role_id) {
            case 1: return 'admin';
            case 2: return 'moderator';
            case 3: return 'customer';
            default: return 'customer';
        }
    });

    const is = (roleName) => role.value === roleName;

    const can = (permission) => {
        const currentRole = role.value;

        const permissions = {
            admin: ['create', 'edit', 'delete', 'moderate', 'view_admin_panel'],
            moderator: ['moderate', 'view_admin_panel'],
            customer: ['read', 'comment', 'rate', 'buy'],
            guest: ['read']
        };

        if (currentRole === 'admin') return true;

        return permissions[currentRole]?.includes(permission) ?? false;
    };

    return {
        role,
        is,
        can
    };
}
