<?= $this->extend('layouts/default') ?>
<?= $this->section('nav') ?>
<?= $this->include('components/nav') ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div id="alta-view" class="view">
    <h2 class="text-xl font-semibold mb-4">Alta de Registros</h2>
    <div class="border-b border-gray-200">
        <div class="flex space-x-2 -mb-px">
            <button class="tab-btn bg-white py-2 px-4 border-b-2 border-green-500 text-green-500 font-semibold" data-tab="mascota-amo">Mascota-Amo</button>
            <button class="tab-btn bg-white py-2 px-4 border-b-2 border-transparent text-gray-500 hover:text-green-500" data-tab="veterinario">Veterinario</button>
            <button class="tab-btn bg-white py-2 px-4 border-b-2 border-transparent text-gray-500 hover:text-green-500" data-tab="mascota">Mascota</button>
            <button class="tab-btn bg-white py-2 px-4 border-b-2 border-transparent text-gray-500 hover:text-green-500" data-tab="amo">Amo</button>
        </div>
    </div>

    <div id="mascota-amo-tab" class="tab-content active mt-4">
        <h3 class="text-lg font-semibold mb-2">Registro de Mascota y Amo</h3>
        <form id="mascota-amo-form" class="space-y-4">
            <div class="bg-gray-300 rounded-md p-4 text-gray-800">
                <h4 class="font-semibold mb-2 text-green-600">Datos del Amo</h4>
                <div class="mb-2">
                    <label for="amo-select" class="block text-gray-700 text-sm font-bold mb-2">Seleccionar Amo Existente:</label>
                    <select id="amo-select" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-white">
                        <option value="">-- Nuevo Amo --</option>
                    </select>
                </div>
            </div>

            <div class="bg-gray-300 rounded-md p-4 text-gray-800">
                <h4 class="font-semibold mb-2 text-green-600">Datos de la Mascota</h4>
                <div class="mb-2">
                    <label for="mascota-select" class="block text-gray-700 text-sm font-bold mb-2">Seleccionar Mascota Existente:</label>
                    <select id="mascota-select" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-white">
                        <option value="">-- Nueva Mascota --</option>
                    </select>
                </div>
            </div>

            <div class="flex justify-center">
                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Guardar</button>
            </div>
        </form>
    </div>

    <div id="veterinario-tab" class="tab-content hidden mt-4">
        <h3 class="text-lg font-semibold mb-2">Registro de Veterinario</h3>
        <form id="veterinario-form" class="space-y-4">
            <div class="bg-gray-300 rounded-md p-4 text-gray-800">
                <div class="mb-2">
                    <label for="vet-nombre" class="block text-gray-700 text-sm font-bold mb-2">Nombre y Apellido:</label>
                    <input type="text" id="vet-nombre" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-2">
                    <label for="vet-especialidad" class="block text-gray-700 text-sm font-bold mb-2">Especialidad:</label>
                    <select id="vet-especialidad" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-white">
                        <option value="">-- Especialidades --</option>
                    </select>
                </div>
                <div class="mb-2">
                    <label for="vet-telefono" class="block text-gray-700 text-sm font-bold mb-2">Teléfono Personal:</label>
                    <input type="tel" id="vet-telefono" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="flex justify-center">
                    <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Guardar</button>
                </div>
            </div>
        </form>
    </div>

    <div id="mascota-tab" class="tab-content hidden mt-4">
        <h3 class="text-lg font-semibold mb-2">Registro de Mascota</h3>
        <form id="mascota-form" class="space-y-4">
            <div class="bg-gray-300 rounded-md p-4 text-gray-800">
                <div class="mb-2">
                    <label for="masc-nombre" class="block text-gray-700 text-sm font-bold mb-2">Nombre mascota:</label>
                    <input type="text" id="masc-nombre" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-2">
                    <label for="masc-especie" class="block text-gray-700 text-sm font-bold mb-2">Especie:</label>
                    <select id="masc-especie" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-white">
                        <option value="">-- Especies --</option>
                    </select>
                </div>
                <div class="mb-2">
                    <label for="masc-raza" class="block text-gray-700 text-sm font-bold mb-2">Raza:</label>
                    <select id="masc-raza" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-white">
                        <option value="">-- Razas --</option>
                    </select>
                </div>
                <div class="mb-2">
                    <label for="masc-edad" class="block text-gray-700 text-sm font-bold mb-2">Edad:</label>
                    <input type="text" id="masc-edad" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="flex justify-center">
                    <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Guardar</button>
                </div>
            </div>
        </form>
    </div>

    <div id="amo-tab" class="tab-content hidden mt-4">
        <h3 class="text-lg font-semibold mb-2">Registro de Amo</h3>
        <form id="amo-form" class="space-y-4">
            <div class="bg-gray-300 rounded-md p-4 text-gray-800">
                <div class="mb-2">
                    <label for="amo-nombre" class="block text-gray-700 text-sm font-bold mb-2">Nombre del Amo:</label>
                    <input type="text" id="amo-nombre" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-2">
                    <label for="amo-apellido" class="block text-gray-700 text-sm font-bold mb-2">Apellido del amo:</label>
                    <input type="text" id="amo-apellido" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-2">
                    <label for="amo-telefono" class="block text-gray-700 text-sm font-bold mb-2">Telefono:</label>
                    <input type="text" id="amo-telefono" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="flex justify-center">
                    <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Guardar</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>