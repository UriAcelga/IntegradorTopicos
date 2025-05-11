<?= $this->extend('layouts/default') ?>
<?= $this->section('content') ?>
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
<?= $this->endSection() ?>