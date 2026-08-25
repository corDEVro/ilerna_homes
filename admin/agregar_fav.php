<?php

/* AGREGAR INMUEBLES A FAVORITOS */

/* Iniciamos la sesion del usuario y
 * agregamos la configuración de la BBDD */
session_start();
require_once __DIR__ . '/../config/db.php';

/* Solo los usuarios registrados que tengan
 * el rol de cliente pueden agregar favoritos */
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'cliente' || !isset($_SESSION['id_usuario'])) {
    header("Location: /login");
    exit();
}
/* Obtenemos el ID del usuario y el ID del inmueble */
$id_usuario = $_SESSION['id_usuario'];
$id_inmueble = $_GET['id'] ?? null;

/* Si no tengo id de inmueble, vuelvo a la página principal */
if (!$id_inmueble) {
    header("Location: /");
    exit();
}

/* Si el usuario ya tiene el inmueble en favoritos, lo puede eliminar
 * Si no lo tiene, lo agrega */
$stmt_check = $pdo->prepare("SELECT id FROM favoritos WHERE id_usuario = ? AND id_inmueble = ?");
$stmt_check->execute([$id_usuario, $id_inmueble]);
$favorito_existe = $stmt_check->fetch();

if ($favorito_existe) {
    /* Eliminar de favoritos */
    $stmt = $pdo->prepare("DELETE FROM favoritos WHERE id_usuario = ? AND id_inmueble = ?");
    $stmt->execute([$id_usuario, $id_inmueble]);
} else {
    /* Agregar a favoritos */
    $stmt = $pdo->prepare("INSERT INTO favoritos (id_usuario, id_inmueble) VALUES (?, ?)");
    $stmt->execute([$id_usuario, $id_inmueble]);
}

/* Una vez agregado, volvemos a la página de detalle
 * (debe de aparecer el boton de favoritos cambiado) */
header("Location: ../views/detalle.php?id=" . $id_inmueble);
exit();
