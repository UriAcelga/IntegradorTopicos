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
             <?php echo form_open('modificacionController/modificarAmo')?>
                <div class="bg-gray-300 rounded-md p-4 text-gray-800">
                    <div class="mb-2">
                        <label for="mod-amo-select" class="block text-gray-700 text-sm font-bold mb-2">Seleccionar Amo:</label>
                        <select id="mod-amo-select" name="mod_amo_select" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-white" required>
                            <option value="">-- Seleccione un Amo --</option>
                              <?php if(!empty($amos)) foreach($amos as $amo_item): // Renombrada variable para evitar conflicto ?>
                                <option value="<?php echo esc($amo_item['id_amo']);?>" <?php if (isset($amoId) && $amoId == $amo_item['id_amo']) echo 'selected';?>>
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
                ?>
                </div>
              <?php 
if(isset($amoM)):
?>
 <?php echo form_open('modificacionController/guardarAmo')?>
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900">Nombre:</label>
                        <input
                            type="text"
                            name="nombre"
                            id="nombre"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                            placeholder="Nombre del Amo"
                            value="<?php echo $amoM['nombre']?>"
                            required>
                    </div>
                    <div class="col-span-2">
                        <label for="apellido" class="block mb-2 text-sm font-medium text-gray-900 ">Apellido:</label>
                        <input
                            type="text"
                            name="apellido"
                            id="apellido"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                            placeholder="Apellido del Amo"
                            value="<?php echo $amoM['apellido']?>"
                            required>
                    </div>
                    <div class="col-span-2">
                        <label for="direccion" class="block mb-2 text-sm font-medium text-gray-900 ">Dirección:</label>
                        <input
                            type="text"
                            name="direccion"
                            id="direccion"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                            placeholder="Domicilio"
                            value="<?php echo $amoM['direccion_amo']?>"
                            required>
                    </div>
                    <div class="col-span-2">
                        <label for="telefono" class="block mb-2 text-sm font-medium text-gray-900 ">Num. Teléfono:</label>
                        <input
                            type="tel"
                            name="telefono"
                            id="telefono"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                            placeholder="111-1111111"
                            value="<?php echo $amoM['telefono']?>"
                            required>
                    </div>
                     <input type="hidden" name="amo" value="<?php echo esc($amoM['id_amo']); ?>">
                </div>
               <?php echo form_submit([
                    'name' => 'enviar_seleccion_amo', // Nombre único para el botón submit
                    'value' => 'Guardar ',
                    'class' => 'bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mt-2'
                ]); 
                echo form_close();
                ?>
 <?php endif; ?>
        </div>

        <div id="mod-mascota-tab" class="tab-content"> <h3 class="text-lg font-semibold mb-2">Modificar Datos de Mascota</h3>
            <?php echo form_open('modificacionController/modificarMascota')?>
                <div class="bg-gray-300 rounded-md p-4 text-gray-800">
                    <div class="mb-2">
                        <label for="mod-mascota-select" class="block text-gray-700 text-sm font-bold mb-2">Seleccionar Mascota:</label>
                        <select id="mod-mascota-select" name="mod_mascota_select" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-white" required>
                            <option value="">-- Seleccione una Mascota --</option>
                              <?php if(!empty($mascotas)) foreach($mascotas as $mascota_item): // Renombrada variable para evitar conflicto ?>
                                <option value="<?php echo esc($mascota_item['nro_registro']);?>" <?php if (isset($mascotaId) && $mascotaId == $mascota_item['nro_registro']) echo 'selected';?>>
                                    <?php echo esc($mascota_item['nro_registro']."- ". $mascota_item['nombre']);?> 
                                     </option>
                                     <?php endforeach; ?>
                            </select>
                             
                    </div>
                </div>
                  <div class="flex justify-center">
                <?php echo form_submit([
                    'name' => 'enviar_seleccion_amo', // Nombre único para el botón submit
                    'value' => 'elegir ',
                    'class' => 'bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mt-2'
                ]); 
                ?>
                </div>
                <?php
                echo form_close();

                if(isset($mascotaM)):
                ?>
         <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200 mb-2">
                <h3 class="text-lg font-semibold text-gray-900 ">
                    Datos de mascota
                </h3>
                
            </div>
         
             <?php echo form_open('modificacionController/guardarMascota')?>
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900">Nombre:</label>
                        <input
                            type="text"
                            name="nombre"
                            id="nombre"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                            placeholder="Nombre de la mascota"
                            value="<?php echo $mascotaM['nombre']?>"
                            required>
                    </div>
                    <div class="col-span-2">
                        <label for="edad" class="block mb-2 text-sm font-medium text-gray-900 ">Edad:</label>
                        <input
                            type="number"
                            name="edad"
                            id="edad"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                            placeholder="5"
                            value="<?php echo $mascotaM['edad']?>"
                            required>
                    </div>
                     <input type="hidden" name="mascota" value="<?php echo esc($mascotaM['nro_registro']); ?>">
                </div>
                <div class="flex justify-center">
                  <?php echo form_submit([
                    'name' => 'enviar_seleccion_amo', // Nombre único para el botón submit
                    'value' => 'elegir ',
                    'class' => 'bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mt-2'
                ]); 
                ?>
                </div>
            </form>
        </div>
 <?php endif; ?>
        </div>

        <div id="mod-veterinario-tab" class="tab-content"> <h3 class="text-lg font-semibold mb-2">Modificar Datos de Veterinario</h3>
           <?php echo form_open('modificacionController/modificarVeterinario')?>
                <div class="bg-gray-300 rounded-md p-4 text-gray-800">
                    <div class="mb-2">
                        <label for="mod-vet-select" class="block text-gray-700 text-sm font-bold mb-2">Seleccionar Veterinario:</label>
                        <select id="mod-vet-select" name="mod_vet_select" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-white" required>
                            <option value="">-- Seleccione un Veterinario --</option>
                             <?php if(!empty($veterinarios)) foreach($veterinarios as $veterinario_item): // Renombrada variable para evitar conflicto ?>
                                <option value="<?php echo esc($veterinario_item['id_veterinario']);?>" <?php if (isset($veterinarioId) && $veterinarioId == $veterinario_item['id_veterinario']) echo 'selected';?>>
                                    <?php echo esc($veterinario_item['id_veterinario']."-". $veterinario_item['nombre']." ". $veterinario_item['apellido']);?> 
                                     </option>
                                     <?php endforeach; ?>
                            </select>
                        
                    </div>
                     <div class="flex justify-center">
                  <?php echo form_submit([
                    'name' => 'enviar_seleccion_amo', // Nombre único para el botón submit
                    'value' => 'elegir ',
                    'class' => 'bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mt-2'
                ]); 
                ?>
                </div>
                </div>
            </form>

            <?php 
            if(isset($veterinarioM)):
            ?>
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200 mb-2">
                <h3 class="text-lg font-semibold text-gray-900 ">
                    Datos de Veterinario
                </h3>
                
            </div>
            <!-- Modal body -->
            <?php echo form_open('modificacionController/guardarVeterinario')?>
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900">Nombre:</label>
                        <input
                            type="text"
                            name="nombre"
                            id="nombre"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                            placeholder="Nombre del Amo"
                            value="<?php echo $veterinarioM['nombre']?>"
                            required>
                    </div>
                    <div class="col-span-2">
                        <label for="apellido" class="block mb-2 text-sm font-medium text-gray-900 ">Apellido:</label>
                        <input
                            type="text"
                            name="apellido"
                            id="apellido"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                            placeholder="Apellido del Amo"
                            value="<?php echo $veterinarioM['apellido']?>"
                            required>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="especialidad" class="block mb-2 text-sm font-medium text-gray-900">Especialidad:</label>
                        <select name= "especialidad"id="especialidad" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                            <option selected>-- Seleccione especialidad --</option>
                            <option value="interno"<?php if ($veterinarioM['especialidad'] ==="interno") echo 'selected';?>>Interno</option>
                            <option value="cirugía"<?php if ($veterinarioM['especialidad'] ==="cirugía") echo 'selected';?>>Cirugía</option>
                            <option value="dermatología"<?php if ($veterinarioM['especialidad'] ==="dermatología") echo 'selected';?>>Dermatología</option>
                            <option value="cardiología"<?php if ($veterinarioM['especialidad'] ==="cardiología") echo 'selected';?>>Cardiología</option>
                            <option value="oftalmología"<?php if ($veterinarioM['especialidad'] ==="oftalmología") echo 'selected';?>>Oftalmología</option>
                            <option value="oncología"<?php if ($veterinarioM['especialidad'] ==="oncología") echo 'selected';?>>Oncología</option>
                        </select>
                    </div>
                    <div class="col-span-2">
                        <label for="telefono" class="block mb-2 text-sm font-medium text-gray-900 ">Num. Teléfono:</label>
                        <input
                            type="tel"
                            name="telefono"
                            id="telefono"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                            placeholder="111-1111111"
                            value="<?php echo $veterinarioM['telefono']?>"
                            required>
                    </div>
                     <input type="hidden" name="veterinario" value="<?php echo esc($veterinarioM['id_veterinario']); ?>">
                </div>
                <div class="flex justify-center">
                    <?php echo form_submit([
                    'name' => 'enviar_seleccion_amo', // Nombre único para el botón submit
                    'value' => 'elegir ',
                    'class' => 'bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mt-2'
                ]); 
                ?>
                </div>
            </form>
        </div>
    </div>
    <?php endif; ?>
        </div>
        <?php
// Mensajes de sesión
if(session()->getFlashdata('success')){ ?>
    <div class="mt-4 p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
      <span class="font-medium">¡Éxito!</span> <?php echo esc(session()->getFlashdata('success')); ?>
    </div>
<?php } ?>
    </div> </div> <?= $this->endSection() ?>
