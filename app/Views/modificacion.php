<?= $this->extend('layouts/default') ?>
<?= $this->section('content') ?>
<div id="modificacion-view" class="view">
    <h2>Modificación de Registros</h2>
    <div class="tabs">
        <button class="tab-btn active" data-tab="mod-amo">Amo</button>
        <button class="tab-btn" data-tab="mod-mascota">Mascota</button>
        <button class="tab-btn" data-tab="mod-veterinario">Veterinario</button>
    </div>

    <div id="mod-amo-tab" class="tab-content active">
        <h3>Modificar Datos de Amo</h3>
        <form id="mod-amo-form">
            <div class="form-group">
                <label for="mod-amo-select">Seleccionar Amo:</label>
                <select id="mod-amo-select" required>
                    <option value="">-- Seleccione un Amo --</option>
                </select>
            </div>
            <button type="button" class="btn btn-primary">Modificar</button> <br>
            <div id="mod-amo-fields" class="hidden">
                <div class="form-group">
                    <label for="mod-amo-nombre">Nombre y Apellido:</label>
                    <input type="text" id="mod-amo-nombre" required>
                </div>
                <div class="form-group">
                    <label for="mod-amo-direccion">Dirección:</label>
                    <input type="text" id="mod-amo-direccion" required>
                </div>
                <div class="form-group">
                    <label for="mod-amo-telefono">Teléfono:</label>
                    <input type="tel" id="mod-amo-telefono" required>
                </div>
                <button type="submit" class="btn btn-warning">Actualizar</button>
            </div>
        </form>
    </div>

    <div id="mod-mascota-tab" class="tab-content">
        <h3>Modificar Datos de Mascota</h3>
        <form id="mod-mascota-form">
            <div class="form-group">
                <label for="mod-mascota-select">Seleccionar Mascota:</label>
                <select id="mod-mascota-select" required>
                    <option value="">-- Seleccione una Mascota --</option>
                </select>
            </div>
            <button type="button" class="btn btn-primary">Modificar</button>
            <div id="mod-mascota-fields" class="hidden">
                <div class="form-group">
                    <label for="mod-mascota-nombre">Nombre:</label>
                    <input type="text" id="mod-mascota-nombre" required>
                </div>
                <div class="form-group">
                    <label for="mod-mascota-especie">Especie:</label>
                    <input type="text" id="mod-mascota-especie" required>
                </div>
                <div class="form-group">
                    <label for="mod-mascota-raza">Raza:</label>
                    <input type="text" id="mod-mascota-raza" required>
                </div>
                <div class="form-group">
                    <label for="mod-mascota-registro">Nro. Registro:</label>
                    <input type="text" id="mod-mascota-registro" required>
                </div>
                <div class="form-group">
                    <label for="mod-mascota-edad">Edad:</label>
                    <input type="number" id="mod-mascota-edad" min="0" required>
                </div>
                <button type="submit" class="btn btn-warning">Actualizar</button>
            </div>
        </form>
    </div>

    <div id="mod-veterinario-tab" class="tab-content">
        <h3>Modificar Datos de Veterinario</h3>
        <form id="mod-veterinario-form">
            <div class="form-group">
                <label for="mod-vet-select">Seleccionar Veterinario:</label>
                <select id="mod-vet-select" required>
                    <option value="">-- Seleccione un Veterinario --</option>
                </select>
            </div>
            <button type="button" class="btn btn-primary">Modificar</button>
            <div id="mod-vet-fields" class="hidden">
                <div class="form-group">
                    <label for="mod-vet-nombre">Nombre y Apellido:</label>
                    <input type="text" id="mod-vet-nombre" required>
                </div>
                <div class="form-group">
                    <label for="mod-vet-especialidad">Especialidad:</label>
                    <input type="text" id="mod-vet-especialidad" required>
                </div>
                <div class="form-group">
                    <label for="mod-vet-telefono">Teléfono Personal:</label>
                    <input type="tel" id="mod-vet-telefono" required>
                </div>
                <button type="submit" class="btn btn-warning">Actualizar</button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>