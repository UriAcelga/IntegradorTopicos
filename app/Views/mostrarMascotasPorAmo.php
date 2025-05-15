<?= $this->extend('layouts/default') ?>

<?= $this->section('nav') ?>
    <?= view_cell('NavCell::mostrar') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="bg-white rounded-md shadow-md p-6 mt-4">
    <div class="mb-6">
        <a href="<?= site_url('mostrar#mostrar-mascotas-por-amo-tab') // Enlace para regresar a la pestaña correcta ?>" class="text-green-600 hover:text-green-800 inline-flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
            </svg>
            Regresar a Mostrar
        </a>
    </div>

    <?php 
    // Verificar si las variables necesarias están definidas y no son nulas
    // $nombreAmo es pasado por el controlador MostrarController->mascotasPorAmo
    // $mascotasDelAmo también es pasado por el controlador
    if (isset($nombreAmo) && isset($mascotasDelAmo)): 
    ?>
        <div id="amo-mascotas-result">
            <h2 class="text-2xl font-semibold mb-2 text-gray-800">
                Mascotas de: <span class="text-green-600"><?= esc($nombreAmo) ?></span>
            </h2>

            <?php if (!empty($mascotasDelAmo)): ?>
                <div class="overflow-x-auto mt-4">
                    <table id="amo-mascotas-table" class="min-w-full leading-normal shadow-md rounded-lg">
                        <thead>
                            <tr class="bg-green-500 text-white">
                                <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">Nro. Registro</th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">Nombre</th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">Especie</th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">Raza</th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">Edad</th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">Fecha Alta Mascota</th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">Estado Relación</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            <?php foreach ($mascotasDelAmo as $mascota): ?>
                                <tr class="hover:bg-gray-100">
                                    <td class="px-5 py-4 border-b border-gray-200 text-sm"><?= esc($mascota['nro_registro']) ?></td>
                                    <td class="px-5 py-4 border-b border-gray-200 text-sm"><?= esc($mascota['nombre']) ?></td>
                                    <td class="px-5 py-4 border-b border-gray-200 text-sm"><?= esc($mascota['especie']) ?></td>
                                    <td class="px-5 py-4 border-b border-gray-200 text-sm"><?= esc($mascota['raza']) ?></td>
                                    <td class="px-5 py-4 border-b border-gray-200 text-sm"><?= esc($mascota['edad'] ?? 'N/A') ?></td>
                                    <td class="px-5 py-4 border-b border-gray-200 text-sm"><?= esc($mascota['fecha_alta'] ? date('d/m/Y', strtotime($mascota['fecha_alta'])) : 'N/A') ?></td>

                                    <td class="px-5 py-4 border-b border-gray-200 text-sm">
                                        <?php if ($mascota['es_actual'] == 1): ?>
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
                    <span class="font-medium">Información:</span> El amo "<?= esc($nombreAmo) ?>" no tiene mascotas registradas o asociadas actualmente.
                </div>
            <?php endif; ?>
        </div>
    <?php else: ?>
        <div class="mt-4 p-4 text-sm text-red-700 bg-red-100 rounded-lg" role="alert">
            <span class="font-medium">Error:</span> No se pudo cargar la información de las mascotas para el amo seleccionado. Por favor, intente de nuevo desde la página de "Mostrar".
        </div>
    <?php endif; ?>
</div>
<?= $this->endSection() ?>
