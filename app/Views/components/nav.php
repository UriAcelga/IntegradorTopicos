<nav class="bg-green-400 text-white py-2 px-6 shadow-md">
    <ul class="flex space-x-4">
        <li><a href="<?= route_to('altas') ?>" data-view="alta" class="hover:text-green-100">Alta</a></li>
        <li><a href="<?= route_to('bajas') ?>" data-view="baja" class="hover:text-green-100">Baja</a></li>
        <li><a href="<?= route_to('modificacion') ?>" data-view="modificacion" class="hover:text-green-100">Modificación</a></li>
        <li><a href="<?= route_to('mostrar') ?>" data-view="mostrar" class="hover:text-green-100">Mostrar</a></li>
    </ul>
</nav>