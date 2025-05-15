<?= $this->extend('layouts/default') ?>

<?= $this->section('nav') ?>
    <?= $this->include('components/nav') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div id="alta-view" class="view"> <h2 class="text-xl font-semibold mb-4">Alta de Registros</h2>

    <?php
    // Determinar la pestaña activa. Por defecto 'mascota-amo' si no se especifica.
    $current_active_tab = isset($active_tab) && !empty($active_tab) ? $active_tab : 'mascota-amo';

    // Helper para mostrar mensajes de sesión y validación con estilo Tailwind
    // (Esta función puede estar aquí o en un archivo de helpers si la usas en múltiples vistas)
    if (!function_exists('display_messages_altas')) { // Evitar redeclaración si se incluye múltiples veces
        function display_messages_altas($validation_object, $success_key = 'success', $error_key = 'error') {
            $output = '';
            if (session()->getFlashdata($success_key)):
                $output .= '<div class="mb-4 p-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">';
                $output .= '<span class="font-medium">¡Éxito!</span> ' . esc(session()->getFlashdata($success_key));
                $output .= '</div>';
            endif;
            if (session()->getFlashdata($error_key)):
                $output .= '<div class="mb-4 p-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">';
                $output .= '<span class="font-medium">¡Error!</span> ' . esc(session()->getFlashdata($error_key));
                $output .= '</div>';
            endif;
            if (isset($validation_object) && $validation_object->getErrors()):
                $output .= '<div class="mb-4 p-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">';
                $output .= '<span class="font-medium">Por favor corrige los siguientes errores:</span>';
                $output .= '<ul class="mt-1.5 list-disc list-inside">';
                foreach ($validation_object->getErrors() as $error_msg): // Cambiado $error a $error_msg para evitar conflicto
                    $output .= '<li>' . esc($error_msg) . '</li>';
                endforeach;
                $output .= '</ul></div>';
            endif;
            return $output;
        }
    }
    ?>

    <div class="border-b border-gray-200">
        <div class="tab-buttons-container flex space-x-2 -mb-px">
            <button class="tab-btn py-2 px-4 border-b-2 font-semibold <?= ($current_active_tab === 'mascota-amo') ? 'border-green-500 text-green-500 active' : 'border-transparent text-gray-500 hover:text-green-500 hover:border-gray-300' ?>" data-tab="mascota-amo">Mascota-Amo</button>
            <button class="tab-btn py-2 px-4 border-b-2 font-semibold <?= ($current_active_tab === 'veterinario') ? 'border-green-500 text-green-500 active' : 'border-transparent text-gray-500 hover:text-green-500 hover:border-gray-300' ?>" data-tab="veterinario">Veterinario</button>
            <button class="tab-btn py-2 px-4 border-b-2 font-semibold <?= ($current_active_tab === 'mascota') ? 'border-green-500 text-green-500 active' : 'border-transparent text-gray-500 hover:text-green-500 hover:border-gray-300' ?>" data-tab="mascota">Mascota</button>
            <button class="tab-btn py-2 px-4 border-b-2 font-semibold <?= ($current_active_tab === 'amo') ? 'border-green-500 text-green-500 active' : 'border-transparent text-gray-500 hover:text-green-500 hover:border-gray-300' ?>" data-tab="amo">Amo</button>
        </div>
    </div>

    <div class="mt-4">
        <div id="mascota-amo-tab" class="tab-content <?= ($current_active_tab === 'mascota-amo') ? 'active' : '' ?>">
            <h3 class="text-lg font-semibold mb-2">Nueva Asociación de Amo y Mascota</h3>
            <?= display_messages_altas(isset($validation_asociacion) ? $validation_asociacion : null, 'success', 'error') ?>
            
            <form id="mascota-amo-save-form" action="<?= site_url('altas/guardarAsociacion') ?>" method="post" class="space-y-4">
                <?= csrf_field() ?>
                <div class="bg-gray-300 rounded-md p-4 text-gray-800">
                    <h4 class="font-semibold mb-2 text-green-600">1. Seleccione al Amo</h4>
                    <div class="mb-2">
                        <label for="amo_select" class="block text-gray-700 text-sm font-bold mb-2">Amo:</label>
                        <select name="select_amo" id="amo_select" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-white <?= (isset($validation_asociacion) && $validation_asociacion->hasError('select_amo')) ? 'border-red-500' : 'border-gray-300' ?>">
                            <option value="">-- Seleccione un Amo --</option>
                            <?php if (!empty($amos_para_select) && is_array($amos_para_select)): ?>
                                <?php foreach ($amos_para_select as $amo_item): ?>
                                    <option value="<?= esc($amo_item['id_amo']) ?>" <?= set_select('select_amo', $amo_item['id_amo']) ?>>
                                        <?= esc($amo_item['nombre'] . ' ' . $amo_item['apellido']) ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                        <?php if (isset($validation_asociacion) && $validation_asociacion->hasError('select_amo')): ?>
                            <p class="text-red-500 text-xs italic mt-1"><?= esc($validation_asociacion->getError('select_amo')) ?></p>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="bg-gray-300 rounded-md p-4 text-gray-800">
                    <h4 class="font-semibold mb-2 text-green-600">2. Seleccione la Mascota (disponible para asociación)</h4>
                    <div class="mb-2">
                        <label for="mascota-select-asociar" class="block text-gray-700 text-sm font-bold mb-2">Mascota Disponible:</label>
                        <select name="id_mascota_a_asociar" id="mascota-select-asociar" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-white <?= (isset($validation_asociacion) && $validation_asociacion->hasError('id_mascota_a_asociar')) ? 'border-red-500' : 'border-gray-300' ?>">
                            <option value="">-- Seleccione una Mascota --</option>
                            <?php if (!empty($mascotas_disponibles_para_select) && is_array($mascotas_disponibles_para_select)): ?>
                                <?php foreach ($mascotas_disponibles_para_select as $mascota_item): ?>
                                    <option value="<?= esc($mascota_item['nro_registro']) ?>" <?= set_select('id_mascota_a_asociar', $mascota_item['nro_registro']) ?>>
                                        <?= esc($mascota_item['nombre'] . ' (' . $mascota_item['especie'] . ' - ' . $mascota_item['raza'] . ')') ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <option value="" disabled>No hay mascotas disponibles para asociar.</option>
                            <?php endif; ?>
                        </select>
                        <?php if (isset($validation_asociacion) && $validation_asociacion->hasError('id_mascota_a_asociar')): ?>
                            <p class="text-red-500 text-xs italic mt-1"><?= esc($validation_asociacion->getError('id_mascota_a_asociar')) ?></p>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="flex justify-center">
                    <button type="submit" name="btn_guardar_asociacion" value="true" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Guardar Asociación Amo-Mascota</button>
                </div>
            </form>
        </div>

        <div id="veterinario-tab" class="tab-content <?= ($current_active_tab === 'veterinario') ? 'active' : '' ?>">
            <h3 class="text-lg font-semibold mb-2">Registro de Veterinario</h3>
            <?= display_messages_altas(isset($validation_veterinario) ? $validation_veterinario : null, 'success_veterinario', 'error_veterinario') ?>
            <form id="veterinario-form-save" action="<?= site_url('altas/alta_veterinario') ?>" method="post" class="space-y-4">
                <?= csrf_field() ?>
                <div class="bg-gray-300 rounded-md p-4 text-gray-800">
                    <div class="mb-2">
                        <label for="vet-nombre" class="block text-gray-700 text-sm font-bold mb-2">Nombre y Apellido:</label>
                        <input type="text" id="vet-nombre" name="nombre" value="<?= set_value('nombre') ?>" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline <?= (isset($validation_veterinario) && $validation_veterinario->hasError('nombre')) ? 'border-red-500' : 'border-gray-300' ?>">
                        <?php if (isset($validation_veterinario) && $validation_veterinario->hasError('nombre')): ?>
                            <p class="text-red-500 text-xs italic mt-1"><?= esc($validation_veterinario->getError('nombre')) ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="mb-2">
                        <label for="vet-especialidad" class="block text-gray-700 text-sm font-bold mb-2">Especialidad:</label>
                        <select id="vet-especialidad" name="especialidad" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-white <?= (isset($validation_veterinario) && $validation_veterinario->hasError('especialidad')) ? 'border-red-500' : 'border-gray-300' ?>">
                            <option value="">-- Especialidades --</option>
                            <option value="general" <?= set_select('especialidad', 'general') ?>>Generalista</option>
                            <option value="interno" <?= set_select('especialidad', 'interno') ?>>Interno</option>
                            <option value="cirugia" <?= set_select('especialidad', 'cirugia') ?>>Cirugía</option>
                            <option value="dermatologia" <?= set_select('especialidad', 'dermatologia') ?>>Dermatología</option>
                            <option value="cardiologia" <?= set_select('especialidad', 'cardiologia') ?>>Cardiología</option>
                            <option value="oftalmologia" <?= set_select('especialidad', 'oftalmologia') ?>>Oftalmología</option>
                            <option value="oncologia" <?= set_select('especialidad', 'oncologia') ?>>Oncología</option>
                        </select>
                        <?php if (isset($validation_veterinario) && $validation_veterinario->hasError('especialidad')): ?>
                            <p class="text-red-500 text-xs italic mt-1"><?= esc($validation_veterinario->getError('especialidad')) ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="mb-2">
                        <label for="vet-telefono" class="block text-gray-700 text-sm font-bold mb-2">Teléfono Personal:</label>
                        <input type="tel" id="vet-telefono" name="telefono" value="<?= set_value('telefono') ?>" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline <?= (isset($validation_veterinario) && $validation_veterinario->hasError('telefono')) ? 'border-red-500' : 'border-gray-300' ?>">
                        <?php if (isset($validation_veterinario) && $validation_veterinario->hasError('telefono')): ?>
                            <p class="text-red-500 text-xs italic mt-1"><?= esc($validation_veterinario->getError('telefono')) ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="flex justify-center">
                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Guardar Veterinario</button>
                    </div>
                </div>
            </form>
        </div>

        <div id="mascota-tab" class="tab-content <?= ($current_active_tab === 'mascota') ? 'active' : '' ?>">
            <h3 class="text-lg font-semibold mb-2">Registro de Mascota (Individual)</h3>
            <?= display_messages_altas(isset($validation_mascota) ? $validation_mascota : null, 'success_mascota', 'error_mascota') ?>
            <form id="mascota-form-save" action="<?= site_url('altas/alta_mascota') ?>" method="post" class="space-y-4">
                <?= csrf_field() ?>
                <div class="bg-gray-300 rounded-md p-4 text-gray-800">
                    <div class="mb-2">
                        <label for="masc-nombre" class="block text-gray-700 text-sm font-bold mb-2">Nombre mascota:</label>
                        <input type="text" id="masc-nombre" name="nombre" value="<?= set_value('nombre') ?>" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline <?= (isset($validation_mascota) && $validation_mascota->hasError('nombre')) ? 'border-red-500' : 'border-gray-300' ?>">
                         <?php if (isset($validation_mascota) && $validation_mascota->hasError('nombre')): ?>
                            <p class="text-red-500 text-xs italic mt-1"><?= esc($validation_mascota->getError('nombre')) ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="mb-2">
                        <label for="masc-especie" class="block text-gray-700 text-sm font-bold mb-2">Especie:</label>
                        <select id="masc-especie" name="especie" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-white <?= (isset($validation_mascota) && $validation_mascota->hasError('especie')) ? 'border-red-500' : 'border-gray-300' ?>">
                            <option value="">-- Especies --</option>
                            <option value="perro" <?= set_select('especie', 'perro') ?>>Perro</option>
                            <option value="gato" <?= set_select('especie', 'gato') ?>>Gato</option>
                            <option value="conejo" <?= set_select('especie', 'conejo') ?>>Conejo</option>
                            <option value="caballo" <?= set_select('especie', 'caballo') ?>>Caballo</option>
                            <option value="cerdo" <?= set_select('especie', 'cerdo') ?>>Cerdo</option>
                            <option value="cobayo" <?= set_select('especie', 'cobayo') ?>>Cobayo</option>
                            <option value="pajaros" <?= set_select('especie', 'pajaros') ?>>Pájaros</option>
                        </select>
                        <?php if (isset($validation_mascota) && $validation_mascota->hasError('especie')): ?>
                            <p class="text-red-500 text-xs italic mt-1"><?= esc($validation_mascota->getError('especie')) ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="mb-2">
                        <label for="masc-raza" class="block text-gray-700 text-sm font-bold mb-2">Raza:</label>
                        <input type="text" id="masc-raza" name="raza" value="<?= set_value('raza') ?>" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline <?= (isset($validation_mascota) && $validation_mascota->hasError('raza')) ? 'border-red-500' : 'border-gray-300' ?>">
                        <?php if (isset($validation_mascota) && $validation_mascota->hasError('raza')): ?>
                            <p class="text-red-500 text-xs italic mt-1"><?= esc($validation_mascota->getError('raza')) ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="mb-2">
                        <label for="masc-edad" class="block text-gray-700 text-sm font-bold mb-2">Edad:</label>
                        <input type="text" id="masc-edad" name="edad" value="<?= set_value('edad') ?>" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline <?= (isset($validation_mascota) && $validation_mascota->hasError('edad')) ? 'border-red-500' : 'border-gray-300' ?>">
                        <?php if (isset($validation_mascota) && $validation_mascota->hasError('edad')): ?>
                            <p class="text-red-500 text-xs italic mt-1"><?= esc($validation_mascota->getError('edad')) ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="mb-2">
                        <label for="masc-peso" class="block text-gray-700 text-sm font-bold mb-2">Peso (kg):</label>
                        <input type="text" id="masc-peso" name="peso" value="<?= set_value('peso') ?>" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline <?= (isset($validation_mascota) && $validation_mascota->hasError('peso')) ? 'border-red-500' : 'border-gray-300' ?>">
                        <?php if (isset($validation_mascota) && $validation_mascota->hasError('peso')): ?>
                            <p class="text-red-500 text-xs italic mt-1"><?= esc($validation_mascota->getError('peso')) ?></p>
                        <?php endif; ?>
                    </div>
                     <div class="mb-2">
                        <label for="masc-sexo" class="block text-gray-700 text-sm font-bold mb-2">Sexo:</label>
                        <select id="masc-sexo" name="sexo" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-white <?= (isset($validation_mascota) && $validation_mascota->hasError('sexo')) ? 'border-red-500' : 'border-gray-300' ?>">
                            <option value="">-- Sexo --</option>
                            <option value="macho" <?= set_select('sexo', 'macho') ?>>Macho</option>
                            <option value="hembra" <?= set_select('sexo', 'hembra') ?>>Hembra</option>
                        </select>
                        <?php if (isset($validation_mascota) && $validation_mascota->hasError('sexo')): ?>
                            <p class="text-red-500 text-xs italic mt-1"><?= esc($validation_mascota->getError('sexo')) ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="flex justify-center">
                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Guardar Mascota</button>
                    </div>
                </div>
            </form>
        </div>

        <div id="amo-tab" class="tab-content <?= ($current_active_tab === 'amo') ? 'active' : '' ?>">
            <h3 class="text-lg font-semibold mb-2">Registro de Amo (Individual)</h3>
            <?= display_messages_altas(isset($validation_amo) ? $validation_amo : null, 'success_amo', 'error_amo') ?>
            <form id="amo-form-save" action="<?= site_url('altas/alta_amo') ?>" method="post" class="space-y-4">
                <?= csrf_field() ?>
                <div class="bg-gray-300 rounded-md p-4 text-gray-800">
                    <div class="mb-2">
                        <label for="amo-nombre-individual" class="block text-gray-700 text-sm font-bold mb-2">Nombre del Amo:</label>
                        <input type="text" id="amo-nombre-individual" name="nombre" value="<?= set_value('nombre') ?>" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline <?= (isset($validation_amo) && $validation_amo->hasError('nombre')) ? 'border-red-500' : 'border-gray-300' ?>">
                        <?php if (isset($validation_amo) && $validation_amo->hasError('nombre')): ?>
                            <p class="text-red-500 text-xs italic mt-1"><?= esc($validation_amo->getError('nombre')) ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="mb-2">
                        <label for="amo-apellido-individual" class="block text-gray-700 text-sm font-bold mb-2">Apellido del amo:</label>
                        <input type="text" id="amo-apellido-individual" name="apellido" value="<?= set_value('apellido') ?>" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline <?= (isset($validation_amo) && $validation_amo->hasError('apellido')) ? 'border-red-500' : 'border-gray-300' ?>">
                        <?php if (isset($validation_amo) && $validation_amo->hasError('apellido')): ?>
                            <p class="text-red-500 text-xs italic mt-1"><?= esc($validation_amo->getError('apellido')) ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="mb-2">
                        <label for="amo-telefono-individual" class="block text-gray-700 text-sm font-bold mb-2">Teléfono:</label>
                        <input type="text" id="amo-telefono-individual" name="telefono" value="<?= set_value('telefono') ?>" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline <?= (isset($validation_amo) && $validation_amo->hasError('telefono')) ? 'border-red-500' : 'border-gray-300' ?>">
                        <?php if (isset($validation_amo) && $validation_amo->hasError('telefono')): ?>
                            <p class="text-red-500 text-xs italic mt-1"><?= esc($validation_amo->getError('telefono')) ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="mb-2">
                        <label for="amo-direccion-individual" class="block text-gray-700 text-sm font-bold mb-2">Dirección del Amo:</label>
                        <input type="text" id="amo-direccion-individual" name="direccion" value="<?= set_value('direccion') ?>" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline <?= (isset($validation_amo) && $validation_amo->hasError('direccion')) ? 'border-red-500' : 'border-gray-300' ?>">
                        <?php if (isset($validation_amo) && $validation_amo->hasError('direccion')): ?>
                            <p class="text-red-500 text-xs italic mt-1"><?= esc($validation_amo->getError('direccion')) ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="flex justify-center">
                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Guardar Amo</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
