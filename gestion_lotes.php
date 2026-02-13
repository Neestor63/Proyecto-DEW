<?php
require_once "clases_inazuma.php";
require_once "idiomas.php";
session_start();

if (!isset($_SESSION["usuario"])) { header("Location: login.php"); exit; }

$idioma_actual = $_COOKIE["idioma"] ?? "es";
$estilo_actual = $_COOKIE["estilo"] ?? "claro";
$fuente_actual = $_COOKIE["fuente"] ?? "normal";

$productos = [
    ["nombre" => "Inazuma Eleven", "precio" => 90.00],
    ["nombre" => "Inazuma Eleven 2", "precio" => 15.99],
    ["nombre" => "Inazuma Eleven 3", "precio" => 20.99],
    ["nombre" => "Inazuma Eleven Go", "precio" => 25.99],
    ["nombre" => "Inazuma Eleven VR", "precio" => 70.00],
];

if (isset($_POST['comprar_lote'])) {
    $idx = $_POST['prod_idx'];
    $tipo_saga = $_POST['saga'];
    $juego_obj = new VideojuegoInazuma($productos[$idx]['nombre'], $productos[$idx]['precio'], $tipo_saga);
    
    if ($tipo_saga == "Original") {
        $_SESSION['lotes_original'][] = new LoteSagaOriginal($juego_obj, $_POST['cantidad']);
    } else {
        $_SESSION['lotes_nuevos'][] = new LoteSagaNueva($juego_obj, $_POST['cantidad']);
    }
}
?>

<!DOCTYPE html>
<html lang="<?= $idioma_actual ?>">
<head>
    <meta charset="UTF-8">
    <title>Lotes Inazuma - Gestión POO</title>
    <link rel="stylesheet" href="/public/assets/css/style.css">
    <style>
        body { font-family: <?= $fuente_actual === 'inazuma' ? "'Bangers', cursive" : "'Roboto', sans-serif" ?> !important; }
    </style>
</head>
<body class="<?= $estilo_actual ?>">

<div class="panel-lotes">
    <h1>⚽ Gestión de Lotes para Clubes</h1>
    
    <form method="post" class="form-lotes">
        <label>Selecciona el título:</label>
        <select name="prod_idx">
            <?php foreach ($productos as $i => $p): ?>
                <option value="<?= $i ?>"><?= $p['nombre'] ?> (<?= $p['precio'] ?>€)</option>
            <?php endforeach; ?>
        </select>

        <label>Cantidad:</label>
        <input type="number" name="cantidad" min="1" value="1">

        <label>Categoría de Saga:</label>
        <select name="saga">
            <option value="Original">Saga Original (Mates)</option>
            <option value="Nueva">Saga Nueva (Lenguaje)</option>
        </select>

        <button type="submit" name="comprar_lote" class="btn" style="width: 100%;">Generar Lote POO</button>
    </form>

    <?php if (!empty($_SESSION['lotes_original']) || !empty($_SESSION['lotes_nuevos'])): ?>
        <div class="resumen-poo">
            <hr>
            <h2>📊 Pedidos Registrados</h2>

            <?php
            $secciones = [
                'lotes_original' => 'SAGA ORIGINAL (Matemáticas)',
                'lotes_nuevos'   => 'SAGA NUEVA (Lenguaje)'
            ];

            foreach ($secciones as $key => $titulo) {
                if (!empty($_SESSION[$key])) {
                    $total_seccion = 0;
                    foreach ($_SESSION[$key] as $l) $total_seccion += $l->get_importe();

                    echo "<h3>$titulo</h3>";
                    echo "<div class='total-banner'>Total Acumulado: $total_seccion €</div>";

                    echo "<div class='grid-lotes'>";
                    foreach ($_SESSION[$key] as $index => $lote) {
                        $d = $lote->get_detalles();
                        echo "<div class='card-lote-individual'>";
                            echo "<div class='card-numero'>Lote #" . ($index + 1) . "</div>";
                            echo "<div class='card-contenido'>";
                                echo "<p class='item-nombre'>⚽ " . $d['nombre'] . "</p>";
                                echo "<div class='item-desglose'>";
                                    echo "<span>Precio Uni:</span> <strong>" . $d['precio_uni'] . " €</strong><br>";
                                    echo "<span>Cantidad:</span> <strong>" . $d['cantidad'] . "</strong>";
                                echo "</div>";
                                echo "<div class='item-subtotal'>";
                                    echo "<span>Subtotal Lote:</span> <span class='precio-lote'>" . $d['total'] . " €</span>";
                                echo "</div>";
                            echo "</div>";
                        echo "</div>";
                    }
                    echo "</div>";
                }
            }
            ?>
        </div>

        <div class="acciones-lotes">
            <a href="tienda.php" class="btn">Volver a Tienda</a>
            <form method="post" action="logout.php" style="margin:0;">
                <button type="submit" class="btn" style="background:#e74c3c;">Finalizar</button>
            </form>
        </div>
    <?php endif; ?>
</div>

</body>
</html>