<?php
session_start();
require_once __DIR__ . '/../config/db.php';

// 1. CONSULTA PARA EL CARRUSEL DEL HERO (ultimas 5 fotos)
$stmt_hero = $pdo->query("SELECT inmuebles.*, fotos.ruta FROM inmuebles 
                          LEFT JOIN fotos ON inmuebles.id = fotos.id_inmueble 
                          AND fotos.es_principal = true 
                          ORDER BY inmuebles.id DESC LIMIT 5");
$inmuebles_hero = $stmt_hero->fetchAll();


// 2. BUSCADOR DE INMUEBLES
$params = [];
$where = " WHERE 1=1 ";

if (!empty($_GET['ciudad'])) {
    $where .= " AND inmuebles.ciudad LIKE ? ";
    $params[] = "%" . $_GET['ciudad'] . "%";
}
if (!empty($_GET['tipo'])) {
    $where .= " AND inmuebles.tipo = ? ";
    $params[] = $_GET['tipo'];
}
if (!empty($_GET['habs'])) {
    $where .= " AND inmuebles.habitaciones >= ? ";
    $params[] = $_GET['habs'];
}

$orden_sql = " ORDER BY inmuebles.id DESC ";
if (!empty($_GET['orden'])) {
    if ($_GET['orden'] == 'barato') $orden_sql = " ORDER BY inmuebles.precio ASC ";
    if ($_GET['orden'] == 'caro')   $orden_sql = " ORDER BY inmuebles.precio DESC ";
}

$sql = "SELECT inmuebles.*, fotos.ruta FROM inmuebles 
        LEFT JOIN fotos ON inmuebles.id = fotos.id_inmueble AND fotos.es_principal = true 
        $where $orden_sql";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$inmuebles = $stmt->fetchAll();

// Cargamos las partes de la web (estan en el orden en el que se muestran)
include 'includes/layout.php';
include 'includes/hero.php';
include 'includes/buscador.php';
?>

<main id="main" class="container py-5">
    <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin'): ?>
        <h3 class="bg-ilerna-gold-dark text-ilerna-dark p-3 rounded text-center mb-4">Gestión de Administrador</h3>
    <?php endif; ?>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold border-start border-4 border-ilerna ps-3">Nuestras Propiedades</h2>
        <span class="text-muted"><?php echo count($inmuebles); ?> inmuebles encontrados</span>
    </div>


    <?php if (count($inmuebles) > 0): ?>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
            <?php foreach ($inmuebles as $casa): ?>
                <div class="col">
                    <div class="card h-100 border-0 shadow-sm card-inmueble">
                        <a href="detalle.php?id=<?php echo $casa['id']; ?>" class="text-decoration-none">
                            <div class="position-relative">
                                <img src="../assets/img/<?php echo $casa['ruta'] ?: 'default.jpg'; ?>"
                                    class="card-img-top" style="height: 200px; object-fit: cover;">
                                <span class="badge position-absolute top-0 end-0 m-3 bg-dark">
                                    <?php echo strtoupper($casa['tipo']); ?>
                                </span>
                            </div>
                        </a>

                        <div class="card-body">
                            <h6 class="card-title fw-bold text-dark text-truncate mb-1"><?php echo $casa['titulo']; ?></h6>
                            <p class="text-muted small mb-2"><i class="bi bi-geo-alt text-ilerna"></i> <?php echo $casa['ciudad']; ?></p>
                            <h5 class="fw-bold text-dark mb-3"><?php echo number_format($casa['precio'], 0, ',', '.'); ?> €</h5>

                            <div class="d-flex justify-content-between text-secondary small border-top pt-2">
                                <span><i class="bi bi-door-open text-ilerna"></i> <?php echo $casa['habitaciones']; ?> hab.</span>
                                <span><i class="bi bi-droplet text-ilerna"></i> <?php echo $casa['banos']; ?> baños</span>
                            </div>
                        </div>

                        <div class="card-footer bg-white border-0 pb-3">
                            <a href="detalle.php?id=<?php echo $casa['id']; ?>" class="btn btn-outline-dark btn-sm w-100 rounded-pill">
                                Ver Detalles
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="alert alert-info text-center py-5">
            <i class="bi bi-info-circle fs-1 mb-3 d-block"></i>
            <h4>No hay resultados</h4>
            <p>Prueba a cambiar los filtros de búsqueda.</p>
            <a href="index.php" class="btn btn-ilerna mt-2">Ver todos</a>
        </div>
    <?php endif; ?>
</main>
<?php include 'includes/footer.php'; ?>