<?= $this->extend('templates/auth-template') ?>

<?= $this->section('content') ?>
<main class="form-signin w-100 m-auto">

  <?php $validation = \Config\Services::validation() ?>

  <?php if (session()->getFlashdata('error')) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <?= session()->getFlashdata('error') ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php endif; ?>

  <form method="POST" action="<?= base_url('auth/question') ?>">
    <?= csrf_field() ?>
    <h1 class="h3 mb-3 fw-normal">Your secret question</h1>

    <input type="hidden" name="email" value="<?= $email ?>">

    <div class="mb-2">
      <ul class="list-group list-group-flush">
        <li class="list-group-item">Where were you when you had your first kiss?</li>
      </ul>
    </div>
    <div class="form-floating mb-2">
      <input type="text" class="form-control <?= ($validation->hasError('answer') ? 'is-invalid' : '') ?>" id="floatingInput" placeholder="Your Answer" name="answer">
      <label for="floatingInput">Your Answer</label>
      <?php if ($validation->getError('answer')) : ?>
        <div class="invalid-feedback">
          <?= $validation->getError('answer') ?>
        </div>
      <?php endif; ?>
    </div>

    <button class="w-100 btn btn-lg btn-primary" type="submit">Submit</button>
  </form>

  <a href="/" class="w-100 btn btn-lg btn-success mt-2">Back to Login</a>

  <p class="mt-5 mb-3 text-muted">Rohimuhamadd - 2022</p>
</main>

<?= $this->endSection() ?>
