
<?php
include 'header.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ILERNA HOMES | Tu Inmobiliaria de Confianza</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --ilerna-gold: #bda466;
            --ilerna-gold-dark: #a68d52;
            --ilerna-light: #f9f7f2;
            --ilerna-dark: #1a1a1a;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #ffffff;
            color: var(--ilerna-dark);
        }

        html {
            margin: 0;
            padding: 0;
        }

        /* Navbar Estilo ILERNA */
        .navbar-ilerna {
            background-color: var(--ilerna-dark);
            border-bottom: 4px solid var(--ilerna-gold);
        }

        .nav-link {
            text-transform: uppercase;
            font-size: 0.9rem;
            font-weight: 700;
            letter-spacing: 1px;
            transition: color 0.3s;
        }

        .nav-link:hover {
            color: var(--ilerna-gold) !important;
        }

        /* Botón de Publicar */
        .btn-ilerna-pub {
            background-color: var(--ilerna-gold);
            color: white;
            border: none;
            font-weight: 700;
            border-radius: 50px;
            padding: 8px 20px;
            transition: all 0.3s;
        }
        /* Boton de Eliminar*/
        .btn-ilerna-del {
            background-color: var(--ilerna-gold);
            color: white;
            border: none;
            font-weight: 700;
            border-radius: 50px;
            padding: 8px 20px;
            transition: all 0.3s;
        }
        /* Boton de Editar*/
        .btn-ilerna-edit {
            background-color: var(--ilerna-gold);
            color: white;
            border: none;
            font-weight: 700;
            border-radius: 50px;
            padding: 8px 20px;
            transition: all 0.3s;
        }

        .btn-ilerna-pub:hover, .btn-ilerna-del:hover, .btn-ilerna-edit:hover {
            background-color: var(--ilerna-gold-dark);
            color: white;
            transform: scale(1.05);
        }

        /* Efectos de las Cards (para que ya queden definidos) */
        .card-inmueble {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-radius: 15px;
            overflow: hidden;
        }

        .card-inmueble:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 30px var(--ilerna-gold-dark) !important;
        }

        .text-ilerna { color: var(--ilerna-gold) !important; }
        .text-ilerna-dark { color: var(--ilerna-dark) !important; }
        .text-ilerna-gold-dark { color: var(--ilerna-gold-dark) !important; }
        .bg-ilerna-gold-dark { background-color: var(--ilerna-gold-dark) !important; }
        .border-ilerna { border-color: var(--ilerna-gold) !important; }

        /* Estilos del Footer */
        .hover-cyan:hover {
            color: var(--ilerna-gold) !important;
            transition: 0.3s;
        }
        .form-control:focus {
            border-color: var(--ilerna-gold-dark);
            box-shadow: 0 0 0 0.25rem rgba(0, 188, 212, 0.25);
        }
    </style>
</head>
<body>

