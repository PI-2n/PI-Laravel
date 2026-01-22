// Tu código de carrusel (sin envolver en funciones innecesarias)
document.addEventListener("DOMContentLoaded", () => {
    const track = document.querySelector(".news .carousel-track");
    if (!track) return;

    const slides = document.querySelectorAll(".news .carousel-slide");
    const prevBtn = document.querySelector(".news .carousel-btn--prev");
    const nextBtn = document.querySelector(".news .carousel-btn--next");

    if (slides.length <= 3) {
        // Oculta botones si no hay suficientes productos
        prevBtn?.remove();
        nextBtn?.remove();
        return;
    }

    let currentIndex = 0;
    const gap =
        parseFloat(
            getComputedStyle(document.querySelector(".news .carousel-track"))
                .gap,
        ) || 24;
    const slideWidth = slides[0].offsetWidth + gap;

    function updateTrack() {
        track.style.transform = `translateX(-${currentIndex * slideWidth}px)`;
    }

    nextBtn?.addEventListener("click", () => {
        if (currentIndex < slides.length - 3) {
            currentIndex++;
            updateTrack();
        }
    });

    prevBtn?.addEventListener("click", () => {
        if (currentIndex > 0) {
            currentIndex--;
            updateTrack();
        }
    });
});
