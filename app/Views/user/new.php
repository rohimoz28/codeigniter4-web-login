<?= $this->extend('templates/auth-template') ?>

<?= $this->section('content') ?>
<main class="form-signin w-100 m-auto">
  <?php $validation = \Config\Services::validation() ?>
  <form method="POST" action="/user/create">
    <?= csrf_field() ?>
    <h1 class="h3 mb-3 fw-normal">Please Register</h1>

    <div class="form-floating mb-2">
      <input type="text" class="form-control <?= ($validation->hasError('name') ? 'is-invalid' : '') ?>" id="floatingInput" placeholder="E.g John Doe" name="name">
      <label for="floatingInput">Fullname</label>
      <?php if ($validation->getError('name')) : ?>
        <div class="invalid-feedback">
          <?= $validation->getError('name') ?>
        </div>
      <?php endif; ?>
    </div>
    <div class="form-floating mb-2">
      <input type="text" class="form-control <?= ($validation->hasError('email') ? 'is-invalid' : '') ?>" id="floatingInput" placeholder="name@example.com" name="email">
      <label for="floatingInput">Email address</label>
      <?php if ($validation->getError('email')) : ?>
        <div class="invalid-feedback">
          <?= $validation->getError('email') ?>
        </div>
      <?php endif; ?>
    </div>
    <div class="form-floating mb-2">
      <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
      <label for="floatingPassword">Password</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control <?= ($validation->hasError('password_confirmation') ? 'is-invalid' : '') ?>" id="floatingPassword" placeholder="Retype Password" name="password_confirm">
      <label for="floatingPassword">Retype Password</label>
      <?php if ($validation->getError('password_confirmation')) : ?>
        <div class="invalid-feedback">
          <?= $validation->getError('password_confirmation') ?>
        </div>
      <?php endif; ?>
    </div>

    <button class="w-100 btn btn-lg btn-primary" type="submit">Submit</button>
  </form>

  <a href="/" class="w-100 btn btn-lg btn-success mt-2">Back to Login</a>

  <p class="mt-5 mb-3 text-muted">Rohimuhamadd - 2022</p>
</main>

<?= $this->endSection() ?>
