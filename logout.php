<?php
session_start();
session_destroy();
// Borrar cookies usando el MISMO PATH "/" que usaste al crearlas
setcookie("estilo", "", time() - 3600, "/");
setcookie("fuente", "", time() - 3600, "/");
setcookie("idioma", "", time() - 3600, "/");
setcookie("wishlist", "", time() - 3600, "/");
header("Location: login.php");
exit;
?>
