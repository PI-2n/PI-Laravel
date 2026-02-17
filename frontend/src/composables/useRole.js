import { storeToRefs } from 'pinia'
import { useAuthStore } from '../stores/auth'

export function useRole() {
    const authStore = useAuthStore()
    const { user } = storeToRefs(authStore)

    const can = (permission) => {
        const role = user.value?.role

        const rules = {
            admin: ['create', 'edit', 'delete', 'moderate', 'view_admin'],
            vendor: ['create', 'edit', 'delete', 'view_vendor'],
            editor: ['moderate', 'view_editor'],
            user: ['read', 'view_user']
        }

        if (rules[role]?.includes(permission)) {
            return true;
        }

        if (role === permission) {
            return true;
        }

        return false
    }

    const hasRole = (roleName) => {
        return user.value?.role === roleName;
    }

    return { can, hasRole, user }
}
