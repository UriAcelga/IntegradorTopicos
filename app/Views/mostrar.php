<?= $this->extend('layouts/default') ?>

<?= $this->section('nav') ?>
    <?= view_cell('NavCell::mostrar') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div id="mostrar-view" class="view bg-white rounded-md shadow-md p-6 mt-4"> <h2 class="text-xl font-semibold mb-4">Mostrar Información</h2>

  <div class="border-b border-gray-200 mb-4">
    <div class="tab-buttons-container flex space-x-2 -mb-px">
        <button class="tab-btn bg-white py-2 px-3 border-b-2 font-semibold border-green-500 text-green-500 active" data-tab="mascotas-lista">Mascotas</button>
        <button class="tab-btn bg-white py-2 px-3 border-b-2 font-semibold border-transparent text-gray-500 hover:text-green-500 hover:border-gray-300" data-tab="amos-lista">Amos</button>
        <button class="tab-btn bg-white py-2 px-3 border-b-2 font-semibold border-transparent text-gray-500 hover:text-green-500 hover:border-gray-300" data-tab="veterinarios-lista">Veterinarios</button>
        <button class="tab-btn bg-white py-2 px-3 border-b-2 font-semibold border-transparent text-gray-500 hover:text-green-500 hover:border-gray-300" data-tab="mascotas-por-amo">Mascotas por Amo</button>
        <button class="tab-btn bg-white py-2 px-3 border-b-2 font-semibold border-transparent text-gray-500 hover:text-green-500 hover:border-gray-300" data-tab="amos-por-mascota">Amos por Mascota</button>
    </div>
</div>

    <div class="mt-4"> 
        <div id="mascotas-lista-tab" class="tab-content active"> 
            <h3 class="text-lg font-semibold mb-2">Lista de Mascotas</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full leading-normal shadow-md rounded-lg">
                    <thead>
                        <tr class="bg-green-500 text-white">
                            <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">Nombre</th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">Especie</th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">Raza</th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">Nro. Registro</th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">Edad</th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">Fecha de Alta</th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">Fecha de Defunción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($mascotas)): foreach($mascotas as $mascota): ?>
                            <tr class="bg-gray-100 hover:bg-gray-200">
                                <td class="px-5 py-5 border-b border-gray-200 text-sm"><?= esc($mascota['nombre']) ?></td>
                                <td class="px-5 py-5 border-b border-gray-200 text-sm"><?= esc($mascota['especie']) ?></td>
                                <td class="px-5 py-5 border-b border-gray-200 text-sm"><?= esc($mascota['raza']) ?></td>
                                <td class="px-5 py-5 border-b border-gray-200 text-sm"><?= esc($mascota['nro_registro']) ?></td>
                                <td class="px-5 py-5 border-b border-gray-200 text-sm"><?= esc($mascota['edad']) ?></td>
                                <td class="px-5 py-5 border-b border-gray-200 text-sm"><?= esc($mascota['fecha_alta']) ?></td>
                                <td class="px-5 py-5 border-b border-gray-200 text-sm"><?= (!empty(esc($mascota['fecha_defuncion']))) ? esc($mascota['fecha_defuncion']) : '-' ?></td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr class="bg-gray-100 hover:bg-gray-200">
                                <td class="px-5 py-5 border-b border-gray-200 text-sm">No se encontraron registros</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div id="amos-lista-tab" class="tab-content"> 
            <h3 class="text-lg font-semibold mb-2">Lista de Amos</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full leading-normal shadow-md rounded-lg">
                    <thead>
                        <tr class="bg-green-500 text-white">
                            <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">Nombre y Apellido</th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">Dirección</th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">Teléfono</th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">Fecha de Alta</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($amos)): foreach($amos as $amo): ?>
                            <tr class="bg-gray-100 hover:bg-gray-200">
                                <td class="px-5 py-5 border-b border-gray-200 text-sm"><?= esc($amo['nombre']) . ' ' . esc($amo['apellido'])  ?></td>
                                <td class="px-5 py-5 border-b border-gray-200 text-sm"><?= esc($amo['direccion_amo']) ?></td>
                                <td class="px-5 py-5 border-b border-gray-200 text-sm"><?= esc($amo['telefono']) ?></td>
                                <td class="px-5 py-5 border-b border-gray-200 text-sm"><?= esc($amo['fecha_alta']) ?></td>
                            </tr>   
                        <?php endforeach; ?>
                        <?php else: ?>
                            <tr class="bg-gray-100 hover:bg-gray-200">
                                <td class="px-5 py-5 border-b border-gray-200 text-sm">No se encontraron registros</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div id="veterinarios-lista-tab" class="tab-content"> 
            <h3 class="text-lg font-semibold mb-2">Lista de Veterinarios</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full leading-normal shadow-md rounded-lg">
                    <thead>
                        <tr class="bg-green-500 text-white">
                            <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">Nombre y Apellido</th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">Especialidad</th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">Teléfono Personal</th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">Fecha de Ingreso</th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">Fecha de Egreso</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($veterinarios)): foreach($veterinarios as $vet): ?>
                            <tr class="bg-gray-100 hover:bg-gray-200">
                                <td class="px-5 py-5 border-b border-gray-200 text-sm"><?= esc($vet['nombre']) . ' ' . esc($vet['apellido'])  ?></td>
                                <td class="px-5 py-5 border-b border-gray-200 text-sm"><?= ucfirst(esc($vet['especialidad'])) ?></td>
                                <td class="px-5 py-5 border-b border-gray-200 text-sm"><?= esc($vet['telefono']) ?></td>
                                <td class="px-5 py-5 border-b border-gray-200 text-sm"><?= esc($vet['fecha_ingreso']) ?></td>
                                <td class="px-5 py-5 border-b border-gray-200 text-sm"><?= (!empty(esc($vet['fecha_egreso']))) ? esc($vet['fecha_egreso']) : '-' ?></td>
                            </tr>
                        <?php endforeach; ?>
                        <?php else: ?>
                            <tr class="bg-gray-100 hover:bg-gray-200">
                                <td class="px-5 py-5 border-b border-gray-200 text-sm">No se encontraron registros</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div id="mascotas-por-amo-tab" class="tab-content"> 
            <h3 class="text-lg font-semibold mb-2">Mascotas por Amo</h3>
            <form id="form-mascotas-por-amo" class="space-y-4 mb-4"> 
                <div class="mb-4">
                    <label for="amo-mascotas-select" class="block text-gray-700 text-sm font-bold mb-2">Seleccionar Amo:</label>
                    <select id="amo-mascotas-select" name="amo_mascotas_select" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-white" required>
                        <option value="">-- Seleccione un Amo --</option>
                    </select>
                </div>
                <div class="flex justify-center">
                    <button type="button" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Mostrar Mascotas</button>
                </div>
            </form>
            <div id="amo-mascotas-result" class="hidden"> 
                <h4 class="text-lg font-semibold mb-2">Mascotas de <span id="amo-nombre-display"></span></h4>
                <div class="overflow-x-auto">
                    <table id="amo-mascotas-table" class="min-w-full leading-normal shadow-md rounded-lg">
                        <thead>
                            <tr class="bg-green-500 text-white">
                                <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">Nombre</th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">Especie</th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">Raza</th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">Nro. Registro</th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">Fecha Inicio</th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">Fecha Fin</th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div id="amos-por-mascota-tab" class="tab-content"> 
            <h3 class="text-lg font-semibold mb-2">Amos por Mascota</h3>
            <form id="form-amos-por-mascota" class="space-y-4 mb-4"> 
                <div class="mb-4">
                    <label for="mascota-amos-select" class="block text-gray-700 text-sm font-bold mb-2">Seleccionar Mascota:</label>
                    <select id="mascota-amos-select" name="mascota_amos_select" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-white" required>
                        <option value="">-- Seleccione una Mascota --</option>
                    </select>
                </div>
                <div class="flex justify-center">
                    <button type="button" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Mostrar Amos</button>
                </div>
            </form>
            <div id="mascota-amos-result" class="hidden"> 
                <h4 class="text-lg font-semibold mb-2">Amos de <span id="mascota-nombre-display"></span></h4>
                <div class="overflow-x-auto">
                    <table id="mascota-amos-table" class="min-w-full leading-normal shadow-md rounded-lg">
                        <thead>
                            <tr class="bg-green-500 text-white">
                                <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">Nombre y Apellido</th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">Dirección</th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">Teléfono</th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">Fecha Inicio</th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">Fecha Fin</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> 
</div>
<?= $this->endSection() ?>
