<?= $this->extend('layouts/default') ?>

<?= $this->section('content') ?>
<div id="welcome-screen" class="flex flex-col items-center justify-center h-full bg-white rounded-md shadow-md p-6 mt-4">
    <div class="welcome-content text-center">
        <h2 class="text-6xl font-semibold mb-6 leading-relaxed text-green-500 w-2/3 inline-block">Bienvenido a Mi Veterinaria</h2>
        <p class="text-gray-700 mb-6">Sistema de gestión para mascotas, amos y veterinarios</p>
        <button id="start-btn" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" onclick="window.location.href='<?= base_url('altas') ?>'">Comenzar</button>
    </div>
</div>
<?= $this->endSection() ?>