<script setup>
import { RouterView } from 'vue-router'
import Navbar from './components/Navbar.vue'
import Footer from './components/Footer.vue'
</script>

<template>
    <div class="body">
        <header class="header">
            <Navbar />
        </header>

        <main class="main">
            <RouterView />
        </main>

        <Footer />
    </div>
</template>
