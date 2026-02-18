<script setup>
import { ref } from 'vue';
import { useAuthStore } from '../stores/auth';
import { useRouter } from 'vue-router';
import { Form, Field, ErrorMessage } from 'vee-validate';
import * as yup from 'yup';

const authStore = useAuthStore();
const router = useRouter();

const errorMessage = ref('');

const schema = yup.object().shape({
    email: yup.string().email('Email no válido').required('El email es obligatorio'),
    password: yup.string().required('La contraseña es obligatoria')
});

const handleLogin = async (values) => {
    try {
        await authStore.login(values);
    } catch (error) {
        errorMessage.value = 'Credenciales inválidas. Por favor, inténtalo de nuevo.';
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

        <Form :validation-schema="schema" @submit="handleLogin">
            <label>Email:
                <Field name="email" type="email" placeholder="admin@example.com" />
                <ErrorMessage name="email" class="error-text" />
            </label>

            <label>Contraseña:
                <Field name="password" type="password" placeholder="password" />
                <ErrorMessage name="password" class="error-text" />
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
        </Form>

        <p>No tienes cuenta? <a href="register"><b>Regístrate</b></a></p>
    </div>
</template>
