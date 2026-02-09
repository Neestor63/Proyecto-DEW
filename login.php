<?php
session_start();

// 1. Configuración de Preferencias
$idioma_actual = $_COOKIE["idioma"] ?? "en";
$estilo_actual = $_COOKIE["estilo"] ?? "claro";
$fuente_actual = $_COOKIE["fuente"] ?? "normal";

require_once "idiomas.php";

// 2. Base de Datos de Usuarios (Simulada)
$usuarios = [
    "admin"  => "123456A",
    "Nestor" => "123456N"
];

$mensaje = ""; 

// 3. Procesamiento del Formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usuario  = $_POST["usuario"] ?? "";
    $password = $_POST["password"] ?? "";

    if (isset($usuarios[$usuario]) && $usuarios[$usuario] === $password) {
        $_SESSION["usuario"] = $usuario;
        header("Location: tienda.php");
        exit;
    } else {
        $mensaje = $T[$idioma_actual]["error_login"];
    }
}
?>

<!DOCTYPE html>
<html lang="<?= $idioma_actual ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $T[$idioma_actual]["titulo_login"] ?></title>

    <link rel="stylesheet" href="./css/style.css">
    
    <link rel="stylesheet" href="<?= $fuente_actual === 'inazuma' ? 'https://fonts.googleapis.com/css2?family=Bangers&display=swap' : 'https://fonts.googleapis.com/css2?family=Roboto&display=swap' ?>">

    <style>
        /* Solo inyectamos lo estrictamente dependiente de la cookie de fuente */
        body { 
            font-family: <?= $fuente_actual === 'inazuma' ? "'Bangers', cursive" : "'Roboto', sans-serif" ?> !important; 
        }
    </style>
</head>

<body class="<?= $estilo_actual ?>">

    <div class="form-wrapper">
        <form method="post" id="loginForm">
            <h2><?= $T[$idioma_actual]["bienvenido"] ?></h2>

            <div class="input-group">
                <label for="usuario"><?= $T[$idioma_actual]["nombre_usuario"] ?></label>
                <input type="text" id="usuario" name="usuario" autocomplete="off">
                <p id="mensaje_usuario" class="feedback-text"></p>
            </div>

            <div class="input-group">
                <label for="contrasenia"><?= $T[$idioma_actual]["contraseña"] ?></label>
                <input type="password" id="contrasenia" name="password">
                <p id="mensaje_contrasenia" class="feedback-text"></p>
            </div>

            <button type="submit" class="btn"><?= $T[$idioma_actual]["iniciar_sesion"] ?></button>

            <?php if ($mensaje): ?>
                <div class="error-box"><?= $mensaje ?></div>
            <?php endif; ?>
        </form>
    </div>

    <script src="js/keyup.js"></script>
</body>
</html>