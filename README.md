# Proyecto-DEW-DSW

⚽ Inazuma Eleven Web Shop - Proyecto DEW
¡Bienvenido a la tienda definitiva de Inazuma Eleven! Este proyecto es una aplicación web dinámica que simula un e-commerce temático, integrando tecnologías de servidor (PHP) y cliente (JavaScript) con un enfoque en la experiencia de usuario y el rendimiento.

🚀 Funcionalidades Principales
1. Gestión de Sesión y Seguridad
Acceso restringido: Control de acceso mediante sesiones PHP (session_start). Las páginas críticas redirigen al login.php si no hay un usuario autenticado.

Roles de Usuario: Interfaz adaptativa que reconoce si el usuario es admin o un usuario estándar (Nestor).

2. Sistema de Preferencias (Persistencia)
Idiomas: Soporte multi-idioma (Español/Inglés) mediante archivos de configuración.

Modo Visual: Elección entre Modo Claro y Modo Oscuro guardado en cookies.

Tipografía Dinámica: Selección de fuente (Estándar o fuente temática 'Bangers') con persistencia de 30 días.

3. Componentes Interactivos (JavaScript Avanzado)
Carrusel de Banners: Deslizamiento automático de novedades en la página principal.

Carrusel de Lista de Deseos: Galería horizontal con desplazamiento manual mediante botones (Script modular).

Carrito de Compra: Gestión dinámica de productos basada en Programación Orientada a Objetos (POO).

4. Nuevas Tecnologías (Trimestre Actual)
Asincronía (Async/Await): Sistema de valoración de productos por estrellas. Utiliza la API fetch para enviar datos de forma asíncrona sin recargar la página, simulando un entorno de servidor real con JSONPlaceholder.

Geolocalización: Uso de la API nativa del navegador para localizar el "estadio" (coordenadas) del usuario en tiempo real.

🛠️ Tecnologías Utilizadas
Backend: PHP 8.x (Gestión de sesiones, cookies y lógica de servidor).

Frontend: HTML5 Semántico, CSS3 (Variables :root, Flexbox, Grid, Animaciones).

Scripting: JavaScript ES6+ (Fetch API, Async/Await, Geolocalización, POO).

Fuentes: Google Fonts (Bangers & Roboto).