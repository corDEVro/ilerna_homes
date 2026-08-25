<?php

/* PROCESAR REGISTRO DE USUARIOS */

require_once '../config/db.php';

/* Nos traemos los datos del formulario de "registro.php"*/
$nombre = $_POST['nombre'];
$email = $_POST['email'];
$password_plana = $_POST['password'];


/* Encriptamos la contraseña por seguridad*/
$password_encriptada = password_hash($password_plana, PASSWORD_DEFAULT);

/* Pasamos los datos a la BBDD. Como solo se pueden registrar clientes por la web,
 * dejamos ya fijado el dato en la variable $rol.
 * Como en todo el proyecto, usamos una consulta preparada para volcar los datos a la BBDD. */
$rol = "cliente";
$sql = "INSERT INTO usuarios (nombre, email, password, rol) VALUES (?, ?, ?, ?)";
$stmt = $pdo->prepare($sql);

/* Enviamos un mensaje tanto si la ejecución de la consulta es correcta como si no.
 * Si es correcta redirigimos a la pag. de inicio */
if ($stmt->execute([$nombre, $email, $password_encriptada, $rol])) {
    echo "¡Usuario registrado con éxito!";
    header("Location: /");
} else {
    echo "Error al registrar el usuario.";
}
