<?= $this->extend('layouts/default') ?>

<?= $this->section('nav') ?>
<?= view_cell('NavCell::mostrar') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div id="mostrar-view" class="bg-white rounded-md shadow-md p-6 mt-4">
    <h2 class="text-xl font-semibold mb-4">Mostrar Información</h2>
    <div class="border-b border-gray-200 mb-4">
        <div class="flex space-x-2 -mb-px">
            <button class="tab-btn bg-white py-2 px-4 border-b-2 border-green-500 text-green-500 font-semibold" data-tab="mostrar-mascotas">Mascotas</button>
            <button class="tab-btn bg-white py-2 px-4 border-b-2 border-transparent text-gray-500 hover:text-green-500" data-tab="mostrar-amos">Amos</button>
            <button class="tab-btn bg-white py-2 px-4 border-b-2 border-transparent text-gray-500 hover:text-green-500" data-tab="mostrar-veterinarios">Veterinarios</button>
            <button class="tab-btn bg-white py-2 px-4 border-b-2 border-transparent text-gray-500 hover:text-green-500" data-tab="mostrar-mascotas-amo">Mascotas por Amo</button>
            <button class="tab-btn bg-white py-2 px-4 border-b-2 border-transparent text-gray-500 hover:text-green-500" data-tab="mostrar-amos-mascota">Amos por Mascota</button>
        </div>
    </div>

    <div id="mostrar-mascotas" class="tab-content active mt-4">
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
                    <tr class="bg-gray-100">
                        <td class="px-5 py-5 border-b border-gray-200 text-sm"></td>
                        <td class="px-5 py-5 border-b border-gray-200 text-sm"></td>
                        <td class="px-5 py-5 border-b border-gray-200 text-sm"></td>
                        <td class="px-5 py-5 border-b border-gray-200 text-sm"></td>
                        <td class="px-5 py-5 border-b border-gray-200 text-sm"></td>
                        <td class="px-5 py-5 border-b border-gray-200 text-sm"></td>
                        <td class="px-5 py-5 border-b border-gray-200 text-sm"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div id="mostrar-amos" class="tab-content hidden mt-4">
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
                    <tr class="bg-gray-100">
                        <td class="px-5 py-5 border-b border-gray-200 text-sm"></td>
                        <td class="px-5 py-5 border-b border-gray-200 text-sm"></td>
                        <td class="px-5 py-5 border-b border-gray-200 text-sm"></td>
                        <td class="px-5 py-5 border-b border-gray-200 text-sm"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div id="mostrar-veterinarios" class="tab-content hidden mt-4">
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
                    <tr class="bg-gray-100">
                        <td class="px-5 py-5 border-b border-gray-200 text-sm"></td>
                        <td class="px-5 py-5 border-b border-gray-200 text-sm"></td>
                        <td class="px-5 py-5 border-b border-gray-200 text-sm"></td>
                        <td class="px-5 py-5 border-b border-gray-200 text-sm"></td>
                        <td class="px-5 py-5 border-b border-gray-200 text-sm"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div id="mostrar-mascotas-amo" class="tab-content hidden mt-4">
        <h3 class="text-lg font-semibold mb-2">Mascotas por Amo</h3>
        <form class="space-y-4">
            <div class="mb-4">
                <label for="amo-mascotas-select" class="block text-gray-700 text-sm font-bold mb-2">Seleccionar Amo:</label>
                <select id="amo-mascotas-select" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-white" required>
                    <option value="">-- Seleccione un Amo --</option>
                </select>
            </div>
            <div class="flex justify-center">
                <button type="button" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Mostrar</button>
            </div>
        </form>
        <div id="amo-mascotas-result" class="hidden mt-4">
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
                        <tr class="bg-gray-100">
                            <td class="px-5 py-5 border-b border-gray-200 text-sm"></td>
                            <td class="px-5 py-5 border-b border-gray-200 text-sm"></td>
                            <td class="px-5 py-5 border-b border-gray-200 text-sm"></td>
                            <td class="px-5 py-5 border-b border-gray-200 text-sm"></td>
                            <td class="px-5 py-5 border-b border-gray-200 text-sm"></td>
                            <td class="px-5 py-5 border-b border-gray-200 text-sm"></td>
                            <td class="px-5 py-5 border-b border-gray-200 text-sm"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="mostrar-amos-mascota" class="tab-content hidden mt-4">
        <h3 class="text-lg font-semibold mb-2">Amos por Mascota</h3>
        <form class="space-y-4">
            <div class="mb-4">
                <label for="mascota-amos-select" class="block text-gray-700 text-sm font-bold mb-2">Seleccionar Mascota:</label>
                <select id="mascota-amos-select" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-white" required>
                    <option value="">-- Seleccione una Mascota --</option>
                </select>
            </div>
            <div class="flex justify-center">
                <button type="button" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Mostrar</button>
            </div>
        </form>
        <div id="mascota-amos-result" class="hidden mt-4">
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
                        <tr class="bg-gray-100">
                            <td class="px-5 py-5 border-b border-gray-200 text-sm"></td>
                            <td class="px-5 py-5 border-b border-gray-200 text-sm"></td>
                            <td class="px-5 py-5 border-b border-gray-200 text-sm"></td>
                            <td class="px-5 py-5 border-b border-gray-200 text-sm"></td>
                            <td class="px-5 py-5 border-b border-gray-200 text-sm"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>