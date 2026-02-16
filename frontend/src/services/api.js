import axios from 'axios';
import { useAuthStore } from '@/stores/auth';

const api = axios.create({
    baseURL: '/api',
    withCredentials: true,
    headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json'
    }
});

// Request interceptor to add token
api.interceptors.request.use(config => {
    const authStore = useAuthStore();
    if (authStore.token) {
        config.headers.Authorization = `Bearer ${authStore.token}`;
    }
    return config;
});

// Response interceptor to handle errors
api.interceptors.response.use(
    response => response,
    error => {
        const authStore = useAuthStore();
        if (error.response && error.response.status === 401) {
            // Prevent infinite loop if already logging out or on login page
            if (authStore.user || authStore.token) {
                authStore.logout(false); // Pass false to avoid calling API logout again
            }
        }
        return Promise.reject(error);
    }
);

export default api;
