<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Veterinaria - Alta</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
</head>

<body>
    <div class="container">
        <header>
            <h1>Mi Veterinaria</h1>
            <div id="datetime"></div>
        </header>

        <nav id="main-menu">
            <ul>
                <li><a href="<?= route_to('altas') ?>" data-view="alta">Alta</a></li>
                <li><a href="<?= route_to('bajas') ?>" data-view="baja">Baja</a></li>
                <li><a href="<?= route_to('modificacion') ?>" data-view="modificacion">Modificación</a></li>
                <li><a href="<?= route_to('mostrar') ?>" data-view="mostrar">Mostrar</a></li>
            </ul>
        </nav>

        <main id="main-content">
            <?= $this->renderSection('content'); ?>

        </main>

        <footer>
            <button id="back-btn" class="btn btn-secondary" onclick="window.location.href='inicio.html'">Volver al Inicio</button>
            <p>&copy; 2025 Mi Veterinaria - Todos los derechos reservados</p>
        </footer>
    </div>

    <script src="<?= base_url('js/viewManager.js') ?>"></script>
    <script src="<?= base_url('js/app.js') ?>"></script>
    
</body>

</html>