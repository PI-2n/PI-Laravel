import { createApp } from 'vue'
import { createPinia } from 'pinia'

import App from './App.vue'
import router from './router'
import './assets/scss/app.scss' // Changed from main.css to app.scss

const app = createApp(App)

app.use(createPinia())
app.use(router)

app.mount('#app')
