function activarGeo() {
    const geoPanel = document.getElementById('info-geo');

    navigator.geolocation.getCurrentPosition(
        (pos) => {
            const lat = pos.coords.latitude.toFixed(3);
            const lon = pos.coords.longitude.toFixed(3);
            geoPanel.innerHTML = `📍 Estadio localizado: ${lat}, ${lon}`;
            geoPanel.style.background = "#d4edda"; 
        },
        (error) => {
            console.error("Error de geo:", error);
            geoPanel.innerText = "📍 Radar bloqueado. Activa la ubicación en tu navegador.";
            geoPanel.style.background = "#f8d7da"; 
        },
        {
            enableHighAccuracy: false,
            timeout: 5000,
            maximumAge: Infinity
        }
    );
}


window.onload = () => {
    activarGeo();
    
};



document.addEventListener('DOMContentLoaded', activarGeo);


async function valorarProducto(id, puntos) {
    const feedback = document.getElementById(`feedback-${id}`);

    
    feedback.innerText = "⚽ Enviando valoración al estadio...";
    feedback.style.color = "blue";

    try {
        
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

        
        await new Promise(resolve => setTimeout(resolve, 1000));

        if (respuesta.ok) {
          
            feedback.innerText = `¡GOL! Has valorado con ${puntos} estrellas.`;
            feedback.style.color = "green";
            feedback.style.fontWeight = "bold";
        } else {
            throw new Error("Error en el servidor");
        }

    } catch (error) {
        
        feedback.innerText = "❌ Hubo un fallo en la conexión.";
        feedback.style.color = "red";
    }
}
