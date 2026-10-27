<?= $this->extend($config->viewLayout) ?>

<?= $this->section('title') ?>
Masuk ke SIA &mdash; SIA AKN-IPB
<?= $this->endSection() ?>

<?= $this->section('main') ?>

<div class="mb-4">
  <h2 style="font-size: 22px; font-weight: 700; color: var(--color-ink); letter-spacing: -0.02em; margin-bottom: 4px;">
    Masuk ke SIA
  </h2>
  <p style="font-size: 13px; color: var(--color-text-secondary); margin: 0;">
    Silakan masukkan kredensial akun Anda untuk mengakses sistem pembukuan.
  </p>
</div>

<?= view('Myth\Auth\Views\_message_block') ?>

<form method="POST" action="<?= url_to('login') ?>" class="needs-validation" novalidate="">
  <?= csrf_field() ?>

  <?php if ($config->validFields === ['email']) : ?>
    <div class="form-group mb-3">
      <label for="login" style="font-size: 12.5px; font-weight: 600; color: var(--color-ink);">
        <?= lang('Auth.email') ?>
      </label>
      <input id="login" type="email" class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" name="login" placeholder="nama@ipb.ac.id" value="<?= old('login') ?>" required autofocus>
      <div class="invalid-feedback">
        <?= session('errors.login') ?>
      </div>
    </div>
  <?php else : ?>
    <div class="form-group mb-3">
      <label for="login" style="font-size: 12.5px; font-weight: 600; color: var(--color-ink);">
        <?= lang('Auth.emailOrUsername') ?>
      </label>
      <input id="login" type="text" class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" name="login" placeholder="Username atau email" value="<?= old('login') ?>" required autofocus>
      <div class="invalid-feedback">
        <?= session('errors.login') ?>
      </div>
    </div>
  <?php endif; ?>

  <div class="form-group mb-3">
    <div class="d-flex justify-content-between align-items-center mb-1">
      <label for="password" style="font-size: 12.5px; font-weight: 600; color: var(--color-ink); margin: 0;">
        <?= lang('Auth.password') ?>
      </label>
      <?php if ($config->activeResetter) : ?>
        <a href="<?= url_to('forgot') ?>" style="font-size: 12px; color: var(--color-primary); font-weight: 500;">
          <?= lang('Auth.forgotYourPassword') ?>
        </a>
      <?php endif; ?>
    </div>
    <div class="position-relative">
      <input id="password" type="password" class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" name="password" placeholder="Masukkan kata sandi" required autocomplete="off" style="padding-right: 38px;">
      <button type="button" id="btnTogglePassword" style="position: absolute; right: 0; top: 0; height: 100%; border: none; background: transparent; color: var(--color-text-secondary); padding: 0 12px; cursor: pointer;" title="Tampilkan / Sembunyikan Kata Sandi" aria-label="Toggle password visibility">
        <i class="fas fa-eye" id="toggleIcon" style="font-size: 13px;"></i>
      </button>
    </div>
    <div class="invalid-feedback">
      <?= session('errors.password') ?>
    </div>
  </div>

  <?php if ($config->allowRemembering) : ?>
    <div class="form-group mb-4">
      <div class="custom-control custom-checkbox">
        <input type="checkbox" name="remember" class="custom-control-input" id="remember-me" <?php if (old('remember')) : ?> checked <?php endif ?>>
        <label class="custom-control-label" for="remember-me" style="font-size: 12.5px; color: var(--color-text-secondary); cursor: pointer;">
          Ingat sesi masuk di perangkat ini
        </label>
      </div>
    </div>
  <?php else : ?>
    <div class="mb-3"></div>
  <?php endif; ?>

  <button type="submit" class="btn btn-primary btn-block font-weight-bold" style="height: 40px; font-size: 14px;">
    Masuk ke Dashboard &rarr;
  </button>
</form>

<?= $this->endSection() ?>
