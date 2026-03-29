<?php

/* PUBLICAR INMUEBLE (SOLO ADMIN.) */

session_start();
require_once '../config/db.php';

/* Comprobamos que el rol sea admin, si no lo es, redirigimos a la página de inicio */
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    header("Location: index.php");
    exit();
}

/* Almacenamos los datos traidos del formulario */
if (isset($_POST['guardar'])) {
    $tipo = $_POST['tipo'];
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $habitaciones = $_POST['habitaciones'];
    $banos = $_POST['banos'];
    $ciudad = $_POST['ciudad'];

    $id_usuario_logueado = $_SESSION['id_usuario'];

    /* Añadimos el inmueble nuevo a la base de datos, con consulta preparada.
     * Almacenamos el ID generado del nuevo inmueble para definir el nombre de
     * las fotos, con esto aseguramos que no haya nombres repetidos
     * (IMPORTANTE PARA UNA FUTURA ELIMINACIÓN) */
    $sql = "INSERT INTO inmuebles (tipo, titulo, descripcion, precio, habitaciones, banos,ciudad, id_usuario) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([$tipo, $titulo, $descripcion, $precio, $habitaciones, $banos, $ciudad, $id_usuario_logueado])) {
        $id_casa = $pdo->lastInsertId();
        $carpeta_destino = "../assets/img/";

        /* Definimos la foto que será la principal */
        if (!empty($_FILES['foto_principal']['name'])) {
            $nombre_principal = $id_casa . "_principal_" . $_FILES['foto_principal']['name'];
            if (move_uploaded_file($_FILES['foto_principal']['tmp_name'], $carpeta_destino . $nombre_principal)) {
                $sql_foto = "INSERT INTO fotos (ruta, es_principal, id_inmueble) VALUES (?, 1, ?)";
                $pdo->prepare($sql_foto)->execute([$nombre_principal, $id_casa]);
            }
        }

        /* Procesamos el resto de fotos para la galería.
         * Añadimos un contador para que no haya posibilidad de 
         * repetir nombres de archivos.
         * (IMPORTANTE PARA UNA FUTURA ELIMINACIÓN).
         * Si todo se realiza correctamente, lanzamos un mensaje */
        if (!empty($_FILES['galeria']['name'][0])) {
            $contador = 1;
            foreach ($_FILES['galeria']['name'] as $key => $name) {
                $nombre_galeria = $id_casa . "_gal_" . $contador . "_" . $name;
                if (move_uploaded_file($_FILES['galeria']['tmp_name'][$key], $carpeta_destino . $nombre_galeria)) {
                    $sql_galeria = "INSERT INTO fotos (ruta, es_principal, id_inmueble) VALUES (?, 0, ?)";
                    $pdo->prepare($sql_galeria)->execute([$nombre_galeria, $id_casa]);
                }
                $contador++;
            }
        }
        echo "<script>alert('¡Inmueble y galería guardados!'); window.location='../views/index.php';</script>";
    }
}
include '../views/includes/layout.php';
?>

<main class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow border-0">
                <div class="card-body p-5">
                    <h2 class="fw-bold mb-4 border-bottom pb-3">Publicar Nuevo Inmueble</h2>

                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Título del anuncio</label>
                                <input type="text" name="titulo" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tipo</label>
                                <select name="tipo" class="form-select">
                                    <option value="piso">Piso</option>
                                    <option value="casa">Casa</option>
                                    <option value="chalet">Chalet</option>
                                    <option value="local">Local</option>
                                    <option value="terreno">Terreno</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Precio (€)</label>
                                <input type="number" name="precio" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Habitaciones</label>
                                <input type="number" name="habitaciones" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Baños</label>
                                <input type="number" name="banos" class="form-control">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Ciudad</label>
                                <input type="text" name="ciudad" class="form-control" required>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Descripción</label>
                                <textarea name="descripcion" class="form-control" rows="5"></textarea>
                            </div>
                            <div class="col-md-12 mb-4">
                                <label class="form-label fw-bold text-ilerna-gold-dark">Foto Principal</label>
                                <input type="file" name="foto_principal" class="form-control" accept="image/*" required>
                            </div>
                            <div class="col-md-12 mb-4">
                                <label class="form-label fw-bold text-muted">Galería de Imágenes (Opcional)</label>
                                <input type="file" name="galeria[]" class="form-control" accept="image/*" multiple
                                    style="border-radius: 0;">
                                <div class="form-text">Puedes seleccionar varias fotos a la vez manteniendo pulsada la tecla <strong>Ctrl</strong>.</div>
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" name="guardar" class="btn btn-ilerna-pub py-3">GUARDAR PROPIEDAD</button>
                            <a href="../views/index.php" class="btn btn-dark">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include '../views/includes/footer.php'; ?>