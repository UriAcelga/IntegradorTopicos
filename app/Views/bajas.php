<?= $this->extend('layouts/default') ?>

<?= $this->section('nav') ?>
    <?= view_cell('NavCell::mostrar') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div id="baja-view" class="view bg-white rounded-md shadow-md p-6 mt-4">
    <h2 class="text-xl font-semibold mb-4">Baja de Registros</h2>

    <div class="border-b border-gray-200 mb-4">
        <div class="tab-buttons-container flex space-x-2 -mb-px">
            <button class="tab-btn bg-white py-2 px-4 border-b-2 font-semibold border-green-500 text-green-500 active" data-tab="baja-mascota-amo">Relación Mascota-Amo</button>
            <button class="tab-btn bg-white py-2 px-4 border-b-2 font-semibold border-transparent text-gray-500 hover:text-green-500 hover:border-gray-300" data-tab="baja-veterinario">Veterinario</button>
        </div>
    </div>

    <div class="mt-4">
        <div id="baja-mascota-amo-tab" class="tab-content active">
            <h3 class="text-lg font-semibold mb-2">Baja de Relación Mascota-Amo</h3>
            <div class="bg-gray-300 rounded-md p-4 text-gray-800">
                <?php echo form_open('bajasController/eleccion')?>
                    <div class="mb-2">
                        <label for="baja-amo-select" class="block text-gray-700 text-sm font-bold mb-2">Seleccionar Amo:</label>
                        <select name="amo" id="baja-amo-select" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-white" required>
                            <option value="">-- Seleccione un Amo --</option>
                            <?php if(!empty($amos)) foreach($amos as $amo_item): // Renombrada variable para evitar conflicto ?>
                                <option value="<?php echo esc($amo_item['id_amo']);?>" <?php if (!empty($amoId) && $amoId == $amo_item['id_amo']) echo 'selected';?>>
                                    <?php echo esc($amo_item['id_amo']."- ". $amo_item['nombre']." ".$amo_item['apellido']);?>
                                </option>
                            <?php endforeach; ?>  
                        </select>
                    </div>
                <?php echo form_submit([
                    'name' => 'enviar_seleccion_amo', // Nombre único para el botón submit
                    'value' => 'Elegir Amo',
                    'class' => 'bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mt-2'
                ]); 
                echo form_close();

                if(!empty($mascotas) && !empty($amoId)): // Asegurar que amoId también esté presente
                ?>
                    <div class="mt-6 border-t border-gray-400 pt-4"> <?php echo form_open('bajasController/baja')?>
                        <input type="hidden" name="amo" value="<?php echo esc($amoId); ?>">
                        
                        <div class="mb-2">
                            <label for="baja-mascota-select" class="block text-gray-700 text-sm font-bold mb-2">Seleccionar Mascota de este Amo:</label>
                            <select name="mascota" id="baja-mascota-select" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-white" required>
                                <option value="">-- Seleccione una Mascota --</option>
                                <?php foreach($mascotas as $mascota_item):  // Renombrada variable ?>
                                    <option value="<?php echo esc($mascota_item['nro_registro']);?>">
                                        <?php echo esc($mascota_item['nro_registro']."- ". $mascota_item['nombre']);?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-2">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Motivo de Baja:</label>
                            <div class="flex space-x-4">
                                <div class="radio-group flex items-center">
                                    <input type="radio" id="motivo-venta" name="motivo-baja" value="venta" required class="focus:ring-green-500 h-4 w-4 text-green-500 border-gray-300 rounded mr-1">
                                    <label for="motivo-venta" class="text-gray-700">Venta</label>
                                </div>
                                <div class="radio-group flex items-center">
                                    <input type="radio" id="motivo-fallecimiento" name="motivo-baja" value="fallecimiento" class="focus:ring-green-500 h-4 w-4 text-green-500 border-gray-300 rounded mr-1">
                                    <label for="motivo-fallecimiento" class="text-gray-700">Fallecimiento</label>
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-center mt-4">
                            <?php echo form_submit([
                                'name' => 'enviar_baja_relacion', // Nombre único
                                'value' => 'Dar De Baja Relación',
                                'class' => 'bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline'
                            ]); 
                            ?>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                <?php  
                endif; 
                ?>
            </div> 
        </div>


        <div id="baja-veterinario-tab" class="tab-content"> 
            <h3 class="text-lg font-semibold mb-2">Baja de Veterinario</h3>
            <form id="baja-veterinario-form" action="<?= site_url('bajasController/bajaVeterinario') ?>" method="post" class="space-y-4">
                <?= csrf_field() ?>
                <div class="bg-gray-300 rounded-md p-4 text-gray-800">
                    <div class="mb-2">
                        <label for="baja-vet-select" class="block text-gray-700 text-sm font-bold mb-2">Seleccionar Veterinario:</label>
                        <select name="veterinario_id" id="baja-vet-select" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-white" required>
                            <option value="">-- Seleccione un Veterinario --</option>
                            <?php if(!empty($veterinarios)) foreach($veterinarios as $veterinario_item): // Renombrada variable ?>
                                <option value="<?php echo esc($veterinario_item['id_veterinario'], 'attr'); ?>">
                                    <?php echo esc($veterinario_item['id_veterinario']."-".$veterinario_item['especialidad']."-". $veterinario_item['nombre']." ".$veterinario_item['apellido']); ?>
                                </option>  
                            <?php endforeach;?>
                        </select>
                    </div>
                    <div class="flex justify-center mt-4">
                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Dar de Baja Veterinario</button>
                    </div>
                </div>
            </form>
        </div>
        
    </div>
</div>

<?php
// Mensajes de sesión
if(session()->getFlashdata('success')){ ?>
    <div class="mt-4 p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
      <span class="font-medium">¡Éxito!</span> <?php echo esc(session()->getFlashdata('success')); ?>
    </div>
<?php } ?>
<?php
if(session()->getFlashdata('error')){ ?>
    <div class="mt-4 p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
      <span class="font-medium">¡Error!</span> <?php echo esc(session()->getFlashdata('error')); ?>
    </div>
<?php } ?>

<?= $this->endSection() ?>
