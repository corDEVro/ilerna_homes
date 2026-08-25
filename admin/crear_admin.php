<?php

/* ARCHIVO PARA CREAR UN ADMINISTRADOR */

/* Acceso a la BBDD */
require_once __DIR__ . '/../config/db.php';

/* Aquí introdusco los datos del administrador
 * para la BBDD. (El admin. no se tiene que registrar desde la web) */
$nombre = getenv('ADMIN_NOMBRE') ?: 'Administrador';
$email = getenv('ADMIN_EMAIL') ?: 'admin@example.com';
$password_plana = getenv('ADMIN_PASSWORD') ?: 'cambia_esta_password';
$rol = "admin";

/* Usamos password_hash para encriptar la contraseña.
 * Esto lo hacemos con los usuarios "cliente" tambien,
 * por motivos de seguridad */
$password_encriptada = password_hash($password_plana, PASSWORD_DEFAULT);

/* Preparamos los datos para insertarlos en la BBDD.
 * No le añadimos valores a los datos, usamos "?",
 * así se evitan ataques de inyección sql */
$sql = "INSERT INTO usuarios (nombre, email, password, rol) VALUES (?, ?, ?, ?)";
$stmt = $pdo->prepare($sql);

/* Ejecutamos el statement ($stmt) y se le añaden los datos definidos
 * al principio en las variables.
 * Tanto si el volcado ha sido correcto como si no,
 * lanzamos un mensaje.*/
if ($stmt->execute([$nombre, $email, $password_encriptada, $rol])) {
    echo "¡Administrador creado con éxito!";
} else {
    echo "Error al crear el usuario.";
}
