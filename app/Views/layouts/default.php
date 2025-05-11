<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Veterinaria - Alta</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
            <div id="alta-view" class="view">
                <h2>Alta de Registros</h2>
                <div class="tabs">
                    <button class="tab-btn active" data-tab="mascota-amo">Mascota-Amo</button>
                    <button class="tab-btn" data-tab="veterinario">Veterinario</button>
                    <button class="tab-btn" data-tab="mascota">Mascota</button>
                    <button class="tab-btn" data-tab="amo">Amo</button>
                </div>

                <div id="mascota-amo-tab" class="tab-content active">
                    <h3>Registro de Mascota y Amo</h3>
                    <form id="mascota-amo-form">
                        <div class="form-section">
                            <h4>Datos del Amo</h4>
                            <div class="form-group">
                                <label for="amo-select">Seleccionar Amo Existente:</label>
                                <select id="amo-select">
                                    <option value="">-- Nuevo Amo --</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-section">
                            <h4>Datos de la Mascota</h4>
                            <div class="form-group">
                                <label for="mascota-select">Seleccionar Mascota Existente:</label>
                                <select id="mascota-select">
                                    <option value="">-- Nueva Mascota --</option>
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success">Guardar</button>
                    </form>
                </div>

                <div id="veterinario-tab" class="tab-content">
                    <h3>Registro de Veterinario</h3>
                    <form id="veterinario-form">
                        <div class="form-group">
                            <label for="vet-nombre">Nombre y Apellido:</label>
                            <input type="text" id="vet-nombre" required>
                        </div>
                        <div class="form-group">
                            <label for="vet-especialidad">Especialidad:</label>
                            <select id="vet-especialidad">
                                <option value="">-- Especialidades --</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="vet-telefono">Teléfono Personal:</label>
                            <input type="tel" id="vet-telefono" required>
                        </div>
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </form>
                </div>

                <div id="mascota-tab" class="tab-content">
                    <h3>Registro de Mascota</h3>
                    <form id="mascota-form">
                        <div class="form-group">
                            <label for="masc-nombre">Nombre mascota:</label>
                            <input type="text" id="masc-nombre" required>
                        </div>
                        <div class="form-group">
                            <label for="masc-especie">Especie:</label>
                            <select id="masc-especie">
                                <option value="">-- Especies --</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="masc-raza">Raza:</label>
                            <select id="masc-raza">
                                <option value="">-- Razas --</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="masc-edad">Edad:</label>
                            <input type="text" id="masc-edad" required>
                        </div>
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </form>
                </div>

                <div id="amo-tab" class="tab-content">
                    <h3>Registro de Amo</h3>
                    <form id="amo-form">
                        <div class="form-group">
                            <label for="amo-nombre">Nombre del Amo:</label>
                            <input type="text" id="amo-nombre" required>
                        </div>
                        <div class="form-group">
                            <label for="amo-apellido">Apellido del amo:</label>
                            <input type="text" id="amo-apellido" required>
                        </div>
                        <div class="form-group">
                            <label for="amo-telefono">Telefono:</label>
                            <input type="text" id="amo-telefono" required>
                        </div>
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </form>
                </div>
            </div>
        </main>

        <footer>
            <button id="back-btn" class="btn btn-secondary" onclick="window.location.href='inicio.html'">Volver al Inicio</button>
            <p>&copy; 2023 Mi Veterinaria - Todos los derechos reservados</p>
        </footer>
    </div>

    <script src="<?= base_url('js/viewManager.js') ?>"></script>
    <script src="<?= base_url('js/app.js') ?>"></script>
    
</body>

</html>