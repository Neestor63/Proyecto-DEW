<?php
session_start();

// 1. Bloqueo de seguridad
if (!isset($_SESSION["usuario"])) {
    header("Location: login.php");
    exit;
}

// 2. Procesar el formulario (Lógica de Cookies)
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $idioma = $_POST["idioma"] ?? "es";
    $estilo = $_POST["estilo"] ?? "claro";
    $fuente = $_POST["fuente"] ?? "normal";

    $tiempo = time() + (3600 * 24 * 30); // Duración de 30 días

    // Usamos "/" como path para evitar errores de ruta
    setcookie("idioma", $idioma, $tiempo, "/");
    setcookie("estilo", $estilo, $tiempo, "/");
    setcookie("fuente", $fuente, $tiempo, "/");

    header("Location: preferencias.php");
    exit;
}

// 3. Leer valores actuales
$idioma_actual = $_COOKIE["idioma"] ?? "es";
$estilo_actual = $_COOKIE["estilo"] ?? "claro";
$fuente_actual = $_COOKIE["fuente"] ?? "normal";

require_once "idiomas.php";
?>

<!DOCTYPE html>
<html lang="<?= $idioma_actual ?>">
<head>
    <meta charset="UTF-8">
    <title><?= $T[$idioma_actual]["preferencias"] ?> - Inazuma Shop</title>
    
    <link rel="stylesheet" href="./css/style.css">
    
    <link rel="stylesheet" href="<?= $fuente_actual === 'inazuma' ? 'https://fonts.googleapis.com/css2?family=Bangers&display=swap' : 'https://fonts.googleapis.com/css2?family=Roboto&display=swap' ?>">
    
    <style>
        /* Solo dejamos aquí lo estrictamente dinámico */
        body { 
            font-family: <?= $fuente_actual === 'inazuma' ? "'Bangers', cursive" : "'Roboto', sans-serif" ?> !important; 
        }
    </style>
</head>

<body class="<?= $estilo_actual ?>">

    <div class="preferencias-box">
        <h1><?= $T[$idioma_actual]["preferencias"] ?></h1>

        <form method="post">
            <label><?= $T[$idioma_actual]["idioma"] ?></label>
            <select name="idioma">
                <option value="es" <?= $idioma_actual === "es" ? "selected" : "" ?>><?= $T[$idioma_actual]["espaniol"] ?></option>
                <option value="en" <?= $idioma_actual === "en" ? "selected" : "" ?>><?= $T[$idioma_actual]["ingles"] ?></option>
            </select>

            <label><?= $T[$idioma_actual]["tema"] ?></label>
            <select name="estilo">
                <option value="claro" <?= $estilo_actual === "claro" ? "selected" : "" ?>><?= $T[$idioma_actual]["claro"] ?></option>
                <option value="oscuro" <?= $estilo_actual === "oscuro" ? "selected" : "" ?>><?= $T[$idioma_actual]["oscuro"] ?></option>
            </select>

            <label><?= $T[$idioma_actual]["estilo"] ?></label>
            <select name="fuente">
                <option value="normal" <?= $fuente_actual === "normal" ? "selected" : "" ?>><?= $T[$idioma_actual]["normal"] ?></option>
                <option value="inazuma" <?= $fuente_actual === "inazuma" ? "selected" : "" ?>>Inazuma Eleven</option>
            </select>

            <button type="submit"><?= $T[$idioma_actual]["guardar"] ?></button>
        </form>

        <a class="volver" href="tienda.php">
            <button class="btn" style="margin-top: 10px; background: #666; color: white; box-shadow: none;">
                <?= $T[$idioma_actual]["volver"] ?>
            </button>
        </a>
    </div>

</body>
</html>