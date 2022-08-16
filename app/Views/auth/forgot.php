<?= $this->extend('templates/auth-template') ?>

<?= $this->section('content') ?>
<main class="form-signin w-100 m-auto">

<?php if (session()->getFlashdata('error')) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <?= session()->getFlashdata('error') ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php endif; ?>

  <?php $validation = \Config\Services::validation() ?>

  <form method="POST" action="<?= base_url('auth/forgot') ?>">
    <?= csrf_field() ?>
    <h1 class="h3 mb-3 fw-normal">Forgot Password</h1>

    <div class="form-floating mb-2">
      <input type="text" class="form-control <?= ($validation->hasError('email') ? 'is-invalid' : '') ?>" id="floatingInput" placeholder="name@example.com" name="email">
      <label for="floatingInput">Input your email</label>
      <?php if ($validation->getError('email')) : ?>
        <div class="invalid-feedback">
          <?= $validation->getError('email') ?>
        </div>
      <?php endif; ?>
    </div>

    <button class="w-100 btn btn-lg btn-primary" type="submit">Submit</button>
  </form>

  <a href="/" class="w-100 btn btn-lg btn-success mt-2">Back to Login</a>

  <p class="mt-5 mb-3 text-muted">Rohimuhamadd - 2022</p>
</main>

<?= $this->endSection() ?>
