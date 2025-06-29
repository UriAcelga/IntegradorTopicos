<div class="col-span-2 sm:col-span-1">
    <label for="<?= esc($dato) ?>" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"><?= esc($label) ?></label>
    <select id="<?= esc($dato) ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
        <option selected>Elige <?= esc($dato) ?></option>
        <?php foreach (esc($opciones) as $opcion): ?>
            <option value="<?= esc($opcion['valor']) ?>"><?= esc($opcion['nombre']) ?></option>
        <?php endforeach; ?>
    </select>
</div>