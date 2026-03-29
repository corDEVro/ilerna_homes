<?php

/* EDITAR INMUEBLE EXISTENTE (SOLO ADMIN.) */

/* Iniciamos la sesion del usuario y
 * agregamos la configuración de la BBDD */
session_start();
require_once '../config/db.php';

/* Solo el administrador puede editar inmuebles */
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    header("Location: index.php");
    exit();
}

/* Almacenamos los nuevos valores introducidos desde el formulario
 * y actualizamos los datos en la BBDD */
if (isset($_POST['actualizar'])) {
    $id = $_POST['id'];
    $titulo = $_POST['titulo'];
    $tipo = $_POST['tipo'];
    $precio = $_POST['precio'];
    $ciudad = $_POST['ciudad'];
    $descripcion = $_POST['descripcion'];

    $sql = "UPDATE inmuebles SET titulo=?, tipo=?, precio=?, ciudad=?, descripcion=? WHERE id=?";
    $stmt = $pdo->prepare($sql);

    /* Si los datos se vuelcan correctamente
     * enviamos un mensaje */
    if ($stmt->execute([$titulo, $tipo, $precio, $ciudad, $descripcion, $id])) {
        echo "<script>alert('¡Inmueble actualizado!'); window.location='editar_inm.php';</script>";
        exit();
    }
}

include '../views/includes/layout.php';
?>

<main class="container py-5">

    <!-- Tenemos que tener un ID de inmueble para que se habra el formulario.
     Esto lo conseguimos al seleccionarlo desde la lista de inmuebles-->
    <?php if (isset($_GET['id'])):
        $stmt = $pdo->prepare("SELECT * FROM inmuebles WHERE id = ?");
        $stmt->execute([$_GET['id']]);

        /* Almacenamos los datos del inmueble seleccionado para
         * que en el formulario nos aparezcan en el valor inicial
         * de cada campo */
        $inm = $stmt->fetch();
    ?>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow border-0">
                    <div class="card-body p-5">
                        <h2 class="fw-bold mb-4 border-bottom pb-3 text-warning">Modificar Inmueble</h2>
                        <form action="editar_inm.php" method="POST">
                            <input type="hidden" name="id" value="<?php echo $inm['id']; ?>">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Título</label>
                                <input type="text" name="titulo" class="form-control" value="<?php echo $inm['titulo']; ?>" required>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Tipo</label>
                                    <select name="tipo" class="form-select">
                                        <option value="piso" <?php if ($inm['tipo'] == 'piso') echo 'selected'; ?>>Piso</option>
                                        <option value="casa" <?php if ($inm['tipo'] == 'casa') echo 'selected'; ?>>Casa</option>
                                        <option value="chalet" <?php if ($inm['tipo'] == 'chalet') echo 'selected'; ?>>Chalet</option>
                                        <option value="local" <?php if ($inm['tipo'] == 'local') echo 'selected'; ?>>Local</option>
                                        <option value="terreno" <?php if ($inm['tipo'] == 'terreno') echo 'selected'; ?>>Terreno</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Precio (€)</label>
                                    <input type="number" name="precio" class="form-control" value="<?php echo $inm['precio']; ?>" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Ciudad</label>
                                <input type="text" name="ciudad" class="form-control" value="<?php echo $inm['ciudad']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Descripción</label>
                                <textarea name="descripcion" class="form-control" rows="4"><?php echo $inm['descripcion']; ?></textarea>
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" name="actualizar" class="btn btn-warning py-3 fw-bold">GUARDAR CAMBIOS</button>
                                <a href="editar_inm.php" class="btn btn-light">Cancelar y volver a la lista</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    <?php else:
        /* Mostramos la lista de inmuebles almacenados
         * con el boton para su edicion */
        $sql = "SELECT i.*, f.ruta FROM inmuebles i LEFT JOIN fotos f ON i.id = f.id_inmueble AND f.es_principal = 1 ORDER BY i.id DESC";
        $inmuebles = $pdo->query($sql)->fetchAll();
    ?>
        <h2 class="fw-bold mb-4"><i class="bi bi-pencil-square"></i> Selecciona el inmueble a Editar</h2>
        <div class="card shadow border-0">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>Foto</th>
                        <th>Título</th>
                        <th>Ciudad</th>
                        <th class="text-center">Acción</th>
                    </tr>
                </thead>
                <tbody>

                    <!-- Usamos un foreach para rellenar la tabla automaticamente
                     con todos los inmuebles que tengamos en la BBDD -->
                    <?php foreach ($inmuebles as $row): ?>
                        <tr>
                            <td><img src="../assets/img/<?php echo $row['ruta']; ?>" style="width: 60px; height: 45px; object-fit: cover;" class="rounded"></td>
                            <td class="fw-bold"><?php echo $row['titulo']; ?></td>
                            <td><?php echo $row['ciudad']; ?></td>
                            <td class="text-center">
                                <a href="editar_inm.php?id=<?php echo $row['id']; ?>" class="btn btn-outline-warning btn-sm">Editar Datos</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</main>

<?php include '../views/includes/footer.php'; ?>