/**
 * LÓGICA DE CARRUSELES - TIENDA INAZUMA
 */

document.addEventListener("DOMContentLoaded", () => {

    // --- 2. CARRUSEL DE ÍTEMS CON BOTONES (LISTA_DESEOS.PHP) ---
    // Este mueve los productos horizontalmente al pulsar las flechas
    const contenedorItems = document.getElementById('carousel');
    const btnLeft = document.getElementById('btn-left');
    const btnRight = document.getElementById('btn-right');

    if (contenedorItems && btnLeft && btnRight) {
        // Calculamos cuánto scroll hacer (el ancho de una tarjeta + el gap)
        const anchoTarjeta = 280;

        btnLeft.addEventListener('click', () => {
            contenedorItems.scrollBy({
                left: -anchoTarjeta,
                behavior: 'smooth'
            });
        });

        btnRight.addEventListener('click', () => {
            contenedorItems.scrollBy({
                left: anchoTarjeta,
                behavior: 'smooth'
            });
        });
    }
});


let slideIndex = 0;

function moverCarrusel() {
    const pistas = document.getElementById("carrusel-pistas");
    if (!pistas) return; // Si no encuentra el carrusel, no hace nada

    const totalSlides = pistas.children.length; // Cuenta cuántas imágenes hay
    slideIndex++;

    if (slideIndex >= totalSlides) {
        slideIndex = 0; // Vuelve a la primera imagen
    }

    // Movemos el contenedor hacia la izquierda
    pistas.style.transform = `translateX(-${slideIndex * 100}%)`;
}

// Esto hace que se mueva cada 3 segundos automáticamente
setInterval(moverCarrusel, 3000);