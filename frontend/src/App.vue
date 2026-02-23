<script setup>
import { RouterView } from 'vue-router'
import Navbar from './components/Navbar.vue'
import Footer from './components/Footer.vue'
import N8nChat from './components/N8nChat.vue'
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
        <N8nChat />
    </div>
</template>
