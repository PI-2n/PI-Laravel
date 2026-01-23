import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel([
            // Archivo global (layout)
            "resources/scss/app.scss",
            "resources/js/app.js",
        ]),
    ],
});
