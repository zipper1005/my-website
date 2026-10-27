<?= $this->extend($config->viewLayout) ?>

<?= $this->section('title') ?>
Registrasi Akun Baru &mdash; SIA AKN-IPB
<?= $this->endSection() ?>

<?= $this->section('main') ?>

<div class="auth-header mb-4">
  <span class="badge badge-light border font-mono mb-2 px-2 py-1" style="font-size: 11px;">
    <i class="fas fa-user-plus mr-1 text-success"></i> PENDAFTARAN AKUN
  </span>
  <h3 class="font-weight-bold mb-1" style="color: var(--ink-950); letter-spacing: -0.03em; font-size: 1.45rem;">
    Registrasi Pengguna
  </h3>
  <p class="text-muted small mb-0">Daftarkan akun untuk akses Sistem Informasi Akuntansi.</p>
</div>

<?= view('Myth\Auth\Views\_message_block') ?>

<form method="POST" action="<?= url_to('register') ?>" class="needs-validation" novalidate="">
  <?= csrf_field() ?>

  <div class="form-group mb-3">
    <label for="email" class="font-weight-600 text-muted small text-uppercase" style="letter-spacing: 0.5px;"><?= lang('Auth.email') ?></label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text font-mono" style="background: var(--paper-50); border-color: var(--line-200); color: var(--muted-600);">
          <i class="fas fa-envelope"></i>
        </span>
      </div>
      <input id="email" type="email" class="form-control font-mono <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" name="email" placeholder="nama@ipb.ac.id" value="<?= old('email') ?>" required autofocus style="border-left: none;">
    </div>
    <div class="invalid-feedback">
      <?= session('errors.email') ?>
    </div>
  </div>

  <div class="form-group mb-3">
    <label for="username" class="font-weight-600 text-muted small text-uppercase" style="letter-spacing: 0.5px;"><?= lang('Auth.username') ?></label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text font-mono" style="background: var(--paper-50); border-color: var(--line-200); color: var(--muted-600);">
          <i class="fas fa-user"></i>
        </span>
      </div>
      <input id="username" type="text" class="form-control font-mono <?php if (session('errors.username')) : ?>is-invalid<?php endif ?>" name="username" placeholder="Username pilihan Anda" value="<?= old('username') ?>" required style="border-left: none;">
    </div>
    <div class="invalid-feedback">
      <?= session('errors.username') ?>
    </div>
  </div>

  <div class="form-group mb-3">
    <label for="password" class="font-weight-600 text-muted small text-uppercase" style="letter-spacing: 0.5px;"><?= lang('Auth.password') ?></label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text font-mono" style="background: var(--paper-50); border-color: var(--line-200); color: var(--muted-600);">
          <i class="fas fa-lock"></i>
        </span>
      </div>
      <input id="password" type="password" class="form-control font-mono <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" name="password" placeholder="Minimal 8 karakter" required autocomplete="off" style="border-left: none;">
    </div>
    <div class="invalid-feedback">
      <?= session('errors.password') ?>
    </div>
  </div>

  <div class="form-group mb-4">
    <label for="pass_confirm" class="font-weight-600 text-muted small text-uppercase" style="letter-spacing: 0.5px;"><?= lang('Auth.repeatPassword') ?></label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text font-mono" style="background: var(--paper-50); border-color: var(--line-200); color: var(--muted-600);">
          <i class="fas fa-shield-alt"></i>
        </span>
      </div>
      <input id="pass_confirm" type="password" class="form-control font-mono <?php if (session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>" name="pass_confirm" placeholder="Ulangi kata sandi" required autocomplete="off" style="border-left: none;">
    </div>
    <div class="invalid-feedback">
      <?= session('errors.pass_confirm') ?>
    </div>
  </div>

  <div class="form-group mb-3">
    <button type="submit" class="btn btn-primary btn-lg btn-block font-weight-bold" style="background-color: var(--forest-700) !important; border-color: var(--forest-700) !important;">
      Daftar Akun Baru &rarr;
    </button>
  </div>
</form>

<div class="text-center mt-3 pt-3 border-top" style="border-color: var(--line-200) !important;">
  <span class="text-muted small"><?= lang('Auth.alreadyRegistered') ?></span>
  <a href="<?= url_to('login') ?>" class="font-weight-bold small ml-1" style="color: var(--forest-700);">
    <?= lang('Auth.signIn') ?>
  </a>
</div>

<?= $this->endSection() ?>
