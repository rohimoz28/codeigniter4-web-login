<?= $this->extend('templates/user-template'); ?>

<?= $this->section('content') ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Dashboard</h1>
  </div>

<h2>Welcome back, <?= session('name') ?></h2>
</main>
<?= $this->endSection() ?>
