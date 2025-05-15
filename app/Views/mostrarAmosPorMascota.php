<?= $this->extend('layouts/default') ?>

<?= $this->section('nav') ?>
<?= view_cell('NavCell::mostrar') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="bg-white rounded-md shadow-md p-6 mt-4">
    <a href="<?= base_url('mostrar') ?>">
        <h2 class="text-xl font-semibold mb-4"><span class="text-green-500">
                <<< </span> Regresar a Mostrar</h2>
    </a>
    <div id="mascota-amos-result">
        <h4 class="text-lg font-semibold mb-2">Amos de <?= esc('nombreMascota') ?></h4>
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
<?= $this->endSection() ?>