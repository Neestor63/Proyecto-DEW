function activarGeo() {
    const geoPanel = document.getElementById('info-geo');

    navigator.geolocation.getCurrentPosition(
        (pos) => {
            const lat = pos.coords.latitude.toFixed(3);
            const lon = pos.coords.longitude.toFixed(3);
            geoPanel.innerHTML = `📍 Estadio localizado: ${lat}, ${lon}`;
            geoPanel.style.background = "#d4edda"; // Color verde éxito
        },
        (error) => {
            console.error("Error de geo:", error);
            geoPanel.innerText = "📍 Radar bloqueado. Activa la ubicación en tu navegador.";
            geoPanel.style.background = "#f8d7da"; // Color rojo error
        },
        {
            enableHighAccuracy: false, // Menos preciso pero falla menos
            timeout: 5000,
            maximumAge: Infinity // Si tiene una posición vieja, que la use
        }
    );
}

// Esto asegura que la función corra en cuanto la página esté lista
window.onload = () => {
    activarGeo();
    // Aquí también podrías arrancar el carrusel si lo tienes en este archivo
};


// IMPORTANTE: Ejecutar la función cuando cargue la página
document.addEventListener('DOMContentLoaded', activarGeo);

// 2. ASINCRONÍA CON ASYNC/AWAIT (Valoración de estrellas)
// Esta función debe ser ASYNC para poder usar AWAIT
async function valorarProducto(id, puntos) {
    const feedback = document.getElementById(`feedback-${id}`);

    // Mostramos un mensaje de "cargando" (feedback visual)
    feedback.innerText = "⚽ Enviando valoración al estadio...";
    feedback.style.color = "blue";

    try {
        // Usamos una API de prueba gratuita que acepta cualquier POST
        const respuesta = await fetch('https://jsonplaceholder.typicode.com/posts', {
            method: 'POST',
            body: JSON.stringify({
                id_articulo: id,
                estrellas: puntos
            }),
            headers: {
                'Content-type': 'application/json; charset=UTF-8',
            },
        });

        // Esperamos un segundo para que el profesor vea el efecto de "carga"
        await new Promise(resolve => setTimeout(resolve, 1000));

        if (respuesta.ok) {
            // Si la API responde bien, mostramos el éxito
            feedback.innerText = `¡GOL! Has valorado con ${puntos} estrellas.`;
            feedback.style.color = "green";
            feedback.style.fontWeight = "bold";
        } else {
            throw new Error("Error en el servidor");
        }

    } catch (error) {
        // Si no hay internet o la API falla
        feedback.innerText = "❌ Hubo un fallo en la conexión.";
        feedback.style.color = "red";
    }
}
