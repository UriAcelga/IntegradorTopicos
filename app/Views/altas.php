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
        <h3>Nueva Asociacion de Amo y Mascota</h3>
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success" role="alert"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger" role="alert"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>
        <?php if (isset($validation) && $validation->getErrors()): ?>
            <div class="alert alert-danger" role="alert">
                <p>Por favor corrige los siguientes errores:</p>
                <ul>
                    <?php foreach ($validation->getErrors() as $field => $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        <form id="mascota-amo-save-form" action="<?= site_url('altas/guardar_asociacion') ?>" method="post">
            <?= csrf_field() ?>

            <div class="form-section">
                <h4>1. Seleccione al Amo</h4>
                <div class="form-group">
                    <label for="amo_select">Amo:</label>
                    <select name="select_amo" id="amo_select" class="form-control">
                        <option value="">-- Seleccione un Amo --</option>
                        <?php if (!empty($amos_para_select) && is_array($amos_para_select)): ?>
                            <?php foreach ($amos_para_select as $amo): ?>
                                <option value="<?= esc($amo['id_amo']) ?>" <?= set_select('select_amo', $amo['id_amo'], (!empty($old_selected_amo) && $old_selected_amo == $amo['id_amo'])) ?>>
                                    <?= esc($amo['nombre'] . ' ' . $amo['apellido']) ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                    <?php if (isset($validation) && $validation->hasError('select_amo')): ?>
                        <div class="text-danger" style="font-size:0.9em;"><?= $validation->getError('select_amo') ?></div>
                    <?php endif; ?>
                </div>
            </div>
            <hr>
            <div class="form-section">
                <h4>2. Seleccione la Mascota (disponible para asociación)</h4>
                <div class="form-group">
                    <label for="mascota-select">Mascota Disponible:</label>
                    <select name="id_mascota_a_asociar" id="mascota-select" class="form-control">
                        <option value="">-- Seleccione una Mascota --</option>
                        <?php if (!empty($mascotas_disponibles_para_select) && is_array($mascotas_disponibles_para_select)): ?>
                            <?php foreach ($mascotas_disponibles_para_select as $mascota): ?>
                                <option value="<?= esc($mascota['nro_registro']) ?>" <?= set_select('id_mascota_a_asociar', $mascota['nro_registro'], (!empty($old_selected_mascota) && $old_selected_mascota == $mascota['nro_registro'])) ?>>
                                    <?= esc($mascota['nombre'] . ' (' . $mascota['especie'] . ' - ' . $mascota['raza'] . ' ' . $mascota['fecha_alta'] . ')') ?>
                                </option>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <option value="" disabled>No hay mascotas disponibles para asociar en este momento.</option>
                        <?php endif; ?>
                    </select>
                    <?php if (isset($validation) && $validation->hasError('id_mascota_a_asociar')): ?>
                        <div class="text-danger" style="font-size:0.9em;"><?= $validation->getError('id_mascota_a_asociar') ?></div>
                    <?php endif; ?>
                </div>
            </div>
            <hr>
            <div class="form-section">
                <button type="submit" name="btn_guardar_asociacion" value="true" class="btn btn-success">Guardar Asociación Amo-Mascota</button>
            </div>
        </form>

    </div>

    <div id="veterinario-tab" class="tab-content">
        <h3>Registro de Veterinario</h3>
        <form id="veterinario-form">
              <form id="veterinario-form" action="<?= site_url('altas/alta_veterinario') ?>" method="post">
            <div class="form-group">
                <label for="vet-nombre">Nombre y Apellido:</label>
                <input type="text" name= "nombre" id="vet-nombre" required>
            </div>
            <div class="form-group">
                <label for="vet-especialidad">Especialidad:</label>
                <select id="vet-especialidad" name= "especialidad" required>
                    <option>-- Especialidades --</option>
                    <option value="general">-- Generalista --</option>
                    <option value="interno">-- Interno --</option>
                    <option value="cirugía">-- Cirujía --</option>
                    <option value="dermatología">-- Dermatología --</option>
                    <option value="cardiología">-- Cardiología --</option>
                    <option value="oftalmología">-- Oftalmología --</option>
                    <option value="oncología">-- Oncología --</option>
                </select>
            </div>
            <div class="form-group">
                <label for="vet-telefono">Teléfono Personal:</label>
                <input type="input" id="vet-telefono" name= "telefono" required>
            </div>
            <button type="submit" class="btn btn-success">Guardar</button>
        </form>
        <?php if (isset($validation)): ?>
            <div class="alert alert-danger">
                <?= $validation->listErrors() ?>
            </div>
        <?php endif; ?>
    </div>

    <div id="mascota-tab" class="tab-content">
        <h3>Registro de Mascota</h3>
        <form id="mascota-form" action="<?= site_url('altas/alta_mascota') ?>" method="post">
            <div class="form-group">
                <label for="masc-nombre">Nombre mascota:</label>
                <input type="text" id="masc-nombre" name="nombre" required>
            </div>
            <div class="form-group">
                <label for="masc-especie">Especie:</label>
                <select name="especie" id="masc-especie" required>
                    <option>-- Especies --</option>
                    <option value="perro">-- Perro --</option>
                    <option value="gato">-- Gato --</option>
                    <option value="conejo">-- Conejo --</option>
                    <option value="caballo">-- Caballo --</option>
                    <option value="cerdo">-- Cerdo --</option>
                    <option value="cobayo">-- Cobayo --</option>
                    <option value="pajaros">-- Pajaros --</option>
                </select>
            </div>
            <div class="form-group">
                <label for="masc-raza">Raza:</label>
                <input type="text" name="raza" id="masc-raza" required>
            </div>
            <div class="form-group">
                <label for="masc-edad">Edad:</label>
                <input type="text" name="edad" id="masc-edad" required>
            </div>
            <div class="form-group">
                <label for="masc-peso">Peso:</label>
                <input type="text" name="peso" id="masc-peso" required>
            </div>
            <div class="form-group">
                <label for="masc-sexo">Sexo:</label>
                <select id="masc-sexo" name="sexo" required>
                    <option>-- Sexo --</option>
                    <option value="macho">Macho</option>
                    <option value="hembra">Hembra</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Guardar</button>
        </form>
        <?php if (isset($validation)): ?>
            <div class="alert alert-danger">
                <?= $validation->listErrors() ?>
            </div>
        <?php endif; ?>
    </div>

    <div id="amo-tab" class="tab-content">
        <h3>Registro de Amo</h3>
        <form id="amo-form" action="<?= site_url('altas/alta_amo') ?>" method="post">
            <div class="form-group">
                <label for="amo-nombre">Nombre del Amo:</label>
                <input type="text" name="nombre" id="amo-nombre" required>
            </div>
            <div class="form-group">
                <label for="amo-apellido">Apellido del amo:</label>
                <input type="text" name="apellido" id="amo-apellido" required>
            </div>
            <div class="form-group">
                <label for="amo-telefono">Telefono:</label>
                <input type="text" mame="telefono" id="amo-telefono" required>
            </div>

            <div class="form-group">
                <label for="amo-direccion">Direccion del Amo:</label>
                <input type="text" name="direccion" id="amo-direccion" required>
            </div>
            <button type="submit" class="btn btn-success">Guardar</button>
        </form>
        <?php if (isset($validation)): ?>
            <div class="alert alert-danger">
                <?= $validation->listErrors() ?>
            </div>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>