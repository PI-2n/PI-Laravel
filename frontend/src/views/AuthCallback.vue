<script setup>
import { onMounted } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import { useAuthStore } from '../stores/auth';

const route = useRoute();
const router = useRouter();
const authStore = useAuthStore();

onMounted(async () => {
    const token = route.query.token;

    if (token) {
        try {
            // Manually set token in store
            localStorage.setItem('token', token);
            authStore.token = token;
            authStore.isAuthenticated = true;

            // Fetch user data
            await authStore.fetchUser();

            // Redirect to home or intended destination
            router.push('/');
        } catch (error) {
            console.error('Error fetching user with Google token:', error);
            router.push('/login?error=auth_failed');
        }
    } else {
        router.push('/login?error=no_token');
    }
});
</script>

<template>
    <div class="callback-container">
        <div class="loading">
            <p>Procesando inicio de sesión...</p>
        </div>
    </div>
</template>
