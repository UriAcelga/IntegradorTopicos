<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Veterinaria - Alta</title>
    <link rel="stylesheet" href="<?= base_url('css/output.css') ?>">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />

</head>

<body style="background-image: url('<?= base_url('images/veterinario.jpg') ?>')" class="bg-cover font-sans antialiased">
    <div class="mx-auto max-w-3xl p-4">
        <header class="bg-green-500 text-white py-4 px-6 rounded-t-md shadow-md flex justify-between items-center">
            <h1 class="text-2xl font-semibold">Mi Veterinaria</h1>
            <div id="datetime" class="text-sm"></div>
        </header>

        <?= $this->renderSection('nav') ?>

        <main class="bg-white rounded-md shadow-md p-6 mt-4">
            <?= $this->renderSection('content') ?>
        </main>

        <footer class="bg-white rounded-b-md shadow-md py-4 px-6 mt-4 flex flex-col items-center text-sm text-gray-500">
            <a href="<?= base_url('/') ?>" class="text-green-500 hover:text-green-700 font-semibold mb-2">Volver a inicio</a>
            <p>&copy; 2025 Mi Veterinaria - Todos los derechos reservados</p>
        </footer>
    </div>

    <script src="<?= base_url('js/viewManager.js') ?>"></script>
    <script src="<?= base_url('js/app.js') ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>

</html>