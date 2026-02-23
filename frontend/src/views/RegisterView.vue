<script setup>
import { ref } from 'vue';
import { useAuthStore } from '../stores/auth';
import { RouterLink } from 'vue-router';
import { Form, Field, ErrorMessage } from 'vee-validate';
import * as yup from 'yup';

const authStore = useAuthStore();
const isLoading = ref(false);
const apiErrors = ref({});

const schema = yup.object().shape({
    name: yup.string().required('El nombre es obligatorio'),
    last_name: yup.string().required('Los apellidos son obligatorios'),
    email: yup.string().email('Email no válido').required('El email es obligatorio'),
    username: yup.string().required('El nick es obligatorio'),
    password: yup.string().min(6, 'La contraseña debe tener al menos 6 caracteres').required('La contraseña es obligatoria'),
    confirm_password: yup.string()
        .oneOf([yup.ref('password'), null], 'Las contraseñas no coinciden')
        .required('Repetir la contraseña es obligatorio')
});

const handleRegister = async (values) => {
    isLoading.value = true;
    apiErrors.value = {};

    try {
        await authStore.register(values);
    } catch (error) {
        if (error.response && error.response.data && error.response.data.message) {
            if (error.response.data.info) {
                apiErrors.value = error.response.data.info;
            } else {
                apiErrors.value = { general: [error.response.data.message] };
            }
        } else {
            apiErrors.value = { general: ['Ha ocurrido un error inesperado via Api.'] };
        }
    } finally {
        isLoading.value = false;
    }
};
</script>

<template>
    <div class="register-page">
        <h1>Registro</h1>

        <Form :validation-schema="schema" @submit="handleRegister">
            <div v-if="apiErrors.general" class="error-general">
                {{ apiErrors.general[0] }}
            </div>

            <div class="form-group">
                <label for="name">Nombre*:</label>
                <Field name="name" type="text" id="name" />
                <ErrorMessage name="name" class="error-text" />
                <span v-if="apiErrors.name" class="error-text">{{ apiErrors.name[0] }}</span>
            </div>

            <div class="form-group">
                <label for="last_name">Apellidos*:</label>
                <Field name="last_name" type="text" id="last_name" />
                <ErrorMessage name="last_name" class="error-text" />
                <span v-if="apiErrors.last_name" class="error-text">{{ apiErrors.last_name[0] }}</span>
            </div>

            <div class="form-group">
                <label for="email">Email*:</label>
                <Field name="email" type="email" id="email" />
                <ErrorMessage name="email" class="error-text" />
                <span v-if="apiErrors.email" class="error-text">{{ apiErrors.email[0] }}</span>
            </div>

            <div class="form-group">
                <label for="username">Nick*:</label>
                <Field name="username" type="text" id="username" />
                <ErrorMessage name="username" class="error-text" />
                <span v-if="apiErrors.username" class="error-text">{{ apiErrors.username[0] }}</span>
            </div>

            <div class="form-group">
                <label for="password">Contraseña*:</label>
                <Field name="password" type="password" id="password" />
                <ErrorMessage name="password" class="error-text" />
                <span v-if="apiErrors.password" class="error-text">{{ apiErrors.password[0] }}</span>
            </div>

            <div class="form-group">
                <label for="confirm_password">Repetir contraseña*:</label>
                <Field name="confirm_password" type="password" id="confirm_password" />
                <ErrorMessage name="confirm_password" class="error-text" />
                <span v-if="apiErrors.confirm_password" class="error-text">{{ apiErrors.confirm_password[0] }}</span>
            </div>

            <button type="submit" :disabled="isLoading">
                {{ isLoading ? 'Registrando...' : 'Registrarse' }}
            </button>
        </Form>

        <p>¿Ya tienes cuenta? <RouterLink to="/login"><b>Inicia sesión</b></RouterLink>
        </p>
    </div>
</template>
