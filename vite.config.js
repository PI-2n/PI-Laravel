import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel([
            // Archivo global (layout)
            "resources/scss/app.scss",

            // Páginas individuales
            "resources/scss/pages/index.scss",
            "resources/scss/pages/login.scss",
            "resources/scss/pages/register.scss",
            "resources/scss/pages/profile.scss",
            "resources/scss/pages/product.scss",

            "resources/js/app.js",
        ]),
    ],
});
