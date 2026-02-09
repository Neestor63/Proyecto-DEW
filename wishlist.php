<?php
// Leer wishlist desde cookie (convertida de JSON a array)
$wishlist = isset($_COOKIE['wishlist']) ? json_decode($_COOKIE['wishlist'], true) : [];

// Si la cookie está dañada, obligamos a que sea un array
if (!is_array($wishlist)) {
    $wishlist = [];
}

// Si el usuario envió un producto para añadir
if (isset($_POST['id'])) {

    // Convertir ID a número
    $id = (int)$_POST['id'];

    // Añadir solo si no existe ya en la wishlist
    if (!in_array($id, $wishlist)) {
        $wishlist[] = $id;
    }

    // Guardar la lista actualizada usando JSON
    setcookie("wishlist", json_encode($wishlist), time() + 86400 * 30, "/");
}

// Redirigir a la lista de deseos
header("Location: lista_deseos.php");
exit;
