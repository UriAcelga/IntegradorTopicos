<?= $this->extend('layouts/default') ?>
<?= $this->section('content') ?>
<div id="mostrar-view" class="view">
    <h2>Mostrar Información</h2>
    <div class="tabs">
        <button class="tab-btn active" data-tab="mostrar-mascotas">Mascotas</button>
        <button class="tab-btn" data-tab="mostrar-amos">Amos</button>
        <button class="tab-btn" data-tab="mostrar-veterinarios">Veterinarios</button>
        <button class="tab-btn" data-tab="mostrar-amo-mascotas">Mascotas por Amo</button>
        <button class="tab-btn" data-tab="mostrar-mascota-amos">Amos por Mascota</button>
    </div>

    <div id="mostrar-mascotas-tab" class="tab-content active">
        <h3>Lista de Mascotas</h3>
        <div class="table-container">
            <table id="mascotas-table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Especie</th>
                        <th>Raza</th>
                        <th>Nro. Registro</th>
                        <th>Edad</th>
                        <th>Fecha de Alta</th>
                        <th>Fecha de Defunción</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

    <div id="mostrar-amos-tab" class="tab-content">
        <h3>Lista de Amos</h3>
        <div class="table-container">
            <table id="amos-table">
                <thead>
                    <tr>
                        <th>Nombre y Apellido</th>
                        <th>Dirección</th>
                        <th>Teléfono</th>
                        <th>Fecha de Alta</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

    <div id="mostrar-veterinarios-tab" class="tab-content">
        <h3>Lista de Veterinarios</h3>
        <div class="table-container">
            <table id="veterinarios-table">
                <thead>
                    <tr>
                        <th>Nombre y Apellido</th>
                        <th>Especialidad</th>
                        <th>Teléfono Personal</th>
                        <th>Fecha de Ingreso</th>
                        <th>Fecha de Egreso</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

    <div id="mostrar-amo-mascotas-tab" class="tab-content">
        <h3>Mascotas por Amo</h3>
        <form id="mostrar-amo-mascotas-form">
            <div class="form-group">
                <label for="amo-mascotas-select">Seleccionar Amo:</label>
                <select id="amo-mascotas-select" required>
                    <option value="">-- Seleccione un Amo --</option>
                </select>
            </div>
            <button type="button" class="btn btn-primary">Mostrar</button>
        </form>
        <div id="amo-mascotas-result" class="result-container hidden">
            <h4>Mascotas de <span id="amo-nombre-display"></span></h4>
            <div class="table-container">
                <table id="amo-mascotas-table">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Especie</th>
                            <th>Raza</th>
                            <th>Nro. Registro</th>
                            <th>Fecha Inicio</th>
                            <th>Fecha Fin</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="mostrar-mascota-amos-tab" class="tab-content">
        <h3>Amos por Mascota</h3>
        <form id="mostrar-mascota-amos-form">
            <div class="form-group">
                <label for="mascota-amos-select">Seleccionar Mascota:</label>
                <select id="mascota-amos-select" required>
                    <option value="">-- Seleccione una Mascota --</option>
                </select>
            </div>
            <button type="button" class="btn btn-primary">Mostrar</button>
        </form>
        <div id="mascota-amos-result" class="result-container hidden">
            <h4>Amos de <span id="mascota-nombre-display"></span></h4>
            <div class="table-container">
                <table id="mascota-amos-table">
                    <thead>
                        <tr>
                            <th>Nombre y Apellido</th>
                            <th>Dirección</th>
                            <th>Teléfono</th>
                            <th>Fecha Inicio</th>
                            <th>Fecha Fin</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>