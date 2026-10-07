<?= $this->extend($config->viewLayout) ?>

<?= $this->section('title') ?>
Pemulihan Kata Sandi &mdash; SIA AKN-IPB
<?= $this->endSection() ?>

<?= $this->section('main') ?>

<div class="auth-header mb-4">
  <span class="badge badge-light border font-mono mb-2 px-2 py-1" style="font-size: 0.72rem;">
    <i class="fas fa-key mr-1 text-primary"></i> PEMULIHAN SANDI
  </span>
  <h3 class="font-weight-bold text-white mb-1" style="letter-spacing: -0.03em; font-size: 1.45rem;">Lupa Kata Sandi?</h3>
  <p class="text-secondary small mb-0"><?= lang('Auth.enterEmailForInstructions') ?></p>
</div>

<?= view('Myth\Auth\Views\_message_block') ?>

<form method="POST" action="<?= url_to('forgot') ?>" class="needs-validation" novalidate="">
  <?= csrf_field() ?>

  <div class="form-group mb-4">
    <label for="email" class="font-weight-600 text-secondary small text-uppercase" style="letter-spacing: 0.5px;"><?= lang('Auth.emailAddress') ?></label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text" style="background: #06162E; border-color: var(--border-subtle); color: var(--blue-light);">
          <i class="fas fa-envelope"></i>
        </span>
      </div>
      <input id="email" type="email" class="form-control <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" name="email" placeholder="<?= lang('Auth.email') ?>" required autofocus style="border-left: none;">
    </div>
    <div class="invalid-feedback">
      <?= session('errors.email') ?>
    </div>
  </div>

  <div class="form-group mb-3">
    <button type="submit" class="btn btn-primary btn-lg btn-block font-weight-bold">
      <?= lang('Auth.sendInstructions') ?> &rarr;
    </button>
  </div>
</form>

<div class="text-center mt-3 pt-3 border-top" style="border-color: var(--border-subtle) !important;">
  <a href="<?= url_to('login') ?>" class="font-weight-bold small" style="color: var(--blue-light);">
    &larr; Kembali ke Halaman Masuk
  </a>
</div>

<?= $this->endSection() ?>
