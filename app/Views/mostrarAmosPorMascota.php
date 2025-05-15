<?= $this->extend('layouts/default') ?>

<?= $this->section('nav') ?>
    <?= view_cell('NavCell::mostrar') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="bg-white rounded-md shadow-md p-6 mt-4">
    <div class="mb-6">
        <a href="<?= site_url('mostrar#mostrar-amos-mascota-tab') ?>" class="text-green-600 hover:text-green-800 inline-flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
            </svg>
            Regresar a Mostrar
        </a>
    </div>

    <?php if (isset($nombreMascota) && isset($amosDeLaMascota)): ?>
        <div id="mascota-amos-result">
            <h2 class="text-2xl font-semibold mb-2 text-gray-800">
                Amos de la Mascota: <span class="text-green-600"><?= esc($nombreMascota) ?></span>
            </h2>

            <?php if (!empty($amosDeLaMascota)): ?>
                <div class="overflow-x-auto mt-4">
                    <table id="mascota-amos-table" class="min-w-full leading-normal shadow-md rounded-lg">
                        <thead>
                            <tr class="bg-green-500 text-white">
                                <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">ID Amo</th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">Nombre y Apellido</th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">Dirección</th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">Teléfono</th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">Estado Relación</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            <?php foreach ($amosDeLaMascota as $amo): ?>
                                <tr class="hover:bg-gray-100">
                                    <td class="px-5 py-4 border-b border-gray-200 text-sm"><?= esc($amo['id_amo']) ?></td>
                                    <td class="px-5 py-4 border-b border-gray-200 text-sm"><?= esc($amo['nombre'] . ' ' . $amo['apellido']) ?></td>
                                    <td class="px-5 py-4 border-b border-gray-200 text-sm"><?= esc($amo['direccion_amo'] ?? $amo['direccion'] ?? 'N/A') // Ajusta según el nombre de columna en tu tabla amos ?></td>
                                    <td class="px-5 py-4 border-b border-gray-200 text-sm"><?= esc($amo['telefono'] ?? 'N/A') ?></td>
                               
                                    <td class="px-5 py-4 border-b border-gray-200 text-sm">
                                        <?php if ($amo['es_actual'] == 1): ?>
                                            <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full">Activa</span>
                                        <?php else: ?>
                                            <span class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full">Inactiva</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="mt-4 p-4 text-sm text-yellow-700 bg-yellow-100 rounded-lg" role="alert">
                    <span class="font-medium">Información:</span> La mascota "<?= esc($nombreMascota) ?>" no tiene amos registrados o asociados actualmente.
                </div>
            <?php endif; ?>
        </div>
    <?php else: ?>
        <div class="mt-4 p-4 text-sm text-red-700 bg-red-100 rounded-lg" role="alert">
            <span class="font-medium">Error:</span> No se pudo cargar la información de los amos para la mascota. Por favor, intente de nuevo desde la página de "Mostrar".
        </div>
    <?php endif; ?>
</div>
<?= $this->endSection() ?>
