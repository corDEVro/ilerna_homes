<?php

/* ELIMINAR INMUEBLE (SOLO ADMIN.) */

/* Iniciamos la sesion del usuario y
 * agregamos la configuración de la BBDD */
session_start();
require_once '../config/db.php';

/* Solo el administrador puede eliminar inmuebles */
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    header("Location: index.php");
    exit();
}

/* Preparamos la lógica de borrado,
 * añadimos una variable con la ruta de la carpeta donde
 * se almacenan las fotos para poder eliminarlas automaticamente */
if (isset($_GET['borrar_id'])) {
    $id_borrar = $_GET['borrar_id'];
    $carpeta = "../assets/img/";

    /* Consultamos el nombre (ruta) de las fotos asociadas al inmueble
     * para poder eliminarlas de la carpeta física */
    $stmt_fotos = $pdo->prepare("SELECT ruta FROM fotos WHERE id_inmueble = ?");
    $stmt_fotos->execute([$id_borrar]);
    $fotos = $stmt_fotos->fetchAll();

    /* Con un foreach recorremos todas las fotos del inmueble.
     * si la ruta del archivo existe ($carpeta+$foto['ruta'])
     * eliminamos la foto fisica mediante la funcion "unlink()" */
    foreach ($fotos as $foto) {
        $ruta_archivo = $carpeta . $foto['ruta'];
        if (file_exists($ruta_archivo)) {
            unlink($ruta_archivo);
        }
    }

    /* Borrar el inmueble de la BBDD, los datos de la tabla fotos y
     * de la tabla favoritos se eliminarán automaticamente mediante
     * el CASCADE configurado en las tablas de la BBDD */
    $stmt_del = $pdo->prepare("DELETE FROM inmuebles WHERE id = ?");
    if ($stmt_del->execute([$id_borrar])) {
        $mensaje = "Inmueble eliminado correctamente.";
    }
}

/* Preparamos una tabla con todos los inmuebles. Usamos un LEFT JOIN para
 * poner la foto principal de cada uno. Y al igual que en editar_inm.php,
 * usamos un foreach para que todos los inmuebles de la BBDD aparezcan en la tabla.
 * Al clickar en el botón de eliminar nos saldrá una alerta con un mensaje para la confirmacion */
$sql = "SELECT i.id, i.titulo, i.tipo, i.ciudad, i.precio, f.ruta 
        FROM inmuebles i 
        LEFT JOIN fotos f ON i.id = f.id_inmueble AND f.es_principal = 1 
        ORDER BY i.id DESC";
$inmuebles = $pdo->query($sql)->fetchAll();

include '../views/includes/layout.php';
?>

<main class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold"><i class="bi bi-house-door"></i> Listado de Inmuebles</h2>
    </div>

    <?php if (isset($mensaje)): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $mensaje; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="card shadow-sm border-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-dark">
                    <tr>
                        <th style="width: 100px;">Foto</th>
                        <th>Título</th>
                        <th>Ubicación</th>
                        <th>Precio</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($inmuebles as $inm): ?>
                        <tr>
                            <td>
                                <?php if ($inm['ruta']): ?>
                                    <img src="../assets/img/<?php echo $inm['ruta']; ?>" class="img-thumbnail" style="width: 80px; height: 60px; object-fit: cover;">
                                <?php else: ?>
                                    <div class="bg-light text-center rounded py-2 small text-muted">Sin foto</div>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="fw-bold"><?php echo $inm['titulo']; ?></div>
                                <span class="badge bg-info text-dark" style="font-size: 0.7rem;"><?php echo strtoupper($inm['tipo']); ?></span>
                            </td>
                            <td><?php echo $inm['ciudad']; ?></td>
                            <td class="fw-bold"><?php echo number_format($inm['precio'], 0, ',', '.'); ?> €</td>
                            <td class="text-center">
                                <a href="?borrar_id=<?php echo $inm['id']; ?>"
                                    class="btn btn-outline-danger btn-sm"
                                    onclick="return confirm('¿Estás seguro de que quieres eliminar este inmueble? Se borrarán todas sus fotos de la carpeta.')">
                                    <i class="bi bi-trash"></i> Eliminar
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<?php include '../views/includes/footer.php'; ?>