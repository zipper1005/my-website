<?= $this->extend($config->viewLayout) ?>

<?= $this->section('title') ?>
Reset Password
<?= $this->endSection() ?>

<?= $this->section('main') ?>

<div class="card card-primary shadow-sm">
  <div class="card-header pb-0">
    <h4 class="text-primary font-weight-bold"><?= lang('Auth.resetYourPassword') ?></h4>
  </div>

  <div class="card-body">
    <?= view('Myth\Auth\Views\_message_block') ?>

    <p class="text-muted"><?= lang('Auth.enterCodeEmailPassword') ?></p>

    <form method="POST" action="<?= url_to('reset-password') ?>">
      <?= csrf_field() ?>

      <div class="form-group">
        <label for="token"><?= lang('Auth.token') ?></label>
        <input type="text" class="form-control <?php if (session('errors.token')) : ?>is-invalid<?php endif ?>" name="token" placeholder="<?= lang('Auth.token') ?>" value="<?= old('token', $token ?? '') ?>" required>
        <div class="invalid-feedback">
          <?= session('errors.token') ?>
        </div>
      </div>

      <div class="form-group">
        <label for="email"><?= lang('Auth.email') ?></label>
        <input type="email" class="form-control <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" name="email" placeholder="<?= lang('Auth.email') ?>" value="<?= old('email') ?>" required>
        <div class="invalid-feedback">
          <?= session('errors.email') ?>
        </div>
      </div>

      <div class="form-group">
        <label for="password"><?= lang('Auth.newPassword') ?></label>
        <input type="password" class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" name="password" placeholder="<?= lang('Auth.newPassword') ?>" required autocomplete="off">
        <div class="invalid-feedback">
          <?= session('errors.password') ?>
        </div>
      </div>

      <div class="form-group">
        <label for="pass_confirm"><?= lang('Auth.newPasswordConfirm') ?></label>
        <input type="password" class="form-control <?php if (session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>" name="pass_confirm" placeholder="<?= lang('Auth.newPasswordConfirm') ?>" required autocomplete="off">
        <div class="invalid-feedback">
          <?= session('errors.pass_confirm') ?>
        </div>
      </div>

      <div class="form-group">
        <button type="submit" class="btn btn-primary btn-lg btn-block shadow-sm">
          <?= lang('Auth.resetPassword') ?>
        </button>
      </div>
    </form>
  </div>
</div>

<?= $this->endSection() ?>
