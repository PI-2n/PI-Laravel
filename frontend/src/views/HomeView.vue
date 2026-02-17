<script setup>
import { ref, onMounted, nextTick, onUnmounted } from 'vue';
import api from '../services/api';
import { RouterLink } from 'vue-router';

const featured = ref(null);
const news = ref([]);
const offers = ref([]);
const loading = ref(true);

// Carousel state
const carouselTrack = ref(null);
const currentIndex = ref(0);
const visibleSlides = ref(3);
const slideWidth = ref(0);
const showPrev = ref(false);
const showNext = ref(false);

const fetchHomeData = async () => {
    try {
        const response = await api.get('/home');
        featured.value = response.data.featured;

        // Handle potentially wrapped resources (Laravel ResourceCollection)
        const newsData = response.data.news;
        news.value = Array.isArray(newsData) ? newsData : (newsData.data || []);

        const offersData = response.data.offers;
        offers.value = Array.isArray(offersData) ? offersData : (offersData.data || []);

        await nextTick(); // Wait for DOM update
        initCarousel();
    } catch (error) {
        console.error('Error fetching home data:', error);
    } finally {
        loading.value = false;
    }
};

// Carousel Logic
const initCarousel = () => {
    updateDimensions();
    window.addEventListener('resize', updateDimensions);
};

const updateDimensions = () => {
    if (!carouselTrack.value) return;

    const width = window.innerWidth;
    if (width < 576) visibleSlides.value = 1;
    else if (width < 992) visibleSlides.value = 2;
    else visibleSlides.value = 3;

    const firstSlide = carouselTrack.value.children[0];
    if (firstSlide) {
        const gap = 20; // Assuming 20px gap from CSS, or measure it
        slideWidth.value = firstSlide.offsetWidth + gap;
    }

    const totalSlides = news.value.length;

    // Show/Hide buttons
    if (totalSlides <= visibleSlides.value) {
        showPrev.value = false;
        showNext.value = false;
    } else {
        showPrev.value = true;
        showNext.value = true;
    }

    // Clamp index
    const maxIndex = Math.max(0, totalSlides - visibleSlides.value);
    if (currentIndex.value > maxIndex) currentIndex.value = maxIndex;

    updateTrackPosition();
};

const updateTrackPosition = () => {
    if (carouselTrack.value) {
        carouselTrack.value.style.transform = `translateX(-${currentIndex.value * slideWidth.value}px)`;
    }
};

const moveCarousel = (direction) => {
    const totalSlides = news.value.length;
    const maxIndex = Math.max(0, totalSlides - visibleSlides.value);

    let newIndex = currentIndex.value + direction;
    if (newIndex < 0) newIndex = 0;
    if (newIndex > maxIndex) newIndex = maxIndex;

    currentIndex.value = newIndex;
    updateTrackPosition();
};

// Video Hover Logic
const hoverTimer = ref(null);

const handleMouseEnter = (event) => {
    const productEl = event.currentTarget;
    const video = productEl.querySelector('video');
    if (!video) return;

    hoverTimer.value = setTimeout(() => {
        productEl.classList.add('show-video');
        video.currentTime = 0;
        video.play().catch(e => console.debug("Autoplay blocked", e));
    }, 300);
};

const handleMouseLeave = (event) => {
    if (hoverTimer.value) clearTimeout(hoverTimer.value);

    const productEl = event.currentTarget;
    const video = productEl.querySelector('video');

    productEl.classList.remove('show-video');
    if (video) {
        video.pause();
        video.currentTime = 0;
    }
};

onMounted(() => {
    fetchHomeData();
});

onUnmounted(() => {
    window.removeEventListener('resize', updateDimensions);
});

const formatPrice = (val) => parseFloat(val).toFixed(2);
</script>

<template>
    <div class="page-index">
        <div v-if="loading" class="loading-container">Loading...</div>
        <template v-else>
            <!-- Featured Section -->
            <section v-if="featured" class="featured">
                <video v-if="featured.video_url" :src="featured.video_url" muted loop autoplay
                    class="featured-background-video"></video>

                <RouterLink :to="`/products/${featured.id}`" class="featured-link">
                    <h1 class="featured-title">{{ featured.name }}</h1>
                    <p class="featured-subtitle">Ya disponible</p>
                </RouterLink>
            </section>

            <!-- News Section -->
            <section class="news" v-if="news.length > 0">
                <h2>Últimas novedades</h2>

                <div class="carousel-container">
                    <button v-show="showPrev" class="carousel-btn carousel-btn--prev"
                        @click="moveCarousel(-1)">&lt;</button>

                    <div class="carousel-track" ref="carouselTrack" :style="{ gap: '20px' }">
                        <div v-for="product in news" :key="product.id" class="carousel-slide">
                            <div class="product" @mouseenter="handleMouseEnter" @mouseleave="handleMouseLeave">
                                <RouterLink :to="`/products/${product.id}`" class="product-link">
                                    <span v-if="product.offer_percentage > 0" class="discount-badge">-{{
                                        parseInt(product.offer_percentage) }}%</span>

                                    <img :src="product.image_url" :alt="product.name">
                                    <video v-if="product.video_url" :src="product.video_url" muted loop
                                        class="product-video"></video>

                                    <div class="product-text">
                                        <span class="title">{{ product.name }}</span>
                                        <div class="price" v-if="product.offer_percentage > 0">
                                            <span class="old-price">{{ formatPrice(product.price) }}€</span>
                                            <span>{{ formatPrice(product.final_price) }}€</span>
                                        </div>
                                        <span class="price" v-else>{{ formatPrice(product.price) }}€</span>
                                    </div>
                                </RouterLink>
                            </div>
                        </div>
                    </div>

                    <button v-show="showNext" class="carousel-btn carousel-btn--next"
                        @click="moveCarousel(1)">&gt;</button>
                </div>
            </section>

            <!-- Offers Section -->
            <section class="offers" v-if="offers.length > 0">
                <h2>Ofertas</h2>

                <div class="products">
                    <div v-for="product in offers" :key="product.id" class="product">
                        <RouterLink :to="`/products/${product.id}`" class="product-link">
                            <span v-if="product.offer_percentage > 0" class="discount-badge">-{{
                                parseInt(product.offer_percentage)
                            }}%</span>

                            <img v-if="product.image_url" :src="product.image_url" :alt="product.name">

                            <div class="product-text">
                                <span class="title">{{ product.name }}</span>
                                <div class="price">
                                    <span v-if="product.offer_percentage > 0" class="old-price">{{
                                        formatPrice(product.price)
                                    }}€</span>
                                    <span>{{ formatPrice(product.final_price || product.price) }}€</span>
                                </div>
                            </div>
                        </RouterLink>
                    </div>
                </div>
            </section>
        </template>
    </div>
</template>
