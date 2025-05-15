<?= $this->extend('layouts/default') ?>

<?= $this->section('nav') ?>
    <?= view_cell('NavCell::mostrar') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div id="modificacion-view" class="view bg-white rounded-md shadow-md p-6 mt-4"> <h2 class="text-xl font-semibold mb-4">Modificación de Registros</h2>

    <div class="border-b border-gray-200 mb-4">
        <div class="flex space-x-2 -mb-px">
            <button class="tab-btn bg-white py-2 px-4 border-b-2 font-semibold border-green-500 text-green-500 active" data-tab="mod-amo">Amo</button>
            <button class="tab-btn bg-white py-2 px-4 border-b-2 font-semibold border-transparent text-gray-500 hover:text-green-500 hover:border-gray-300" data-tab="mod-mascota">Mascota</button>
            <button class="tab-btn bg-white py-2 px-4 border-b-2 font-semibold border-transparent text-gray-500 hover:text-green-500 hover:border-gray-300" data-tab="mod-veterinario">Veterinario</button>
        </div>
    </div>

    <div class="mt-4"> <div id="mod-amo-tab" class="tab-content active"> <h3 class="text-lg font-semibold mb-2">Modificar Datos de Amo</h3>
            <form id="mod-amo-form" class="space-y-4">
                <div class="bg-gray-300 rounded-md p-4 text-gray-800">
                    <div class="mb-2">
                        <label for="mod-amo-select" class="block text-gray-700 text-sm font-bold mb-2">Seleccionar Amo:</label>
                        <select id="mod-amo-select" name="mod_amo_select" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-white" required>
                            <option value="">-- Seleccione un Amo --</option>
                            </select>
                        <?= view_cell('ModalCell::amo', []) ?>
                    </div>
                </div>
            </form>
        </div>

        <div id="mod-mascota-tab" class="tab-content"> <h3 class="text-lg font-semibold mb-2">Modificar Datos de Mascota</h3>
            <form id="mod-mascota-form" class="space-y-4">
                <div class="bg-gray-300 rounded-md p-4 text-gray-800">
                    <div class="mb-2">
                        <label for="mod-mascota-select" class="block text-gray-700 text-sm font-bold mb-2">Seleccionar Mascota:</label>
                        <select id="mod-mascota-select" name="mod_mascota_select" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-white" required>
                            <option value="">-- Seleccione una Mascota --</option>
                            </select>
                        <?= view_cell('ModalCell::mascota', []) ?>
                    </div>
                </div>
            </form>
        </div>

        <div id="mod-veterinario-tab" class="tab-content"> <h3 class="text-lg font-semibold mb-2">Modificar Datos de Veterinario</h3>
            <form id="mod-veterinario-form" class="space-y-4">
                <div class="bg-gray-300 rounded-md p-4 text-gray-800">
                    <div class="mb-2">
                        <label for="mod-vet-select" class="block text-gray-700 text-sm font-bold mb-2">Seleccionar Veterinario:</label>
                        <select id="mod-vet-select" name="mod_vet_select" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-white" required>
                            <option value="">-- Seleccione un Veterinario --</option>
                            </select>
                        <?= view_cell('ModalCell::veterinario', []) ?>
                    </div>
                </div>
            </form>
        </div>
    </div> </div> <?= $this->endSection() ?>
