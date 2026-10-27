<?= $this->extend($config->viewLayout) ?>

<?= $this->section('title') ?>
Pemulihan Kata Sandi &mdash; SIA AKN-IPB
<?= $this->endSection() ?>

<?= $this->section('main') ?>

<div class="auth-header mb-4">
  <span class="badge badge-light border font-mono mb-2 px-2 py-1" style="font-size: 11px;">
    <i class="fas fa-key mr-1 text-success"></i> PEMULIHAN SANDI
  </span>
  <h3 class="font-weight-bold mb-1" style="color: var(--ink-950); letter-spacing: -0.03em; font-size: 1.45rem;">
    Lupa Kata Sandi?
  </h3>
  <p class="text-muted small mb-0"><?= lang('Auth.enterEmailForInstructions') ?></p>
</div>

<?= view('Myth\Auth\Views\_message_block') ?>

<form method="POST" action="<?= url_to('forgot') ?>" class="needs-validation" novalidate="">
  <?= csrf_field() ?>

  <div class="form-group mb-4">
    <label for="email" class="font-weight-600 text-muted small text-uppercase" style="letter-spacing: 0.5px;"><?= lang('Auth.emailAddress') ?></label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text font-mono" style="background: var(--paper-50); border-color: var(--line-200); color: var(--muted-600);">
          <i class="fas fa-envelope"></i>
        </span>
      </div>
      <input id="email" type="email" class="form-control font-mono <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" name="email" placeholder="<?= lang('Auth.email') ?>" required autofocus style="border-left: none;">
    </div>
    <div class="invalid-feedback">
      <?= session('errors.email') ?>
    </div>
  </div>

  <div class="form-group mb-3">
    <button type="submit" class="btn btn-primary btn-lg btn-block font-weight-bold" style="background-color: var(--forest-700) !important; border-color: var(--forest-700) !important;">
      <?= lang('Auth.sendInstructions') ?> &rarr;
    </button>
  </div>
</form>

<div class="text-center mt-3 pt-3 border-top" style="border-color: var(--line-200) !important;">
  <a href="<?= url_to('login') ?>" class="font-weight-bold small" style="color: var(--forest-700);">
    &larr; Kembali ke Halaman Masuk
  </a>
</div>

<?= $this->endSection() ?>
