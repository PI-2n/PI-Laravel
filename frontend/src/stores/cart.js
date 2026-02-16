import { defineStore } from 'pinia';
import { ref, computed } from 'vue';

export const useCartStore = defineStore('cart', () => {
    const items = ref([]);

    // Initialize from localStorage
    try {
        const storedCart = localStorage.getItem('cart');
        if (storedCart) {
            items.value = JSON.parse(storedCart);
        }
    } catch (e) {
        localStorage.removeItem('cart');
    }

    const saveCart = () => {
        localStorage.setItem('cart', JSON.stringify(items.value));
    };

    // Getters
    const cartCount = computed(() => items.value.reduce((acc, item) => acc + item.quantity, 0));

    const cartTotal = computed(() => {
        return items.value.reduce((acc, item) => {
            const price = item.product.final_price || item.product.price;
            return acc + (price * item.quantity);
        }, 0);
    });

    // Actions
    const addToCart = (product, platform = null) => {
        const existingItem = items.value.find(item =>
            item.product.id === product.id &&
            ((item.platform && platform && item.platform.id === platform.id) || (!item.platform && !platform))
        );

        if (existingItem) {
            if (existingItem.quantity < 10) {
                existingItem.quantity++;
            }
        } else {
            // Ensure we store necessary product details
            // Logic to calculate final price if not present
            let finalPrice = parseFloat(product.price);
            if (product.is_offer && product.offer_percentage) {
                finalPrice = finalPrice * (1 - (product.offer_percentage / 100));
            }

            items.value.push({
                product: {
                    ...product,
                    final_price: finalPrice
                },
                platform: platform,
                quantity: 1
            });
        }
        saveCart();
    };

    const removeFromCart = (itemId) => {
        // itemId here serves as an index or we need a unique ID for cart items. 
        // For simplicity using index if passed, or matching logic. 
        // Let's assume we pass the item object or match it.
        // A better way for local cart is generating a temporary ID.
        // For now, let's filter.

        // If we get an index:
        if (typeof itemId === 'number' && itemId < items.value.length) {
            items.value.splice(itemId, 1);
        }

        saveCart();
    };

    const updateQuantity = (index, quantity) => {
        if (quantity < 1) return;
        if (quantity > 10) quantity = 10;

        if (items.value[index]) {
            items.value[index].quantity = quantity;
            saveCart();
        }
    };

    const clearCart = () => {
        items.value = [];
        saveCart();
    };

    return {
        items,
        cartCount,
        cartTotal,
        addToCart,
        removeFromCart,
        updateQuantity,
        clearCart
    };
});
