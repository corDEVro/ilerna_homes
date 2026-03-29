<?php

/* AGREGAR INMUEBLES A FAVORITOS */

/* Iniciamos la sesion del usuario y
 * agregamos la configuración de la BBDD */
session_start();
require_once '../config/db.php';

/* Solo los usuarios registrados que tengan
 * el rol de cliente pueden agregar favoritos */
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'cliente' || !isset($_SESSION['id_usuario'])) {
    header("Location: ../views/login.php");
    exit();
}
/* Obtenemos el ID del usuario y el ID del inmueble */
$id_usuario = $_SESSION['id_usuario'];
$id_inmueble = $_GET['id'] ?? null;

/* Si no tengo id de inmueble, vuelvo a la página principal */
if (!$id_inmueble) {
    header("Location: ../views/index.php");
    exit();
}

/* Si el usuario ya tiene el inmueble en favoritos
 * no puede volver a agregarlo */
$stmt_check = $pdo->prepare("SELECT id FROM favoritos WHERE id_usuario = ? AND id_inmueble = ?");
$stmt_check->execute([$id_usuario, $id_inmueble]);

if (!$stmt_check->fetch()) {
    $stmt = $pdo->prepare("INSERT INTO favoritos (id_usuario, id_inmueble) VALUES (?, ?)");
    $stmt->execute([$id_usuario, $id_inmueble]);
}

/* Una vez agregado, volvemos a la página de detalle
 * (debe de aparecer el boton de favoritos cambiado) */
header("Location: ../views/detalle.php?id=" . $id_inmueble);
exit();
