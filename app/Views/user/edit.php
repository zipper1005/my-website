<?= $this->extend('layout/backend') ?>

<?= $this->section('title') ?>
Edit User
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<section class="section">
  <div class="section-header">
    <div class="section-header-back">
      <a href="<?= site_url('users') ?>" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
    </div>
    <h1>Edit User</h1>
  </div>

  <div class="section-body">
    <div class="card col-12 col-md-8 col-lg-6">
      <div class="card-header">
        <h4>Edit Akses & Status: <?= esc($user->username) ?></h4>
      </div>
      <div class="card-body">
        <form action="<?= site_url('users/update/' . $user->id) ?>" method="POST" autocomplete="off">
          <?= csrf_field() ?>

          <div class="form-group">
            <label>Username</label>
            <input type="text" class="form-control" value="<?= esc($user->username) ?>" readonly>
          </div>

          <div class="form-group">
            <label>Email</label>
            <input type="email" class="form-control" value="<?= esc($user->email) ?>" readonly>
          </div>

          <div class="form-group">
            <label for="group_id">Role / Group</label>
            <select name="group_id" id="group_id" class="form-control selectric" required>
              <?php foreach ($groups as $group) : ?>
                <option value="<?= $group->id ?>" <?= ($user->group_id == $group->id) ? 'selected' : '' ?>>
                  <?= ucfirst(esc($group->name)) ?> &mdash; <?= esc($group->description) ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="form-group">
            <div class="control-label">Status Akun</div>
            <label class="custom-switch mt-2">
              <input type="checkbox" name="active" value="1" class="custom-switch-input" <?= ($user->active == 1) ? 'checked' : '' ?>>
              <span class="custom-switch-indicator"></span>
              <span class="custom-switch-description">Akun Aktif (Dapat Login)</span>
            </label>
          </div>

          <div class="form-group mt-4">
            <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane mr-1"></i> Simpan Perubahan</button>
            <a href="<?= site_url('users') ?>" class="btn btn-secondary ml-1">Batal</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

<?= $this->endSection() ?>
