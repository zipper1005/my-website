<?= $this->extend($config->viewLayout) ?>

<?= $this->section('title') ?>
Masuk ke Sistem &mdash; SIA AKN-IPB
<?= $this->endSection() ?>

<?= $this->section('main') ?>

<div class="auth-header mb-4">
  <div class="d-flex align-items-center justify-content-between mb-2">
    <span class="badge badge-light border font-mono text-muted px-2 py-1" style="font-size: 11px;">
      <i class="fas fa-key mr-1 text-success"></i> OTENTIKASI PENGGUNA
    </span>
    <span class="badge badge-light border font-mono text-muted" style="font-size: 10px;">
      SAK EMKM
    </span>
  </div>
  <h3 class="font-weight-bold mb-1" style="color: var(--ink-950); letter-spacing: -0.03em; font-size: 1.55rem;">
    Masuk ke Portal
  </h3>
  <p class="text-muted small mb-0">
    Akses portal akuntansi &amp; keuangan <b>siarajib.free.nf</b>
  </p>
</div>

<?= view('Myth\Auth\Views\_message_block') ?>

<form method="POST" action="<?= url_to('login') ?>" class="needs-validation" novalidate="">
  <?= csrf_field() ?>

  <?php if ($config->validFields === ['email']) : ?>
    <div class="form-group mb-3">
      <label for="login" class="font-weight-600 text-muted small text-uppercase" style="letter-spacing: 0.5px;"><?= lang('Auth.email') ?></label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text font-mono" style="background: var(--paper-50); border-color: var(--line-200); color: var(--muted-600);">
            <i class="fas fa-envelope"></i>
          </span>
        </div>
        <input id="login" type="email" class="form-control font-mono <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" name="login" placeholder="nama@ipb.ac.id" value="<?= old('login') ?>" tabindex="1" required autofocus style="border-left: none;">
      </div>
      <div class="invalid-feedback">
        <?= session('errors.login') ?>
      </div>
    </div>
  <?php else : ?>
    <div class="form-group mb-3">
      <label for="login" class="font-weight-600 text-muted small text-uppercase" style="letter-spacing: 0.5px;"><?= lang('Auth.emailOrUsername') ?></label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text font-mono" style="background: var(--paper-50); border-color: var(--line-200); color: var(--muted-600);">
            <i class="fas fa-user-shield"></i>
          </span>
        </div>
        <input id="login" type="text" class="form-control font-mono <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" name="login" placeholder="Username atau email" value="<?= old('login') ?>" tabindex="1" required autofocus style="border-left: none;">
      </div>
      <div class="invalid-feedback">
        <?= session('errors.login') ?>
      </div>
    </div>
  <?php endif; ?>

  <div class="form-group mb-3">
    <div class="d-flex justify-content-between align-items-center mb-1">
      <label for="password" class="font-weight-600 text-muted small text-uppercase mb-0" style="letter-spacing: 0.5px;"><?= lang('Auth.password') ?></label>
      <?php if ($config->activeResetter) : ?>
        <a href="<?= url_to('forgot') ?>" class="small font-weight-500 font-mono" style="color: var(--forest-700); font-size: 11px;">
          <?= lang('Auth.forgotYourPassword') ?>
        </a>
      <?php endif; ?>
    </div>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text font-mono" style="background: var(--paper-50); border-color: var(--line-200); color: var(--muted-600);">
          <i class="fas fa-lock"></i>
        </span>
      </div>
      <input id="password" type="password" class="form-control font-mono <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" name="password" placeholder="Masukkan kata sandi" tabindex="2" required autocomplete="off" style="border-left: none; border-right: none;">
      <div class="input-group-append">
        <button class="btn btn-outline-secondary" type="button" id="btnTogglePassword" style="border-color: var(--line-200); background: var(--paper-50); color: var(--muted-600);" title="Tampilkan / Sembunyikan Kata Sandi">
          <i class="fas fa-eye" id="togglePasswordIcon"></i>
        </button>
      </div>
    </div>
    <div class="invalid-feedback">
      <?= session('errors.password') ?>
    </div>
  </div>

  <?php if ($config->allowRemembering) : ?>
    <div class="form-group mb-3">
      <div class="custom-control custom-checkbox">
        <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me" <?php if (old('remember')) : ?> checked <?php endif ?>>
        <label class="custom-control-label small text-muted" for="remember-me">
          Ingat sesi masuk di perangkat ini
        </label>
      </div>
    </div>
  <?php endif; ?>

  <div class="form-group mb-3">
    <button type="submit" class="btn btn-primary btn-lg btn-block font-weight-bold shadow-sm" tabindex="4" style="background-color: var(--forest-700) !important; border-color: var(--forest-700) !important; font-size: 0.95rem;">
      Masuk ke Dashboard &rarr;
    </button>
  </div>
</form>

<!-- Quick Credentials Hint Box (Academic Ledger Style) -->
<div class="mt-3 p-3 rounded border" style="background: var(--paper-50); border-color: var(--line-200) !important;">
  <div class="d-flex align-items-center justify-content-between mb-1">
    <span class="font-mono text-muted" style="font-size: 11px; font-weight: 600;">
      <i class="fas fa-info-circle text-primary mr-1"></i> AKUN DEMO / PENGUJIAN
    </span>
    <span class="badge badge-light border font-mono" style="font-size: 10px;">PROD</span>
  </div>
  <div class="small font-mono text-muted" style="font-size: 12px; line-height: 1.5;">
    Username: <code class="text-dark font-weight-bold">admin</code> &bull; Sandi: <code class="text-dark font-weight-bold">admin123</code>
  </div>
</div>

<?= $this->endSection() ?>
