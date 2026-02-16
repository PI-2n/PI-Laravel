import { defineStore } from 'pinia';
import { ref, computed } from 'vue';
import api from '../services/api';
import router from '../router';

export const useAuthStore = defineStore('auth', () => {
    // State
    const user = ref(null);
    try {
        const storedUser = localStorage.getItem('user');
        if (storedUser && storedUser !== 'undefined') {
            user.value = JSON.parse(storedUser);
        }
    } catch (e) {
        console.error('Error parsing user from localStorage', e);
        localStorage.removeItem('user');
    }

    const token = ref(localStorage.getItem('token') || null);

    // Getters (computed)
    const isAuthenticated = computed(() => !!token.value);
    const isAdmin = computed(() => user.value && user.value.role_id === 1);

    // Helper to handle AuthController/BaseController response
    const handleAuthResponse = async (response) => {
        // BaseController returns { success: true, data: { ... }, message: ... }
        // Axios wraps in data, so response.data is the JSON body.
        // so response.data.data is the payload.
        const responseData = response.data.data || response.data;

        const newToken = responseData.token || responseData.access_token;
        // AuthController login/register returns 'name' in data, but not full user object usually.
        // We'll trust fetchUser to get the full object.

        token.value = newToken;
        localStorage.setItem('token', newToken);

        // Fetch full user details
        await fetchUser();
    };

    // Actions
    const login = async (credentials) => {
        try {
            const response = await api.post('/login', credentials);
            await handleAuthResponse(response);
            router.push('/');
            return Promise.resolve();
        } catch (error) {
            console.error('Login failed:', error);
            return Promise.reject(error);
        }
    };

    const register = async (userData) => {
        try {
            const response = await api.post('/register', userData);
            await handleAuthResponse(response);
            router.push('/');
            return Promise.resolve();
        } catch (error) {
            console.error('Registration failed:', error);
            return Promise.reject(error);
        }
    };

    const logout = async (callApi = true) => {
        try {
            if (callApi) {
                await api.post('/logout');
            }
        } catch (error) {
            // Ignore logout errors
            console.error('Logout failed:', error);
        } finally {
            user.value = null;
            token.value = null;
            localStorage.removeItem('token');
            localStorage.removeItem('user');
            router.push('/login');
        }
    };

    const fetchUser = async () => {
        if (!token.value) return;
        try {
            const response = await api.get('/user');
            user.value = response.data;
            localStorage.setItem('user', JSON.stringify(user.value));
        } catch (error) {
            // If fetching user fails (e.g. invalid token), logout locally
            logout(false);
        }
    };

    const setUser = (userData) => {
        user.value = userData;
        localStorage.setItem('user', JSON.stringify(userData));
    };

    return {
        user,
        token,
        isAuthenticated,
        isAdmin,
        login,
        register,
        logout,
        fetchUser,
        setUser
    };
});
