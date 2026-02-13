<?php
session_start();

// Bloqueo si no está logueado
if (!isset($_SESSION["usuario"])) {
    header("Location: login.php");
    exit;
}

// Leer preferencias
$idioma_actual = $_COOKIE["idioma"] ?? "en";
$estilo_actual = $_COOKIE["estilo"] ?? "claro";
$fuente_actual = $_COOKIE["fuente"] ?? "normal";

// Traducciones
require_once "idiomas.php";

// Mismos productos que en tienda.php
$productos = [
    ["nombre" => "Inazuma Eleven", "precio" => 90.00, "imagen" => "img/inazumaEleven.jpg"],
    ["nombre" => "Inazuma Eleven 2", "precio" => 15.99, "imagen" => "img/inazumaEleven2.jpg"],
    ["nombre" => "Inazuma Eleven 3", "precio" => 20.99, "imagen" => "img/inazumaEleven3.jpg"],
    ["nombre" => "Inazuma Eleven Go", "precio" => 25.99, "imagen" => "img/inazumaElevenGo.jpg"],
    ["nombre" => "Inazuma Eleven Go CS", "precio" => 30.99, "imagen" => "img/inazumaElevenGoChrono.jpg"],
    ["nombre" => "Inazuma Eleven Strikers", "precio" => 35.99, "imagen" => "img/inazumaElevenStrikers.jpg"],
    ["nombre" => "Inazuma Eleven VR", "precio" => 70.00, "imagen" => "img/inazumaElevenVr.jpg"],
];

// Leer cookie de lista de deseos
$wishlist = isset($_COOKIE["wishlist"]) ? json_decode($_COOKIE["wishlist"], true) : [];
if (!is_array($wishlist)) {
    $wishlist = [];
}
?>
<!DOCTYPE html>
<html lang="<?= $idioma_actual ?>">

<head>
    <meta charset="UTF-8">
    <title><?= $T[$idioma_actual]["lista_deseos"] ?></title>

    <link rel="stylesheet" href="/public/assets/css/style.css">

    <link rel="stylesheet" href="<?= $fuente_actual === 'inazuma' ? 'https://fonts.googleapis.com/css2?family=Bangers&display=swap' : 'https://fonts.googleapis.com/css2?family=Roboto&display=swap' ?>">

    <style>
        /* Aplicar fuente dinámicamente */
        body {
            font-family: <?= $fuente_actual === 'inazuma' ? "'Bangers', cursive" : "'Roboto', sans-serif" ?> !important;
        }
    </style>
</head>

<body class="<?= $estilo_actual ?>">

    <div class="contenedor">
        <h1><?= $T[$idioma_actual]["lista_deseos"] ?></h1>

        <div class="menu">
            <a href="tienda.php" class="volver"><?= $T[$idioma_actual]["volver_tienda"] ?? "Volver a la tienda" ?></a>
        </div>

        <?php if (empty($wishlist)): ?>

            <p style="font-size:1.5rem; text-align:center; color:black; text-shadow:2px 2px 0 #FFD700; margin-top: 50px;">
                No tienes productos en la lista de deseos.
            </p>

        <?php else: ?>

            <div class="carousel-container">
                <button class="carousel-btn left" id="btn-left">&#10094;</button>

                <div class="carousel" id="carousel">
                    <?php foreach ($wishlist as $id): ?>
                        <?php if (isset($productos[$id])):
                            $p = $productos[$id]; ?>
                            <div class="card item">
                                <img src="<?= $p["imagen"] ?>" alt="producto">
                                <div class="nombre"><?= $p["nombre"] ?></div>
                                <div class="precio"><?= number_format($p["precio"], 2) ?> €</div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>

                <button class="carousel-btn right" id="btn-right">&#10095;</button>
            </div>

        <?php endif; ?>

    </div>

    <script src="js/carrusel.js"></script>
</body>

</html>