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

  <form method="POST" action="<?= base_url('auth/reset') ?>">
    <?= csrf_field() ?>
    <h1 class="h3 mb-3 fw-normal">Reset Password</h1>

    <input type="hidden" name="email" value="<?= $email ?>" >
    <div class="form-floating mb-2">
      <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
      <label for="floatingPassword">Password</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control <?= ($validation->hasError('password_confirmation') ? 'is-invalid' : '') ?>" id="floatingPassword" placeholder="Retype Password" name="password_confirmation">
      <label for="floatingPassword">Retype Password</label>
      <?php if ($validation->getError('password_confirmation')) : ?>
        <div class="invalid-feedback">
          <?= $validation->getError('password_confirmation') ?>
        </div>
      <?php endif; ?>
    </div>

    <button class="w-100 btn btn-lg btn-primary" type="submit">Submit</button>
  </form>

  <p class="mt-5 mb-3 text-muted">Rohimuhamadd - 2022</p>
</main>

<?= $this->endSection() ?>
