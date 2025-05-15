<?= $this->extend('layouts/default') ?>

<?= $this->section('nav') ?>
    <?= view_cell('NavCell::mostrar') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div id="modificacion-view" class="view bg-white rounded-md shadow-md p-6 mt-4">
    <h2 class="text-xl font-semibold mb-4">Modificación de Registros</h2>

    <?php
    // Determinar la pestaña activa. Si no viene del controlador, usa la primera por defecto.
    $current_active_tab = isset($active_tab) && !empty($active_tab) ? $active_tab : 'mod-amo';

    // Helper para mensajes (si lo usas, asegúrate que esté definido o inclúyelo)
    if (!function_exists('display_messages_modificacion')) {
        function display_messages_modificacion($validation_object = null, $success_key = 'success', $error_key = 'error') {
            $output = '';
            if (session()->getFlashdata($success_key)):
                $output .= '<div class="my-2 p-3 text-sm text-green-700 bg-green-100 rounded-lg" role="alert"><span class="font-medium">¡Éxito!</span> ' . esc(session()->getFlashdata($success_key)) . '</div>';
            endif;
            if (session()->getFlashdata($error_key)):
                $output .= '<div class="my-2 p-3 text-sm text-red-700 bg-red-100 rounded-lg" role="alert"><span class="font-medium">¡Error!</span> ' . esc(session()->getFlashdata($error_key)) . '</div>';
            endif;
            if (isset($validation_object) && $validation_object->getErrors()):
                $output .= '<div class="my-2 p-3 text-sm text-red-700 bg-red-100 rounded-lg" role="alert"><span class="font-medium">Por favor corrige los siguientes errores:</span><ul class="mt-1.5 list-disc list-inside">';
                foreach ($validation_object->getErrors() as $error_msg):
                    $output .= '<li>' . esc($error_msg) . '</li>';
                endforeach;
                $output .= '</ul></div>';
            endif;
            return $output;
        }
    }
    ?>

    <div class="border-b border-gray-200 mb-4">
        <div class="tab-buttons-container flex space-x-2 -mb-px">
            <button class="tab-btn bg-white py-2 px-4 border-b-2 font-semibold <?= ($current_active_tab === 'mod-amo') ? 'border-green-500 text-green-500 active' : 'border-transparent text-gray-500 hover:text-green-500 hover:border-gray-300' ?>" data-tab="mod-amo">Amo</button>
            <button class="tab-btn bg-white py-2 px-4 border-b-2 font-semibold <?= ($current_active_tab === 'mod-mascota') ? 'border-green-500 text-green-500 active' : 'border-transparent text-gray-500 hover:text-green-500 hover:border-gray-300' ?>" data-tab="mod-mascota">Mascota</button>
            <button class="tab-btn bg-white py-2 px-4 border-b-2 font-semibold <?= ($current_active_tab === 'mod-veterinario') ? 'border-green-500 text-green-500 active' : 'border-transparent text-gray-500 hover:text-green-500 hover:border-gray-300' ?>" data-tab="mod-veterinario">Veterinario</button>
        </div>
    </div>

    <div class="mt-4">
        <div id="mod-amo-tab" class="tab-content <?= ($current_active_tab === 'mod-amo') ? 'active' : '' ?>">
            <h3 class="text-lg font-semibold mb-2">Modificar Datos de Amo</h3>
            <?= display_messages_modificacion(isset($validation) && $current_active_tab === 'mod-amo' ? $validation : null, 'success_mod_amo', 'error_mod_amo') ?>
            
            <?php echo form_open('modificacionController/modificarAmo', ['id' => 'form-select-amo'])?>
                <div class="bg-gray-200 rounded-md p-4 text-gray-800 mb-4">
                    <div class="mb-2">
                        <label for="mod-amo-select" class="block text-gray-700 text-sm font-bold mb-2">Seleccionar Amo a Modificar:</label>
                        <select id="mod-amo-select" name="mod_amo_select" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-white" required>
                            <option value="">-- Seleccione un Amo --</option>
                            <?php if(!empty($amos)) foreach($amos as $amo_item): ?>
                                <option value="<?php echo esc($amo_item['id_amo']);?>" <?= (isset($amoId) && $amoId == $amo_item['id_amo']) ? 'selected' : '' ?>>
                                    <?php echo esc($amo_item['id_amo']."- ". $amo_item['nombre']." ".$amo_item['apellido']);?>
                                </option>   
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <?php echo form_submit([
                        'name' => 'submit_select_amo',
                        'value' => 'Elegir Amo para Modificar',
                        'class' => 'bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mt-2'
                    ]); ?>
                </div>
            <?php echo form_close(); ?>

            <?php if(isset($amoM) && !empty($amoM)): // Si se ha seleccionado un amo (datos en $amoM) ?>
            <hr class="my-4">
            <h4 class="text-md font-semibold mb-2">Editando Amo: <?= esc($amoM['nombre'] . ' ' . $amoM['apellido']) ?></h4>
            <?php echo form_open('modificacionController/guardarAmo', ['id' => 'form-edit-amo']); ?>
                <?= csrf_field() ?>
                <input type="hidden" name="amo_id_hidden" value="<?= esc($amoM['id_amo']) ?>">
                <div class="bg-gray-300 rounded-md p-4 text-gray-800 space-y-4">
                    <div>
                        <label for="nombre_amo_edit" class="block text-sm font-medium text-gray-900">Nombre:</label>
                        <input type="text" name="nombre" id="nombre_amo_edit" value="<?= esc($amoM['nombre'] ?? '', 'attr') ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required>
                    </div>
                    <div>
                        <label for="apellido_amo_edit" class="block text-sm font-medium text-gray-900">Apellido:</label>
                        <input type="text" name="apellido" id="apellido_amo_edit" value="<?= esc($amoM['apellido'] ?? '', 'attr') ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required>
                    </div>
                    <div>
                        <label for="direccion_amo_edit" class="block text-sm font-medium text-gray-900">Dirección:</label>
                        <input type="text" name="direccion" id="direccion_amo_edit" value="<?= esc($amoM['direccion_amo'] ?? '', 'attr') ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required>
                    </div>
                    <div>
                        <label for="telefono_amo_edit" class="block text-sm font-medium text-gray-900">Teléfono:</label>
                        <input type="tel" name="telefono" id="telefono_amo_edit" value="<?= esc($amoM['telefono'] ?? '', 'attr') ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required>
                    </div>
                    <div class="flex justify-center">
                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Guardar Cambios Amo</button>
                    </div>
                </div>
            <?php echo form_close(); ?>
            <?php endif; ?>
             <?= view_cell('ModalCell::amo', ['amo' => isset($amoM) ? $amoM : null, 'isEdit' => true])?>
        </div>

        <div id="mod-mascota-tab" class="tab-content <?= ($current_active_tab === 'mod-mascota') ? 'active' : '' ?>">
            <h3 class="text-lg font-semibold mb-2">Modificar Datos de Mascota</h3>
            <?= display_messages_modificacion(isset($validation) && $current_active_tab === 'mod-mascota' ? $validation : null, 'success_mod_mascota', 'error_mod_mascota') ?>

            <?php echo form_open('modificacionController/modificarMascota', ['id' => 'form-select-mascota'])?>
                <div class="bg-gray-200 rounded-md p-4 text-gray-800 mb-4">
                    <div class="mb-2">
                        <label for="mod-mascota-select" class="block text-gray-700 text-sm font-bold mb-2">Seleccionar Mascota a Modificar:</label>
                        <select id="mod-mascota-select" name="mod_mascota_select" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-white" required>
                            <option value="">-- Seleccione una Mascota --</option>
                            <?php if(!empty($mascotas)) foreach($mascotas as $mascota_item): ?>
                                <option value="<?php echo esc($mascota_item['nro_registro']);?>" <?= (isset($mascotaId) && $mascotaId == $mascota_item['nro_registro']) ? 'selected' : '' ?>>
                                    <?php echo esc($mascota_item['nro_registro']."- ". $mascota_item['nombre']);?> 
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <?php echo form_submit([
                        'name' => 'submit_select_mascota',
                        'value' => 'Elegir Mascota para Modificar',
                        'class' => 'bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mt-2'
                    ]); ?>
                </div>
            <?php echo form_close(); ?>

            <?php if(isset($mascotaM) && !empty($mascotaM)): ?>
            <hr class="my-4">
            <h4 class="text-md font-semibold mb-2">Editando Mascota: <?= esc($mascotaM['nombre']) ?></h4>
            <?php echo form_open('modificacionController/guardarMascota', ['id' => 'form-edit-mascota']); ?>
                <?= csrf_field() ?>
                <input type="hidden" name="mascota_id_hidden" value="<?= esc($mascotaM['nro_registro']) ?>">
                <div class="bg-gray-300 rounded-md p-4 text-gray-800 space-y-4">
                    <div>
                        <label for="nombre_mascota_edit" class="block text-sm font-medium text-gray-900">Nombre:</label>
                        <input type="text" name="nombre" id="nombre_mascota_edit" value="<?= esc($mascotaM['nombre'] ?? '', 'attr') ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required>
                    </div>
                    <div>
                        <label for="edad_mascota_edit" class="block text-sm font-medium text-gray-900">Edad:</label>
                        <input type="number" name="edad" id="edad_mascota_edit" value="<?= esc($mascotaM['edad'] ?? '', 'attr') ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required>
                    </div>
                    <div class="flex justify-center">
                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Guardar Cambios Mascota</button>
                    </div>
                </div>
            <?php echo form_close(); ?>
            <?php endif; ?>
            <?= view_cell('ModalCell::mascota', ['mascota' => isset($mascotaM) ? $mascotaM : null, 'isEdit' => true])?>
        </div>

        <div id="mod-veterinario-tab" class="tab-content <?= ($current_active_tab === 'mod-veterinario') ? 'active' : '' ?>">
            <h3 class="text-lg font-semibold mb-2">Modificar Datos de Veterinario</h3>
            <?= display_messages_modificacion(isset($validation) && $current_active_tab === 'mod-veterinario' ? $validation : null, 'success_mod_veterinario', 'error_mod_veterinario') ?>

            <?php echo form_open('modificacionController/modificarVeterinario', ['id' => 'form-select-veterinario'])?>
                <div class="bg-gray-200 rounded-md p-4 text-gray-800 mb-4">
                    <div class="mb-2">
                        <label for="mod-vet-select" class="block text-gray-700 text-sm font-bold mb-2">Seleccionar Veterinario a Modificar:</label>
                        <select id="mod-vet-select" name="mod_vet_select" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-white" required>
                            <option value="">-- Seleccione un Veterinario --</option>
                            <?php if(!empty($veterinarios)) foreach($veterinarios as $veterinario_item): ?>
                                <option value="<?php echo esc($veterinario_item['id_veterinario']);?>" <?= (isset($veterinarioId) && $veterinarioId == $veterinario_item['id_veterinario']) ? 'selected' : '' ?>>
                                    <?php echo esc($veterinario_item['id_veterinario']."-". $veterinario_item['nombre']." ". $veterinario_item['apellido']);?> 
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                     <?php echo form_submit([
                        'name' => 'submit_select_veterinario',
                        'value' => 'Elegir Veterinario para Modificar',
                        'class' => 'bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mt-2'
                    ]); ?>
                </div>
            <?php echo form_close(); ?>
            
            <?php if(isset($veterinarioM) && !empty($veterinarioM)): ?>
            <hr class="my-4">
            <h4 class="text-md font-semibold mb-2">Editando Veterinario: <?= esc($veterinarioM['nombre'] . ' ' . $veterinarioM['apellido']) ?></h4>
            <?php echo form_open('modificacionController/guardarVeterinario', ['id' => 'form-edit-veterinario']); ?>
                <?= csrf_field() ?>
                <input type="hidden" name="veterinario_id_hidden" value="<?= esc($veterinarioM['id_veterinario']) ?>">
                <div class="bg-gray-300 rounded-md p-4 text-gray-800 space-y-4">
                    <div>
                        <label for="nombre_vet_edit" class="block text-sm font-medium text-gray-900">Nombre:</label>
                        <input type="text" name="nombre" id="nombre_vet_edit" value="<?= esc($veterinarioM['nombre'] ?? '', 'attr') ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required>
                    </div>
                    <div>
                        <label for="apellido_vet_edit" class="block text-sm font-medium text-gray-900">Apellido:</label>
                        <input type="text" name="apellido" id="apellido_vet_edit" value="<?= esc($veterinarioM['apellido'] ?? '', 'attr') ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required>
                    </div>
                    <div>
                        <label for="especialidad_vet_edit" class="block text-sm font-medium text-gray-900">Especialidad:</label>
                        <select name="especialidad" id="especialidad_vet_edit" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                            <option>-- Seleccione especialidad --</option>
                            <?php $especialidades = ['general', 'interno', 'cirugia', 'dermatologia', 'cardiologia', 'oftalmologia', 'oncologia']; ?>
                            <?php foreach($especialidades as $esp): ?>
                                <option value="<?= esc($esp) ?>" <?= ($veterinarioM['especialidad'] ?? '') === $esp ? 'selected' : '' ?>><?= ucfirst(str_replace('_', ' ', esc($esp))) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <label for="telefono_vet_edit" class="block text-sm font-medium text-gray-900">Teléfono:</label>
                        <input type="tel" name="telefono" id="telefono_vet_edit" value="<?= esc($veterinarioM['telefono'] ?? '', 'attr') ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required>
                    </div>
                    <div class="flex justify-center">
                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Guardar Cambios Veterinario</button>
                    </div>
                </div>
            <?php echo form_close(); ?>
            <?php endif; ?>
            <?= view_cell('ModalCell::veterinario', ['veterinario' => isset($veterinarioM) ? $veterinarioM : null, 'isEdit' => true])?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
