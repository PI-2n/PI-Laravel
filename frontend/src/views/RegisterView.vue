<script setup>
import { reactive, ref } from 'vue';
import { useAuthStore } from '../stores/auth';
import { RouterLink } from 'vue-router';

const authStore = useAuthStore();

const form = reactive({
    name: '',
    last_name: '',
    email: '',
    username: '',
    password: '',
    confirm_password: ''
});

const errors = ref({});
const isLoading = ref(false);

const handleRegister = async () => {
    isLoading.value = true;
    errors.value = {};

    try {
        await authStore.register(form);
    } catch (error) {
        if (error.response && error.response.data && error.response.data.message) {
            // Handle validation errors from BaseController: { success: false, message: "Error validation", info: { field: [error] } }
            if (error.response.data.info) {
                errors.value = error.response.data.info;
            } else {
                errors.value = { general: [error.response.data.message] };
            }
        } else {
            errors.value = { general: ['Ha ocurrido un error inesperado via Api.'] };
        }
    } finally {
        isLoading.value = false;
    }
};
</script>

<template>
    <div class="login-page">
        <!-- Reusing login-page class for styling as it shares structure -->
        <h1 class="text-white text-2xl mb-4 font-bold">Registro</h1>

        <form @submit.prevent="handleRegister">
            <div v-if="errors.general" class="mb-4 text-red-500">
                {{ errors.general[0] }}
            </div>

            <label for="name">Nombre*:</label>
            <input type="text" id="name" v-model="form.name" required>
            <span v-if="errors.name" class="text-red-500 text-sm">{{ errors.name[0] }}</span>

            <label for="last_name">Apellidos*:</label>
            <input type="text" id="last_name" v-model="form.last_name" required>
            <span v-if="errors.last_name" class="text-red-500 text-sm">{{ errors.last_name[0] }}</span>

            <label for="email">Email*:</label>
            <input type="email" id="email" v-model="form.email" required>
            <span v-if="errors.email" class="text-red-500 text-sm">{{ errors.email[0] }}</span>

            <label for="username">Nick*:</label>
            <input type="text" id="username" v-model="form.username" required>
            <span v-if="errors.username" class="text-red-500 text-sm">{{ errors.username[0] }}</span>

            <label for="password">Contraseña*:</label>
            <input type="password" id="password" v-model="form.password" required>
            <span v-if="errors.password" class="text-red-500 text-sm">{{ errors.password[0] }}</span>

            <label for="confirm_password">Repetir contraseña*:</label>
            <input type="password" id="confirm_password" v-model="form.confirm_password" required>
            <span v-if="errors.confirm_password" class="text-red-500 text-sm">{{ errors.confirm_password[0] }}</span>

            <button type="submit" :disabled="isLoading">
                {{ isLoading ? 'Registrando...' : 'Registrarse' }}
            </button>
        </form>

        <p>¿Ya tienes cuenta? <RouterLink to="/login"><b>Inicia sesión</b></RouterLink>
        </p>
    </div>
</template>
