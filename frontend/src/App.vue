<script setup>
import { RouterView } from 'vue-router'
import Navbar from './components/Navbar.vue'
import Footer from './components/Footer.vue'
</script>

<template>
    <div class="body"> <!-- Wrapper class from Laravel layout -->
        <header class="header">
            <Navbar />
        </header>

        <main class="main">
            <RouterView />
        </main>

        <Footer /> <!-- Footer component contains the <footer> tag -->

        <!-- Toast Notification Logic can be added here later -->
    </div>
</template>
