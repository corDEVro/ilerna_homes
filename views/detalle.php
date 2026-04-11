<?php
session_start();
require_once '../config/db.php';

// 1. Validar que recibimos un ID
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id = $_GET['id'];

// 2. Consultar datos del inmueble
$stmt = $pdo->prepare("SELECT * FROM inmuebles WHERE id = ?");
$stmt->execute([$id]);
$inmueble = $stmt->fetch();

if (!$inmueble) {
    echo "Inmueble no encontrado.";
    exit();
}

// 3. Consultar TODAS las fotos de este inmueble
$stmt_fotos = $pdo->prepare("SELECT * FROM fotos WHERE id_inmueble = ? ORDER BY es_principal DESC");
$stmt_fotos->execute([$id]);
$fotos = $stmt_fotos->fetchAll();

// 4. Saber si este inmueble ya está en favoritos del usuario logueado
$esFavorito = false;
if (isset($_SESSION['rol'], $_SESSION['id_usuario']) && $_SESSION['rol'] === 'cliente') {
    $stmt_fav = $pdo->prepare("SELECT 1 FROM favoritos WHERE id_usuario = ? AND id_inmueble = ? LIMIT 1");
    $stmt_fav->execute([$_SESSION['id_usuario'], $id]);
    $esFavorito = (bool) $stmt_fav->fetchColumn();
}

include 'includes/layout.php';
?>

<main class="container py-5">
    <a href="index.php" class="btn btn-link text-dark ps-0 mb-4 text-decoration-none">
        <i class="bi bi-arrow-left"></i> Volver al listado
    </a>

    <div class="row g-5">
        <div class="col-lg-8">
            <h1 class="fw-bold mb-2"><?php echo htmlspecialchars($inmueble['titulo']); ?></h1>
            <p class="text-muted fs-5 mb-4">
                <i class="bi bi-geo-alt-fill text-ilerna"></i> <?php echo htmlspecialchars($inmueble['ciudad']); ?>
            </p>

            <div id="carouselDetalle" class="carousel slide shadow-sm rounded-4 overflow-hidden mb-5" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <?php foreach ($fotos as $key => $f): ?>
                        <div class="carousel-item <?php echo ($key == 0) ? 'active' : ''; ?>">
                            <img src="../assets/img/<?php echo $f['ruta']; ?>" class="d-block w-100" style="height: 500px; object-fit: cover;">
                        </div>
                    <?php endforeach; ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselDetalle" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselDetalle" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
            </div>

            <div class="row g-3 mb-5 text-center">
                <div class="col-4 col-md-2">
                    <div class="p-3 bg-light rounded-3 border-bottom border-3 border-ilerna">
                        <i class="bi bi-door-open fs-3 text-ilerna"></i>
                        <div class="small fw-bold mt-2"><?php echo $inmueble['habitaciones']; ?> Hab.</div>
                    </div>
                </div>
                <div class="col-4 col-md-2">
                    <div class="p-3 bg-light rounded-3 border-bottom border-3 border-ilerna">
                        <i class="bi bi-droplet fs-3 text-ilerna"></i>
                        <div class="small fw-bold mt-2"><?php echo $inmueble['banos']; ?> Baños</div>
                    </div>
                </div>
            </div>

            <h4 class="fw-bold mb-3 border-bottom pb-2">Descripción</h4>
            <p class="text-secondary lh-lg fs-5">
                <?php echo nl2br(htmlspecialchars($inmueble['descripcion'])); ?>
            </p>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-lg sticky-top" style="top: 100px; z-index: 10;">
                <div class="card-body p-4">
                    <h2 class="fw-bold text-dark mb-4">
                        <?php echo number_format($inmueble['precio'], 0, ',', '.'); ?> €
                    </h2>

                    <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'cliente'): ?>
                        <div class="text-center mb-3">
                            <?php if ($esFavorito): ?>
                                <span class="badge bg-success py-2 px-3 mb-2">
                                    <i class="bi bi-heart-fill"></i> Inmueble en favoritos
                                </span>
                                <a class="btn btn-danger btn-sm" href="../admin/agregar_fav.php?id=<?php echo $id; ?>">
                                    <i class="bi bi-heart-fill"></i> ELIMINAR DE FAVORITOS
                                </a>

                            <?php else: ?>
                                <a class="btn btn-ilerna-pub btn-sm" href="../admin/agregar_fav.php?id=<?php echo $id; ?>">
                                    <i class="bi bi-plus-circle"></i> AGREGAR A FAVORITOS
                                </a>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                    <hr>

                    <h5 class="fw-bold mb-3">Solicitar información</h5>
                    <form action="mailto:administracion@ilernahomes.com" method="POST">
                        <div class="mb-3">
                            <input type="text" class="form-control" placeholder="Tu nombre" required>
                        </div>
                        <div class="mb-3">
                            <input type="email" class="form-control" placeholder="Tu email" required>
                        </div>
                        <div class="mb-3">
                            <textarea class="form-control" rows="4" placeholder="Estoy interesado en esta propiedad..."></textarea>
                        </div>
                        <button type="submit" class="btn btn-ilerna-pub w-100 fw-bold py-3 mb-2">
                            ENVIAR MENSAJE
                        </button>
                        <a href="tel:+34900123456" class="btn btn-outline-dark w-100 fw-bold py-3">
                            <i class="bi bi-telephone"></i> LLAMAR AHORA
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include 'includes/footer.php'; ?>