import { defineStore } from 'pinia';
import api from '../services/api';

export const useCommentStore = defineStore('comment', () => {

    const addComment = async (productId, commentData) => {
        try {
            const response = await api.post(`/products/${productId}/comments`, commentData);
            return response.data;
        } catch (error) {
            throw error;
        }
    };

    const updateComment = async (commentId, commentData) => {
        try {
            const response = await api.put(`/comments/${commentId}`, commentData);
            return response.data;
        } catch (error) {
            throw error;
        }
    };

    const deleteComment = async (commentId) => {
        try {
            await api.delete(`/comments/${commentId}`);
        } catch (error) {
            throw error;
        }
    };

    return {
        addComment,
        updateComment,
        deleteComment
    };
});
