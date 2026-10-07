<?= $this->extend($config->viewLayout) ?>

<?= $this->section('title') ?>
Masuk ke Sistem &mdash; SIA AKN-IPB
<?= $this->endSection() ?>

<?= $this->section('main') ?>

<div class="auth-header mb-4">
  <span class="badge badge-primary font-mono mb-2 px-2 py-1" style="font-size: 0.72rem;">
    <i class="fas fa-lock mr-1"></i> OTENTIKASI RESMI
  </span>
  <h3 class="font-weight-bold text-white mb-1" style="letter-spacing: -0.03em; font-size: 1.55rem;">Masuk ke Portal</h3>
  <p class="text-secondary small mb-0">Akses portal akuntansi &amp; keuangan <b>siarajib.software</b></p>
</div>

<?= view('Myth\Auth\Views\_message_block') ?>

<form method="POST" action="<?= url_to('login') ?>" class="needs-validation" novalidate="">
  <?= csrf_field() ?>

  <?php if ($config->validFields === ['email']) : ?>
    <div class="form-group mb-3">
      <label for="login" class="font-weight-600 text-secondary small text-uppercase" style="letter-spacing: 0.5px;"><?= lang('Auth.email') ?></label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text font-mono" style="background: #06162E; border-color: var(--border-subtle); color: var(--blue-light);">
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
      <label for="login" class="font-weight-600 text-secondary small text-uppercase" style="letter-spacing: 0.5px;"><?= lang('Auth.emailOrUsername') ?></label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text font-mono" style="background: #06162E; border-color: var(--border-subtle); color: var(--blue-light);">
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
      <label for="password" class="font-weight-600 text-secondary small text-uppercase mb-0" style="letter-spacing: 0.5px;"><?= lang('Auth.password') ?></label>
      <?php if ($config->activeResetter) : ?>
        <a href="<?= url_to('forgot') ?>" class="small font-weight-500 font-mono" style="color: var(--blue-light); font-size: 11px;">
          <?= lang('Auth.forgotYourPassword') ?>
        </a>
      <?php endif; ?>
    </div>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text font-mono" style="background: #06162E; border-color: var(--border-subtle); color: var(--blue-light);">
          <i class="fas fa-key"></i>
        </span>
      </div>
      <input id="password" type="password" class="form-control font-mono <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" name="password" placeholder="Masukkan kata sandi" tabindex="2" required autocomplete="off" style="border-left: none; border-right: none;">
      <div class="input-group-append">
        <button class="btn btn-outline-secondary" type="button" id="btnTogglePassword" style="border-color: var(--border-subtle); background: #06162E; color: var(--text-secondary);" title="Tampilkan / Sembunyikan Kata Sandi">
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
        <label class="custom-control-label small text-secondary" for="remember-me">
          Ingat sesi masuk di perangkat ini
        </label>
      </div>
    </div>
  <?php endif; ?>

  <div class="form-group mb-3">
    <button type="submit" class="btn btn-primary btn-lg btn-block font-weight-bold shadow-sm" tabindex="4" style="background: linear-gradient(135deg, #2563EB 0%, #1D4ED8 100%) !important; border: none; font-size: 0.95rem;">
      Masuk ke Dashboard &rarr;
    </button>
  </div>
</form>

<!-- Quick Test Credentials Hint Box -->
<div class="mt-3 p-2 rounded text-center border" style="background: #06162E; border-color: rgba(22, 50, 89, 0.6) !important;">
  <small class="text-secondary font-mono" style="font-size: 11px;">
    <i class="fas fa-info-circle text-primary mr-1"></i> Akun Uji: <b>mrajibprasetya</b> &bull; Sandi: <b>admin123</b>
  </small>
</div>

<?php if ($config->allowRegistration) : ?>
  <div class="text-center mt-3 pt-3 border-top" style="border-color: var(--border-subtle) !important;">
    <span class="text-secondary small">Belum memiliki akun?</span>
    <a href="<?= url_to('register') ?>" class="font-weight-bold small ml-1" style="color: var(--blue-light);">
      <?= lang('Auth.register') ?> &rarr;
    </a>
  </div>
<?php endif; ?>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const btnToggle = document.getElementById('btnTogglePassword');
    const pwdInput = document.getElementById('password');
    const toggleIcon = document.getElementById('togglePasswordIcon');
    if (btnToggle && pwdInput) {
      btnToggle.addEventListener('click', function() {
        if (pwdInput.type === 'password') {
          pwdInput.type = 'text';
          toggleIcon.classList.remove('fa-eye');
          toggleIcon.classList.add('fa-eye-slash');
        } else {
          pwdInput.type = 'password';
          toggleIcon.classList.remove('fa-eye-slash');
          toggleIcon.classList.add('fa-eye');
        }
      });
    }
  });
</script>

<?= $this->endSection() ?>
