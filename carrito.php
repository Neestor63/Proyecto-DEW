<?php
session_start();

// Bloqueo si no está logueado
if (!isset($_SESSION["usuario"])) {
    header("Location: login.php");
    exit;
}

$usuario = $_SESSION["usuario"];

// Cargar preferencias
$idioma_actual = $_COOKIE["idioma"] ?? "en";
$estilo_actual = $_COOKIE["estilo"] ?? "claro";
$fuente_actual = $_COOKIE["fuente"] ?? "normal";

require_once "idiomas.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= $T[$idioma_actual]["carrito"] ?></title>
    <link rel="stylesheet" href="/public/assets/css/style.css">
</head>
<body>

<h1><?= $T[$idioma_actual]["carrito"] ?></h1>

<div class="carrito-contenedor">
    <table id="tabla-carrito">
        <thead>
            <tr>
                <th><?= $T[$idioma_actual]["producto"] ?? "Producto" ?></th>
                <th><?= $T[$idioma_actual]["precio"] ?? "Precio" ?></th>
                <th><?= $T[$idioma_actual]["cantidad"] ?? "Cantidad" ?></th>
                <th><?= $T[$idioma_actual]["total_producto"] ?? "Total producto" ?></th>
                <th><?= $T[$idioma_actual]["accion"] ?? "Acción" ?></th>
            </tr>
        </thead>
        <tbody id="carrito-lista">
        </tbody>
    </table>

    <div class="total">
        <?= $T[$idioma_actual]["total"] ?? "Total" ?>: <span id="total">0</span> €
    </div>

    <div class="acciones">
        <button class="btn" onclick="vaciarCarrito()">
            <?= $T[$idioma_actual]["vaciar_carrito"] ?? "Vaciar carrito" ?>
        </button>

        <a href="tienda.php">
            <button class="btn"><?= $T[$idioma_actual]["volver"] ?? "Volver" ?></button>
        </a>
    </div>
</div>

<!-- SCRIPTS -->
<script src="js/productos.js"></script>
<script src="js/carrito.js"></script>

<script>
function actualizarCarritoVisual() {
    const tbody = document.getElementById("carrito-lista");
    const carrito = cargarCarrito();

    tbody.innerHTML = "";

    if (carrito.length === 0) {
        tbody.innerHTML = "<tr><td colspan='5'>El carrito está vacío.</td></tr>";
    } else {
        carrito.forEach(item => {
            tbody.innerHTML += `
                <tr>
                    <td>${item.nombre}</td>
                    <td>${item.precio} €</td>
                    <td>
                        <input type="number" value="${item.cantidad}" min="1"
                            onchange="cambiarCantidad(${item.id}, this.value)">
                    </td>
                    <td>${(item.precio * item.cantidad).toFixed(2)} €</td>
                    <td>
                        <button class="btn" onclick="eliminarProducto(${item.id})">
                            <?= $T[$idioma_actual]["eliminar"] ?? "Eliminar" ?>
                        </button>
                    </td>
                </tr>
            `;
        });
    }

    document.getElementById("total").innerText =
        calcularTotal().toFixed(2);
}

function vaciarCarrito() {
    localStorage.removeItem("carrito");
    actualizarCarritoVisual();
}

actualizarCarritoVisual();
</script>

</body>
</html>
