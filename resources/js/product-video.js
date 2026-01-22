// resources/js/product-video.js

export function initProductVideoHover() {
    document.querySelectorAll(".product").forEach((product) => {
        const video = product.querySelector(".product-video");
        if (!video) return;

        let hoverTimer;

        product.addEventListener("mouseenter", () => {
            hoverTimer = setTimeout(() => {
                product.classList.add("show-video");
                video.currentTime = 0;
                video.play().catch((e) => {
                    // Silenciar errores si el navegador bloquea autoplay
                    console.debug("Video autoplay blocked:", e);
                });
            }, 300);
        });

        product.addEventListener("mouseleave", () => {
            clearTimeout(hoverTimer);
            product.classList.remove("show-video");
            video.pause();
            video.currentTime = 0;
        });
    });
}

// Ejecutar automáticamente al cargar
if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", initProductVideoHover);
} else {
    initProductVideoHover();
}
