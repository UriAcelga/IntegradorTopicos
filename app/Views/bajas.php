<?= $this->extend('layouts/default') ?>

<?= $this->section('nav') ?>
<?= view_cell('NavCell::mostrar') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div id="baja-view" class="view bg-white rounded-md shadow-md p-6 mt-4">
    <h2 class="text-xl font-semibold mb-4">Baja de Registros</h2>
    <div class="border-b border-gray-200 mb-4">
        <div class="flex space-x-2 -mb-px">
            <button class="tab-btn bg-white py-2 px-4 border-b-2 border-green-500 text-green-500 font-semibold" data-tab="baja-mascota-amo">Relación Mascota-Amo</button>
            <button class="tab-btn bg-white py-2 px-4 border-b-2 border-transparent text-gray-500 hover:text-green-500" data-tab="baja-veterinario">Veterinario</button>
        </div>
    </div>

    <div id="baja-mascota-amo-tab" class="tab-content active mt-4">
        <h3 class="text-lg font-semibold mb-2">Baja de Relación Mascota-Amo</h3>
        <form id="baja-mascota-amo-form" class="space-y-4">
            <div class="bg-gray-300 rounded-md p-4 text-gray-800">
                <div class="mb-2">
                    <label for="baja-amo-select" class="block text-gray-700 text-sm font-bold mb-2">Seleccionar Amo:</label>
                    <select id="baja-amo-select" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-white" required>
                        <option value="">-- Seleccione un Amo --</option>
                    </select>
                </div>
                <div class="mb-2">
                    <label for="baja-mascota-select" class="block text-gray-700 text-sm font-bold mb-2">Seleccionar Mascota:</label>
                    <select id="baja-mascota-select" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-white" id="baja-mascota-select" required disabled>
                        <option value="">-- Seleccione una Mascota --</option>
                    </select>
                </div>
                <div class="mb-2">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Motivo de Baja:</label>
                    <div class="flex space-x-4">
                        <div class="radio-group">
                            <label for="motivo-venta" class="text-gray-700 mr-2">Venta</label>
                            <input type="radio" id="motivo-venta" name="motivo-baja" value="venta" required
                                   class="focus:ring-green-500 h-4 w-4 text-green-500 border-gray-300 rounded">
                        </div>
                        <div class="radio-group">
                            <label for="motivo-fallecimiento" class="text-gray-700 mr-2">Fallecimiento</label>
                            <input type="radio" id="motivo-fallecimiento" name="motivo-baja" value="fallecimiento"
                                   class="focus:ring-green-500 h-4 w-4 text-green-500 border-gray-300 rounded">
                        </div>
                    </div>
                </div>
                <div class="flex justify-center mt-4">
                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Dar de Baja</button>
                </div>
            </div>
        </form>
    </div>

    <div id="baja-veterinario-tab" class="tab-content hidden mt-4">
        <h3 class="text-lg font-semibold mb-2">Baja de Veterinario</h3>
        <form id="baja-veterinario-form" class="space-y-4">
            <div class="bg-gray-300 rounded-md p-4 text-gray-800">
                <div class="mb-2">
                    <label for="baja-vet-select" class="block text-gray-700 text-sm font-bold mb-2">Seleccionar Veterinario:</label>
                    <select id="baja-vet-select" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-white" required>
                        <option value="">-- Seleccione un Veterinario --</option>
                    </select>
                </div>
                <div class="flex justify-center mt-4">
                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Dar de Baja</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>