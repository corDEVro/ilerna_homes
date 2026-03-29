<nav class="navbar navbar-expand-lg navbar-dark navbar-ilerna sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold" href="../views/index.php">
            <span class="text-white">ILERNA</span><span class="text-ilerna">HOMES</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item">
                    <a class="nav-link text-white" href="../views/index.php">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="../views/about.php">Sobre Nosotros</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="../views/contacto.php">Contacto</a>
                </li>

                <!-- Solo para admin. enlaces de gestión -->
                <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin'): ?>
                    <li class="nav-item ms-lg-3">
                        <a class="btn btn-ilerna-pub btn-sm me-2" href="../admin/publicar_inm.php">
                            <i class="bi bi-plus-circle"></i> PUBLICAR
                        </a>
                        <a class="btn btn-ilerna-del btn-sm" href="../admin/eliminar_inm.php">
                            <i class="bi bi-trash"></i> BORRAR
                        </a>
                        <a class="btn btn-ilerna-edit btn-sm" href="../admin/editar_inm.php">
                            <i class="bi bi-pencil"></i> EDITAR
                        </a>
                    </li>
                <?php endif; ?>

                <li class="nav-item ms-lg-2">
                    <?php if (isset($_SESSION['id_usuario'])): ?>
                        <a class="nav-link text-white" href="/ilerna_homes/views/logout.php" title="Cerrar Sesión">
                            <i class="bi bi-box-arrow-right fs-5"></i>
                        </a>
                    <?php else: ?>
                        <a class="nav-link text-white" href="login.php" title="Iniciar Sesión">
                            <i class="bi bi-person-circle fs-5"></i>
                        </a>
                    <?php endif; ?>
                </li>
            </ul>
        </div>
    </div>
</nav>