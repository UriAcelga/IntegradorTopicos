<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Veterinaria - Inicio</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
</head>
<body>
    <div class="container">
        <header>
            <h1>Mi Veterinaria</h1>
            <div id="datetime"></div>
        </header>

        <main id="main-content">
            <div id="welcome-screen" class="active-view">
                <div class="welcome-content">
                    <h2>Bienvenido a Mi Veterinaria</h2>
                    <p>Sistema de gestión para mascotas, amos y veterinarios</p>
                    <button id="start-btn" class="btn btn-primary" onclick="window.location.href='<?= route_to('altas') ?>'">Comenzar</button>
                </div>
            </div>
        </main>

        <footer>
            <p>&copy; 2023 Mi Veterinaria - Todos los derechos reservados</p>
        </footer>
    </div>
    <script src="<?= base_url('js/viewManager.js') ?>"></script>
    <script src="<?= base_url('js/app.js') ?>"></script>
</html>