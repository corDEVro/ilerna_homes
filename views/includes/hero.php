<?php
// Forzamos que reconozca la variable definida en el index
global $inmuebles_hero;
?>
<div id="heroHomes" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3500">

    <div class="carousel-indicators">
        <?php foreach ($inmuebles_hero as $key => $h): ?>
            <button type="button" data-bs-target="#heroHomes" data-bs-slide-to="<?php echo $key; ?>"
                class="<?php echo ($key == 0) ? 'active' : ''; ?>" aria-current="true"></button>
        <?php endforeach; ?>
    </div>

    <div class="carousel-inner">
        <?php foreach ($inmuebles_hero as $key => $h): ?>
            <div class="carousel-item <?php echo ($key == 0) ? 'active' : ''; ?>" style="height: 70vh; min-height: 400px;">
                <img src="../assets/img/<?php echo $h['ruta']; ?>" class="d-block w-100 h-100"
                    style="object-fit: cover; filter: brightness(0.5);">

                <div class="carousel-caption d-md-block text-start mb-5 pb-5">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-7">
                                <span class="badge mb-3 px-3 py-2" style="background-color: var(--ilerna-gold);">
                                    DESTACADO
                                </span>
                                <h1 class="display-3 fw-bold mb-2 text-white shadow-sm">
                                    <?php echo htmlspecialchars($h['titulo']); ?>
                                </h1>
                                <p class="fs-4 mb-4 text-light">
                                    <i class="bi bi-geo-alt-fill text-ilerna"></i> <?php echo htmlspecialchars($h['ciudad']); ?>
                                    <span class="ms-3 fw-bold"><?php echo number_format($h['precio'], 0, ',', '.'); ?> €</span>
                                </p>
                                <a href="detalle.php?id=<?php echo $h['id']; ?>" class="btn btn-ilerna-pub btn-lg px-5 py-3 shadow">
                                    <i class="bi bi-eye"></i> VER PROPIEDAD
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#heroHomes" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Anterior</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#heroHomes" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Siguiente</span>
    </button>
</div>