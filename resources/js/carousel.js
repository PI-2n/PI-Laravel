document.addEventListener("DOMContentLoaded", () => {
    const track = document.querySelector(".news .carousel-track");
    if (!track) return; // Si no hay carrusel, no hacemos nada

    const slides = document.querySelectorAll(".news .carousel-slide");
    const prevBtn = document.querySelector(".news .carousel-btn--prev");
    const nextBtn = document.querySelector(".news .carousel-btn--next");

    // Si no hay slides o botones, salimos para evitar errores
    if (slides.length === 0) return;

    let currentIndex = 0;
    let visibleSlides = 3;
    let slideWidth = 0;

    // Función para calcular cuántos slides se ven y el ancho de desplazamiento
    function updateDimensions() {
        const width = window.innerWidth;

        // Coherencia con CSS breakpoints: 
        // < 576px -> 1 slide (mobile)
        // < 992px -> 2 slides (tablet)
        // >= 992px -> 3 slides (desktop)
        if (width < 576) {
            visibleSlides = 1;
        } else if (width < 992) {
            visibleSlides = 2;
        } else {
            visibleSlides = 3;
        }

        const gap = parseFloat(getComputedStyle(track).gap) || 0;
        // El ancho de un slide + el gap es lo que debemos desplazar
        slideWidth = slides[0].offsetWidth + gap;

        // Ocultar botones si no son necesarios
        if (slides.length <= visibleSlides) {
            if (prevBtn) prevBtn.style.display = 'none';
            if (nextBtn) nextBtn.style.display = 'none';
        } else {
            if (prevBtn) prevBtn.style.display = 'flex'; // Usamos flex para centrar iconos si los hay
            if (nextBtn) nextBtn.style.display = 'flex';
        }

        // Asegurarse de que el índice actual no se salga de rango si redimensionamos
        const maxIndex = Math.max(0, slides.length - visibleSlides);
        if (currentIndex > maxIndex) {
            currentIndex = maxIndex;
        }

        updateTrackPosition();
    }

    function updateTrackPosition() {
        track.style.transform = `translateX(-${currentIndex * slideWidth}px)`;
    }

    // Inicializar
    updateDimensions();

    // Actualizar al redimensionar la ventana
    window.addEventListener('resize', () => {
        updateDimensions();
    });

    if (nextBtn) {
        nextBtn.addEventListener("click", () => {
            const maxIndex = slides.length - visibleSlides;
            if (currentIndex < maxIndex) {
                currentIndex++;
                updateTrackPosition();
            }
        });
    }

    if (prevBtn) {
        prevBtn.addEventListener("click", () => {
            if (currentIndex > 0) {
                currentIndex--;
                updateTrackPosition();
            }
        });
    }
});
