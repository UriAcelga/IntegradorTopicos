<?= $this->extend('layouts/default') ?>
<?= $this->section('content') ?>
<div id="baja-view" class="view">
    <h2>Baja de Registros</h2>
    <div class="tabs">
        <button class="tab-btn active" data-tab="baja-mascota-amo">Relación Mascota-Amo</button>
        <button class="tab-btn" data-tab="baja-veterinario">Veterinario</button>
    </div>

    <div id="baja-mascota-amo-tab" class="tab-content active">
        <h3>Baja de Relación Mascota-Amo</h3>
        <form id="baja-mascota-amo-form">
            <div class="form-group">
                <label for="baja-amo-select">Seleccionar Amo:</label>
                <select id="baja-amo-select" required>
                    <option value="">-- Seleccione un Amo --</option>
                </select>
            </div>
            <div class="form-group">
                <label for="baja-mascota-select">Seleccionar Mascota:</label>
                <select id="baja-mascota-select" required disabled>
                    <option value="">-- Seleccione una Mascota --</option>
                </select>
            </div>
            <div class="form-group">
                <label>Motivo de Baja:</label>
                <div class="radio-group">
                    <label for="motivo-venta">Venta</label>
                    <input type="radio" id="motivo-venta" name="motivo-baja" value="venta" required>
                    <label for="motivo-fallecimiento">Fallecimiento</label>
                    <input type="radio" id="motivo-fallecimiento" name="motivo-baja" value="fallecimiento">
                </div>
            </div>
            <button type="submit" class="btn btn-danger">Dar de Baja</button>
        </form>
    </div>

    <div id="baja-veterinario-tab" class="tab-content">
        <h3>Baja de Veterinario</h3>
        <form id="baja-veterinario-form">
            <div class="form-group">
                <label for="baja-vet-select">Seleccionar Veterinario:</label>
                <select id="baja-vet-select" required>
                    <option value="">-- Seleccione un Veterinario --</option>
                </select>
            </div>
            <button type="submit" class="btn btn-danger">Dar de Baja</button>
        </form>
    </div>
</div>
<?= $this->endSection() ?>