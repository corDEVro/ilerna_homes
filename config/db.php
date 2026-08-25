<?php

/* CONFIGURACION DE LA BASE DE DATOS */

$host = getenv('DB_HOST') ?: 'localhost';
$db   = getenv('DB_NAME') ?: 'ilerna_homes';
$user = getenv('DB_USER') ?: 'postgres';
$pass = getenv('DB_PASS') ?: '';
$charset = 'utf8';

$dsn = "pgsql:host=$host;port=5432;dbname=$db;sslmode=require";

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
