<?php

/* CONFIGURACION DE LA BASE DE DATOS */

$dbUrl = getenv('DATABASE_URL');

if ($dbUrl) {
    $parts = parse_url($dbUrl);
    $host = $parts['host'] ?? 'localhost';
    $port = $parts['port'] ?? '5432';
    $dbName = ltrim($parts['path'] ?? '/ilerna_homes', '/');
    $user = $parts['user'] ?? 'postgres';
    $pass = $parts['pass'] ?? '';
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbName;sslmode=require";
} else {
    $host = getenv('DB_HOST') ?: 'localhost';
    $db   = getenv('DB_NAME') ?: 'ilerna_homes';
    $user = getenv('DB_USER') ?: 'postgres';
    $pass = getenv('DB_PASS') ?: '';
    $dsn = "pgsql:host=$host;port=5432;dbname=$db;sslmode=require";
}

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    die("Error de conexion a la base de datos: " . $e->getMessage());
}
