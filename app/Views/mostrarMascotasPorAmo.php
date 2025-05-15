<?= $this->extend('layouts/default') ?>

<?= $this->section('nav') ?>
    <?= view_cell('NavCell::mostrar') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="bg-white rounded-md shadow-md p-6 mt-4">
    <a href="<?= base_url('mostrar') ?>">
        <h2 class="text-xl font-semibold mb-4"><span class="text-green-500"><<<</span> Regresar a Mostrar</h2>
    </a>
</div>
<?= $this->endSection() ?>