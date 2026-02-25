import { fileURLToPath, URL } from 'node:url'
import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'
import laravel from 'laravel-vite-plugin'

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/scss/app.scss', 'resources/js/app.js'],
            buildDirectory: 'build',  // Laravel buscará en public/build/
            refresh: true,
        }),
        vue(),
    ],
    resolve: {
        alias: {
            '@': fileURLToPath(new URL('./src', import.meta.url))
        }
    },
    server: {
        proxy: {
            '/api': {
                target: 'http://app:9000',  // ← Cambiar localhost por el servicio Docker 'app'
                changeOrigin: true,
                headers: {
                    Accept: 'application/json',
                    "X-Requested-With": "XMLHttpRequest"
                }
            }
        }
    },
    build: {
        manifest: true,  // ← IMPORTANTE: Genera manifest.json
        outDir: 'dist',
    }
})
