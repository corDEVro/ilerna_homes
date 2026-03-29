<?php include 'includes/layout.php'; ?>

<main class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow border-0">
                <div class="card-body p-5">
                    <h2 class="fw-bold mb-4 border-bottom pb-3">Contacta con Nosotros</h2>
                    <form action="mailto:administracion@ilernahomes.com" method="POST">
                        <div class="mb-3">
                            <input type="text" name="nombre" class="form-control" placeholder="Tu nombre" required>
                        </div>
                        <div class="mb-3">
                            <input type="email" name="email" class="form-control" placeholder="Tu email" required>
                        </div>
                        <div class="mb-3">
                            <textarea name="mensaje" class="form-control" rows="4" placeholder="Estoy interesado en esta propiedad..." required></textarea>
                        </div>
                        <button type="submit" class="btn btn-ilerna-pub w-100 fw-bold py-3 mb-2">
                            ENVIAR MENSAJE
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>


<?php include 'includes/footer.php'; ?>