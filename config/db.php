<?php

/* CONFIGURACIÓN DE LA BASE DE DATOS */

/* Datos de acceso por defecto de XAMPP */
$host = 'localhost';
$db = 'ilerna_homes';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

/* Cadena para la conexión */
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

/* Opciones de conexión por PDO (PHP Data Objects), mas completo que mysqli */
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,   // Si hay fallo, lanza una excepción (más info para resolver el error))
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,         // Maneja los datos con los nombres de las columnas de las tablas.
    PDO::ATTR_EMULATE_PREPARES   => false,                    // Desactiva la emulacion de seguridad de las consultas preparadas.
];

try {

    $pdo = new PDO($dsn, $user, $pass, $options);   // Creando la conexión con la cadena de conexión, los datos y las opciones.

} catch (\PDOException $e) {

    die("Error de conexión a la base de datos: " . $e->getMessage());   // Mostramos el error de conexión a la BBDD (si lo hay)
}
