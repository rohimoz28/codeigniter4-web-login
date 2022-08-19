<?= $this->extend('templates/auth-template') ?>

<?= $this->section('content') ?>
<main class="form-signin w-100 m-auto">
<?php (isset($error)) ? $error : '' ; ?>
  <?php $validation = \Config\Services::validation() ?>
  <form method="POST" action="<?= base_url('user/new') ?>">
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
    <div class="form-floating mb-2">
      <input type="password" class="form-control <?= ($validation->hasError('password_confirmation') ? 'is-invalid' : '') ?>" id="floatingPassword" placeholder="Retype Password" name="password_confirm">
      <label for="floatingPassword">Retype Password</label>
      <?php if ($validation->getError('password_confirmation')) : ?>
        <div class="invalid-feedback">
          <?= $validation->getError('password_confirmation') ?>
        </div>
      <?php endif; ?>
    </div>
    <div class="form-floating mb-2">
      <select class="form-select <?= ($validation->hasError('question') ? 'is-invalid' : '') ?>" name="question">
        <option selected value="0">-- Secret Question --</option>
        <option value="In what city did you meet your spouse/significant other?">In what city did you meet your spouse/significant other?</option>
        <option value="Where were you when you had your first kiss?">Where were you when you had your first kiss?</option>
        <option value="In what city or town did your mother and father meet?">In what city or town did your mother and father meet?</option>
      </select>
      <?php if ($validation->getError('question')) : ?>
        <div class="invalid-feedback">
          <?= $validation->getError('question') ?>
        </div>
      <?php endif; ?>
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
