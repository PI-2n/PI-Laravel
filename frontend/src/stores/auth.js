import { defineStore } from 'pinia';
import { ref, computed } from 'vue';
import api from '../services/api';
import router from '../router';

export const useAuthStore = defineStore('auth', () => {
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

    const isAuthenticated = computed(() => !!token.value);
    const isAdmin = computed(() => user.value && user.value.role_id === 1);

    const handleAuthResponse = async (response) => {
        const responseData = response.data.data || response.data;

        const newToken = responseData.token || responseData.access_token;

        token.value = newToken;
        localStorage.setItem('token', newToken);

        await fetchUser();
    };

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
