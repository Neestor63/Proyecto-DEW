<?php
session_start();

// 1. Lógica de Seguridad
if (!isset($_SESSION["usuario"])) {
    header("Location: login.php");
    exit;
}

$usuario = $_SESSION["usuario"];

// 2. Carga de Preferencias (Persistencia del trimestre anterior)
$idioma_actual = $_COOKIE["idioma"] ?? "en";
$estilo_actual = $_COOKIE["estilo"] ?? "claro";
$fuente_actual = $_COOKIE["fuente"] ?? "normal";

require_once "idiomas.php";

// 3. Definición de Datos (Lo ideal sería un archivo JSON o BD, pero lo mantenemos limpio aquí)
$productos = [
    ["nombre" => "Inazuma Eleven", "precio" => 90.00, "imagen" => "public\assets\img\inazumaEleven.jpg"],
    ["nombre" => "Inazuma Eleven 2", "precio" => 15.99, "imagen" => "public\assets\img\inazumaEleven2.jpg"],
    ["nombre" => "Inazuma Eleven 3", "precio" => 20.99, "imagen" => "public\assets\img\inazumaEleven3.jpg"],
    ["nombre" => "Inazuma Eleven Go", "precio" => 25.99, "imagen" => "public\assets\img\inazumaElevenGo.jpg"],
    ["nombre" => "Inazuma Eleven Go CS", "precio" => 30.99, "imagen" => "public\assets\img\inazumaElevenGoChrono.jpg"],
    ["nombre" => "Inazuma Eleven Strikers", "precio" => 35.99, "imagen" => "public\assets\img\inazumaElevenStrikers.jpg"],
    ["nombre" => "Inazuma Eleven VR", "precio" => 70.00, "imagen" => "public\assets\img\inazumaElevenVr.jpg"],
];
?>
<!DOCTYPE html>
<html lang="<?= $idioma_actual ?>">

<head>
    <meta charset="UTF-8">
    <title>Tienda Inazuma</title>
    <link rel="stylesheet" href="/public/assets/css/style.css">
    <link rel="stylesheet" href="<?= $fuente_actual === 'inazuma' ? 'https://fonts.googleapis.com/css2?family=Bangers&display=swap' : 'https://fonts.googleapis.com/css2?family=Roboto&display=swap' ?>">
    <style>
        body {
            font-family: <?= $fuente_actual === 'inazuma' ? "'Bangers', cursive" : "'Roboto', sans-serif" ?> !important;
        }
    </style>
</head>

<body class="<?= $estilo_actual ?>">

    <div id="info-geo">⚽ Detectando tu estadio...</div>

    <div class="contenedor">

        <header>
            <h1>
                <?= ($usuario === "admin") ? $T[$idioma_actual]["admin"] : $T[$idioma_actual]["bienvenido"] . " " . htmlspecialchars($usuario) ?>
            </h1>

            <nav class="menu">
                <a href="lista_deseos.php"><?= $T[$idioma_actual]["lista_deseos"] ?></a>
                <a href="carrito.php"><?= $T[$idioma_actual]["carrito"] ?></a>
                <a href="preferencias.php"><?= $T[$idioma_actual]["preferencias"] ?></a>
                <a href="gestion_lotes.php"><?= $T[$idioma_actual]["lotes"] ?></a>
                <a href="logout.php"><?= $T[$idioma_actual]["cerrar_sesion"] ?></a>
            </nav>
        </header>

        <section class="carrusel-marco">
            <div class="carrusel-pistas" id="carrusel-pistas">
                <div class="slide" style="background-image: url('./public/assets/img/inazumaElevenStrikers.jpg')"><span>TORNEO STRIKERS ACTIVADO</span></div>
                <div class="slide" style="background-image: url('./public/assets/img/inazumaElevenVR.jpg')"><span>¡NUEVO: VICTORY ROAD!</span></div>
                <div class="slide" style="background-image: url('./public/assets/img/inazumaEleven.jpg')"><span>REVIVE LA TRILOGÍA ORIGINAL</span></div>
            </div>
        </section>

        <section class="productos">
            <?php foreach ($productos as $id => $p): ?>
                <article class="card">
                    <img src="<?= $p["imagen"] ?>" alt="<?= $p["nombre"] ?>">
                    <h3 class="nombre"><?= $p["nombre"] ?></h3>
                    <p class="precio"><?= number_format($p["precio"], 2) ?> €</p>

                    <div class="valoracion">
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <span onclick="valorarProducto(<?= $id ?>, <?= $i ?>)">⭐</span>
                        <?php endfor; ?>
                    </div>
                    <div id="feedback-<?= $id ?>" class="feedback-async"></div>

                    <div class="acciones">
                        <form action="wishlist.php" method="POST" style="display:inline;">
                            <input type="hidden" name="id" value="<?= $id ?>">
                            <button class="btn" type="submit"><?= $T[$idioma_actual]["añadir_deseos"] ?></button>
                        </form>
                        <button class="btn" onclick="añadirDesdeTienda(<?= $id ?>)">
                            <?= $T[$idioma_actual]["añadir_carrito"] ?>
                        </button>
                    </div>
                </article>
            <?php endforeach; ?>
        </section>
    </div>

    <script>
        const productosPHP = <?= json_encode($productos, JSON_UNESCAPED_UNICODE) ?>;
    </script>

    <script src="public\assets\js\productos.js"></script>
    <script src="public\assets\js\carrito.js"></script>
    <script src="public\assets\js\carrusel.js"></script>
    <script src="public\assets\js\nuevasFunciones.js"></script>
</body>
</html>