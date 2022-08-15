<?= $this->extend('templates/auth-template') ?>

<?= $this->section('content') ?>
<main class="form-signin w-100 m-auto">

  <?php if (session()->getFlashdata('error')) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <?= session()->getFlashdata('error') ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php endif; ?>

  <form method="POST" action="/auth/login">
    <h1 class="h3 mb-3 fw-normal">Please Register</h1>

    <div class="form-floating mb-2">
      <input type="text" class="form-control" id="floatingInput" placeholder="E.g John Doe" name="name">
      <label for="floatingInput">Fullname</label>
    </div>
    <div class="form-floating mb-2">
      <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email">
      <label for="floatingInput">Email address</label>
    </div>
    <div class="form-floating mb-2">
      <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
      <label for="floatingPassword">Password</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" id="floatingPassword" placeholder="Retype Password" name="password_confirm">
      <label for="floatingPassword">Retype Password</label>
    </div>

    <button class="w-100 btn btn-lg btn-primary" type="submit">Submit</button>
  </form>

  <a href="/" class="w-100 btn btn-lg btn-success mt-2">Back to Login</a>

      <p class="mt-5 mb-3 text-muted">Rohimuhamadd - 2022</p>
</main>

<?= $this->endSection() ?>

