<script setup>
import { ref } from 'vue';
import { useAuthStore } from '../stores/auth';
import api from '../services/api';
import ToastNotification from '../components/ToastNotification.vue';

const authStore = useAuthStore();
const user = ref({ ...authStore.user });
const passwordForm = ref({
    current_password: '',
    password: '',
    password_confirmation: ''
});
const deleteForm = ref({
    password: ''
});

const errors = ref({});
const passwordErrors = ref({});
const deleteErrors = ref({});
const toast = ref(null);
const toastMessage = ref('');
const toastType = ref('success');

const updateProfile = async () => {
    errors.value = {};
    try {
        const response = await api.patch('/profile', user.value);
        authStore.setUser(response.data.data); // Update store and localStorage
        toastMessage.value = 'Perfil actualizado correctamente.';
        toastType.value = 'success';
        toast.value.show();
    } catch (error) {
        if (error.response && error.response.data.errors) {
            errors.value = error.response.data.errors;
        } else {
            toastMessage.value = 'Error al actualizar el perfil.';
            toastType.value = 'error';
            toast.value.show();
        }
    }
};

const updatePassword = async () => {
    passwordErrors.value = {};
    try {
        await api.put('/password', passwordForm.value);
        toastMessage.value = 'Contraseña actualizada correctamente.';
        toastType.value = 'success';
        toast.value.show();
        passwordForm.value = { current_password: '', password: '', password_confirmation: '' };
    } catch (error) {
        if (error.response && error.response.data.errors) {
            passwordErrors.value = error.response.data.errors;
        } else {
            toastMessage.value = 'Error al actualizar la contraseña.';
            toastType.value = 'error';
            toast.value.show();
        }
    }
};

const deleteAccount = async () => {
    if (!confirm('¿Estás seguro de que quieres eliminar tu cuenta? Esta acción no se puede deshacer.')) return;

    deleteErrors.value = {};
    try {
        await api.delete('/profile', { data: deleteForm.value });
        await authStore.logout(false); // Local logout
    } catch (error) {
        if (error.response && error.response.data.errors) {
            deleteErrors.value = error.response.data.errors;
        } else {
            toastMessage.value = 'Error al eliminar la cuenta.';
            toastType.value = 'error';
            toast.value.show();
        }
    }
};

const logout = async () => {
    await authStore.logout();
};

// Admin Import Logic
const importFile = ref(null);
const importError = ref('');

const handleFileChange = (event) => {
    importFile.value = event.target.files[0];
    importError.value = '';
};

const importProducts = async () => {
    if (!importFile.value) {
        importError.value = 'Por favor, selecciona un archivo.';
        return;
    }

    const formData = new FormData();
    formData.append('file', importFile.value);

    try {
        await api.post('/products/import', formData, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        });
        toastMessage.value = 'Productos importados correctamente.';
        toastType.value = 'success';
        toast.value.show();
        importFile.value = null; // Reset file input
        // Reset file input in DOM
        const fileInput = document.querySelector('.file-input');
        if (fileInput) fileInput.value = '';
    } catch (error) {
        console.error(error);
        if (error.response && error.response.data.errors && error.response.data.errors.file) {
            importError.value = error.response.data.errors.file[0];
        } else if (error.response && error.response.data.message) {
            importError.value = error.response.data.message;
        } else {
            importError.value = 'Error al importar productos.';
        }
    }
};

</script>

<template>
    <div class="profile-page">
        <div class="profile-main">
            <div class="profile-container">
                <h2>Editar Perfil</h2>

                <!-- Update User Info -->
                <section>
                    <header>
                        <h3>Información del Perfil</h3>
                        <p class="description">Actualiza la información de tu perfil y la dirección de correo
                            electrónico.</p>
                    </header>

                    <form @submit.prevent="updateProfile" class="mt-6 space-y-6">
                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input id="name" type="text" v-model="user.name" class="form-control" required autofocus
                                autocomplete="name">
                            <span v-if="errors.name" class="error-text">{{ errors.name[0] }}</span>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="email" type="email" v-model="user.email" class="form-control" required
                                autocomplete="username">
                            <span v-if="errors.email" class="error-text">{{ errors.email[0] }}</span>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn-primary">Guardar</button>
                        </div>
                    </form>
                </section>

                <div class="section-divider"></div>

                <!-- Update Password -->
                <section>
                    <header>
                        <h3>Actualizar Contraseña</h3>
                        <p class="description">Asegúrate de que tu cuenta esté usando una contraseña larga y aleatoria
                            para mantenerla segura.</p>
                    </header>

                    <form @submit.prevent="updatePassword" class="mt-6 space-y-6">
                        <div class="form-group">
                            <label for="current_password">Contraseña Actual</label>
                            <input id="current_password" type="password" v-model="passwordForm.current_password"
                                class="form-control" autocomplete="current-password">
                            <span v-if="passwordErrors.current_password" class="error-text">{{
                                passwordErrors.current_password[0] }}</span>
                        </div>

                        <div class="form-group">
                            <label for="password">Nueva Contraseña</label>
                            <input id="password" type="password" v-model="passwordForm.password" class="form-control"
                                autocomplete="new-password">
                            <span v-if="passwordErrors.password" class="error-text">{{ passwordErrors.password[0]
                            }}</span>
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">Confirmar Contraseña</label>
                            <input id="password_confirmation" type="password"
                                v-model="passwordForm.password_confirmation" class="form-control"
                                autocomplete="new-password">
                            <span v-if="passwordErrors.password_confirmation" class="error-text">{{
                                passwordErrors.password_confirmation[0] }}</span>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn-primary">Guardar</button>
                        </div>

                    </form>
                </section>

                <div class="section-divider"></div>

                <!-- Delete Account -->
                <section>
                    <header>
                        <h3>Borrar Cuenta</h3>
                        <p class="description">Una vez que se elimine tu cuenta, todos sus recursos y datos se
                            eliminarán permanentemente.</p>
                    </header>

                    <form @submit.prevent="deleteAccount" class="mt-6 space-y-6">
                        <div class="form-group">
                            <label for="delete_password">Contraseña</label>
                            <input id="delete_password" type="password" v-model="deleteForm.password"
                                class="form-control" placeholder="Contraseña">
                            <span v-if="deleteErrors.password" class="error-text">{{ deleteErrors.password[0] }}</span>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn-danger">Borrar Cuenta</button>
                        </div>
                    </form>
                </section>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="profile-sidebar">
            <div class="profile-container">
                <h3>Cerrar Sesión</h3>
                <button @click="logout" class="btn-secondary w-full">Cerrar sesión</button>
            </div>

            <template v-if="authStore.isAdmin">
                <div class="profile-container">
                    <h3 class="add-product">Añadir producto</h3>
                    <div class="product-actions">
                        <RouterLink to="/products/create" class="btn-secondary w-full text-center d-block"
                            style="text-decoration: none; display: block;">
                            Añadir Producto
                        </RouterLink>
                    </div>
                </div>

                <div class="profile-container">
                    <h3>Importar productos desde Excel</h3>
                    <div class="product-actions" style="margin-top: 10px;">
                        <form @submit.prevent="importProducts">
                            <input type="file" @change="handleFileChange" required class="file-input w-full"
                                accept=".xlsx, .csv, .xls">
                            <span v-if="importError" class="error-text d-block mt-2">{{ importError }}</span>
                            <button type="submit" class="btn-secondary w-full mt-2" style="margin-top: 10px;">
                                Importar
                            </button>
                        </form>
                    </div>
                </div>
            </template>
        </div>

        <ToastNotification ref="toast" :message="toastMessage" :type="toastType" />
    </div>
</template>

<style scoped lang="scss">
@use "../assets/scss/pages/_profile.scss";

// Additional scoped styles if needed to override or polyfill missing styles
.w-full {
    width: 100%;
}

.mt-6 {
    margin-top: 1.5rem;
}

.space-y-6>*+* {
    margin-top: 1.5rem;
}

.description {
    font-size: 0.9rem;
    color: #cbd5e0;
    margin-bottom: 1rem;
}

.btn-danger {
    background-color: #e53e3e;
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 0.25rem;
    border: none;
    cursor: pointer;
    font-weight: bold;

    &:hover {
        background-color: #c53030;
    }
}
</style>
