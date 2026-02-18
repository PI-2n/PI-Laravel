<script setup>
import { ref } from 'vue';
import { useAuthStore } from '../stores/auth';
import { useRouter } from 'vue-router';

const authStore = useAuthStore();
const router = useRouter();

const email = ref('');
const password = ref('');
const errorMessage = ref('');

const handleLogin = async () => {
    try {
        await authStore.login({ email: email.value, password: password.value });
    } catch (error) {
        errorMessage.value = 'Invalid credentials. Please try again.';
        if (error.response && error.response.data.message) {
            errorMessage.value = error.response.data.message;
        }
    }
};
</script>

<template>
    <div class="login-page">
        <div v-if="errorMessage" class="error-message">
            {{ errorMessage }}
        </div>

        <form @submit.prevent="handleLogin">
            <label>Email:
                <input v-model="email" type="email" name="email" required placeholder="admin@example.com">
            </label>

            <label>Contraseña:
                <input v-model="password" type="password" name="password" required placeholder="password">
            </label>

            <button type="submit">Iniciar sesión</button>

            <div class="google-login">
                <a href="http://localhost:8000/api/auth/google/redirect" class="btn-google">
                    <div class="icon-wrapper">
                        <img src="/images/icons/google.png" alt="Google">
                    </div>
                    <span>Iniciar sesión con Google</span>
                </a>
            </div>
        </form>

        <p>No tienes cuenta? <a href="register"><b>Regístrate</b></a></p>
    </div>
</template>
