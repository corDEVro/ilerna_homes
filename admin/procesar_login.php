<?php

/* PROCESAR LOGIN DE ADMIN/USUARIOS */

session_start();
require_once '../config/db.php';

/* Comprobamos el envío del formulario */
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    /* Buscamos al usuario por su email, usando la misma lógica con
     * la consulta preparada antes de ejecutarla ("?"),
     * como venimos haciendo en todo el proyecto */
    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);
    $usuario = $stmt->fetch();

    /* Comprobamos si el usuario existe y la contraseña coincide.
     * Si es correcto, guardamos los datos en la sesión */
    if ($usuario && password_verify($password, $usuario['password'])) {

        $_SESSION['id_usuario'] = $usuario['id'];
        $_SESSION['nombre'] = $usuario['nombre'];
        $_SESSION['rol'] = $usuario['rol'];

        /* Independientemente del rol, redirigimos a la página de inicio.
         * Si es el admin, se abriran las opciones de gestión y si es cliente,
         * aparecerá el boton "añadir a favoritos" en los detalles de los inmuebles */
        if ($usuario['rol'] == 'admin') {
            header("Location: ../views/index.php");
        }
        if ($usuario['rol'] == 'cliente') {
            header("Location: ../views/index.php");
        }
        exit();
    } else {
        /* Si falla el login, lo mandamos de vuelta a login.php con un mensaje */
        header("Location: login.php?error=1");
    }
}
