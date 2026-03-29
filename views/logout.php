<?php
session_start();
$_SESSION = array(); // Limpiar todas las variables de sesión
session_destroy();
header("Location: index.php");
exit();
?>