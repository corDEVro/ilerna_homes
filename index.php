<?php
/**
 * Router de entrada para Render.
 * Render sirve desde la raíz del proyecto, así que este archivo
 * enruta las peticiones a los archivos PHP correspondientes.
 */

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = rawurldecode($uri);

// Servir archivos estáticos desde assets/ y public/
if (preg_match('#^/(assets|db|config|sql|composer\.(json|lock))#', $uri)) {
    http_response_code(404);
    return false;
}

// Ruta raíz → homepage
if ($uri === '/' || $uri === '') {
    require __DIR__ . '/views/index.php';
    return;
}

// Rutas de views/
$views = ['detalle', 'login', 'registro', 'logout', 'about', 'contacto'];
foreach ($views as $v) {
    if ($uri === "/{$v}" || $uri === "/{$v}.php") {
        require __DIR__ . "/views/{$v}.php";
        return;
    }
}

// Rutas de admin/
$admin = ['publicar_inm', 'editar_inm', 'eliminar_inm', 'procesar_login', 'procesar_registro', 'agregar_fav', 'crear_admin'];
foreach ($admin as $a) {
    if ($uri === "/{$a}" || $uri === "/{$a}.php") {
        require __DIR__ . "/admin/{$a}.php";
        return;
    }
}

// Fallback: intentar servir el archivo directamente
$file = __DIR__ . $uri;
if (is_file($file) && pathinfo($file, PATHINFO_EXTENSION) === 'php') {
    require $file;
    return;
}

// 404
http_response_code(404);
echo '<h1>404 - No encontrado</h1>';
