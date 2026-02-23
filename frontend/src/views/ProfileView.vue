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
        authStore.setUser(response.data.data);
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
        await authStore.logout(false);
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
        importFile.value = null;
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

                <section>
                    <header>
                        <h3>Información del Perfil</h3>
                        <p class="description">Actualiza la información de tu perfil y la dirección de correo
                            electrónico.</p>
                    </header>

                    <form @submit.prevent="updateProfile" class="profile-form">
                        <div class="form-group">
                            <label for="username">Nombre de usuario</label>
                            <input id="username" type="text" v-model="user.username" class="form-control" required
                                autocomplete="username">
                            <span v-if="errors.username" class="error-text">{{ errors.username[0] }}</span>
                        </div>

                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input id="name" type="text" v-model="user.name" class="form-control" required
                                autocomplete="given-name">
                            <span v-if="errors.name" class="error-text">{{ errors.name[0] }}</span>
                        </div>

                        <div class="form-group">
                            <label for="last_name">Apellidos</label>
                            <input id="last_name" type="text" v-model="user.last_name" class="form-control" required
                                autocomplete="family-name">
                            <span v-if="errors.last_name" class="error-text">{{ errors.last_name[0] }}</span>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="email" type="email" v-model="user.email" class="form-control" required
                                autocomplete="email">
                            <span v-if="errors.email" class="error-text">{{ errors.email[0] }}</span>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn-primary">Guardar</button>
                        </div>
                    </form>
                </section>

                <div class="section-divider"></div>

                <section>
                    <header>
                        <h3>Actualizar Contraseña</h3>
                        <p class="description">Asegúrate de que tu cuenta esté usando una contraseña larga y aleatoria
                            para mantenerla segura.</p>
                    </header>

                    <form @submit.prevent="updatePassword" class="profile-form">
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

                <section>
                    <header>
                        <h3>Borrar Cuenta</h3>
                        <p class="description">Una vez que se elimine tu cuenta, todos sus recursos y datos se
                            eliminarán permanentemente.</p>
                    </header>

                    <form @submit.prevent="deleteAccount" class="profile-form">
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

                <div class="section-divider"></div>

                <section>
                    <header>
                        <h3>Documentación API</h3>
                        <p class="description">Accede a la documentación completa de la API para desarrolladores.</p>
                    </header>

                    <div class="profile-form">
                        <div class="form-actions" style="margin-top: 1rem;">
                            <a href="http://localhost:8000/docs" target="_blank" class="btn-secondary"
                                style="text-decoration: none; display: inline-block;">
                                Ver Documentación
                            </a>
                        </div>
                    </div>
                </section>
            </div>
        </div>

        <div class="profile-sidebar">
            <div class="profile-container sidebar-item">
                <h3>Cerrar Sesión</h3>
                <button @click="logout" class="btn-secondary btn-block">Cerrar sesión</button>
            </div>

            <template v-if="authStore.isAdmin">
                <div class="admin-separator">
                    <span>PANEL DE ADMINISTRADOR</span>
                </div>

                <div class="profile-container sidebar-item">
                    <h3 class="add-product-title">Añadir producto</h3>
                    <div class="product-actions">
                        <RouterLink to="/products/create" class="btn-secondary btn-block">
                            Añadir Producto
                        </RouterLink>
                    </div>
                </div>

                <div class="profile-container sidebar-item">
                    <h3>Importar productos desde Excel</h3>
                    <div class="product-actions mt-2">
                        <form @submit.prevent="importProducts">
                            <input type="file" @change="handleFileChange" required class="file-input btn-block"
                                accept=".xlsx, .csv, .xls">
                            <span v-if="importError" class="error-text block-display mt-2">{{ importError }}</span>
                            <button type="submit" class="btn-secondary btn-block mt-2">
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
