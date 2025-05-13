<?= $this->extend('layouts/default') ?>

<?= $this->section('nav') ?>
<?= view_cell('NavCell::mostrar') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div id="modificacion-view" class="bg-white rounded-md shadow-md p-6 mt-4">
    <h2 class="text-xl font-semibold mb-4">Modificación de Registros</h2>
    <div class="border-b border-gray-200 mb-4">
        <div class="flex space-x-2 -mb-px">
            <button class="tab-btn bg-white py-2 px-4 border-b-2 border-green-500 text-green-500 font-semibold" data-tab="mod-amo-tab">Amo</button>
            <button class="tab-btn bg-white py-2 px-4 border-b-2 border-transparent text-gray-500 hover:text-green-500" data-tab="mod-mascota-tab">Mascota</button>
            <button class="tab-btn bg-white py-2 px-4 border-b-2 border-transparent text-gray-500 hover:text-green-500" data-tab="mod-veterinario-tab">Veterinario</button>
        </div>
    </div>

    <div id="mod-amo-tab" class="tab-content active mt-4">
        <h3 class="text-lg font-semibold mb-2">Modificar Datos de Amo</h3>
        <form id="mod-amo-form" class="space-y-4">
            <div class="bg-gray-300 rounded-md p-4 text-gray-800">
                <div class="mb-2">
                    <label for="mod-amo-select" class="block text-gray-700 text-sm font-bold mb-2">Seleccionar Amo:</label>
                    <select id="mod-amo-select" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-white" required>
                        <option value="">-- Seleccione un Amo --</option>
                    </select>
                </div>
                <div class="flex justify-center mt-4">
                    <button type="button" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mr-2">Modificar</button>
                </div>
                <div id="mod-amo-fields" class="hidden space-y-4 mt-4">
                    <div class="mb-2">
                        <label for="mod-amo-nombre" class="block text-gray-700 text-sm font-bold mb-2">Nombre y Apellido:</label>
                        <input type="text" id="mod-amo-nombre" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-white" required>
                    </div>
                    <div class="mb-2">
                        <label for="mod-amo-direccion" class="block text-gray-700 text-sm font-bold mb-2">Dirección:</label>
                        <input type="text" id="mod-amo-direccion" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-white" required>
                    </div>
                    <div class="mb-2">
                        <label for="mod-amo-telefono" class="block text-gray-700 text-sm font-bold mb-2">Teléfono:</label>
                        <input type="tel" id="mod-amo-telefono" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-white" required>
                    </div>
                    <div class="flex justify-center mt-4">
                        <button type="submit" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Actualizar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div id="mod-mascota-tab" class="tab-content hidden mt-4">
        <h3 class="text-lg font-semibold mb-2">Modificar Datos de Mascota</h3>
        <form id="mod-mascota-form" class="space-y-4">
            <div class="bg-gray-300 rounded-md p-4 text-gray-800">
                <div class="mb-2">
                    <label for="mod-mascota-select" class="block text-gray-700 text-sm font-bold mb-2">Seleccionar Mascota:</label>
                    <select id="mod-mascota-select" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-white" required>
                        <option value="">-- Seleccione una Mascota --</option>
                    </select>
                </div>
                <div class="flex justify-center mt-4">
                    <button type="button" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mr-2">Modificar</button>
                </div>
                <div id="mod-mascota-fields" class="hidden space-y-4 mt-4">
                    <div class="mb-2">
                        <label for="mod-mascota-nombre" class="block text-gray-700 text-sm font-bold mb-2">Nombre:</label>
                        <input type="text" id="mod-mascota-nombre" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-white" required>
                    </div>
                    <div class="mb-2">
                        <label for="mod-mascota-especie" class="block text-gray-700 text-sm font-bold mb-2">Especie:</label>
                        <input type="text" id="mod-mascota-especie" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-white" required>
                    </div>
                    <div class="mb-2">
                        <label for="mod-mascota-raza" class="block text-gray-700 text-sm font-bold mb-2">Raza:</label>
                        <input type="text" id="mod-mascota-raza" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-white" required>
                    </div>
                    <div class="mb-2">
                        <label for="mod-mascota-registro" class="block text-gray-700 text-sm font-bold mb-2">Nro. Registro:</label>
                        <input type="text" id="mod-mascota-registro" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-white" required>
                    </div>
                    <div class="mb-2">
                        <label for="mod-mascota-edad" class="block text-gray-700 text-sm font-bold mb-2">Edad:</label>
                        <input type="number" id="mod-mascota-edad" min="0" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-white" required>
                    </div>
                    <div class="flex justify-center mt-4">
                        <button type="submit" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Actualizar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div id="mod-veterinario-tab" class="tab-content hidden mt-4">
        <h3 class="text-lg font-semibold mb-2">Modificar Datos de Veterinario</h3>
        <form id="mod-veterinario-form" class="space-y-4">
            <div class="bg-gray-300 rounded-md p-4 text-gray-800">
                <div class="mb-2">
                    <label for="mod-vet-select" class="block text-gray-700 text-sm font-bold mb-2">Seleccionar Veterinario:</label>
                    <select id="mod-vet-select" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-white" required>
                        <option value="">-- Seleccione un Veterinario --</option>
                    </select>
                </div>
                <div class="flex justify-center mt-4">
                    <button type="button" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mr-2">Modificar</button>
                </div>
                <div id="mod-vet-fields" class="hidden space-y-4 mt-4">
                    <div class="mb-2">
                        <label for="mod-vet-nombre" class="block text-gray-700 text-sm font-bold mb-2">Nombre y Apellido:</label>
                        <input type="text" id="mod-vet-nombre" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-white" required>
                    </div>
                    <div class="mb-2">
                        <label for="mod-vet-especialidad" class="block text-gray-700 text-sm font-bold mb-2">Especialidad:</label>
                        <input type="text" id="mod-vet-especialidad" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-white" required>
                    </div>
                    <div class="mb-2">
                        <label for="mod-vet-telefono" class="block text-gray-700 text-sm font-bold mb-2">Teléfono Personal:</label>
                        <input type="tel" id="mod-vet-telefono" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-white" required>
                    </div>
                    <div class="flex justify-center mt-4">
                        <button type="submit" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Actualizar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>