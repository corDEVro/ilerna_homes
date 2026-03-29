<?php include 'includes/layout.php'; ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso Administrador - Ilerna Homes</title>
</head>

<body class="bg-light">

    <div class="container mt-5 d-flex flex-column min-vh-100">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card shadow">
                    <div class="card-body">
                        <h3 class="card-title text-center mb-4">Iniciar Sesión</h3>
                        <form action="../admin/procesar_login.php" method="POST">
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Contraseña</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-ilerna-pub w-100">Entrar</button>
                        </form>
                        <p>Si no estás registrado, puedes hacerlo <a href="registro.php">aquí</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
<?php include 'includes/footer.php'; ?>