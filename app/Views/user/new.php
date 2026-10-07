<?= $this->extend('layout/backend') ?>

<?= $this->section('title') ?>
Tambah User Baru
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<section class="section">
  <div class="section-header">
    <div class="section-header-back">
      <a href="<?= site_url('users') ?>" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
    </div>
    <h1>Tambah User Baru</h1>
  </div>

  <?php if (session()->getFlashdata('errors')) : ?>
    <div class="alert alert-danger alert-dismissible show fade">
      <div class="alert-body">
        <button class="close" data-dismiss="alert"> &times; </button>
        <ul class="mb-0">
          <?php foreach (session()->getFlashdata('errors') as $error) : ?>
            <li><?= esc($error) ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
  <?php endif; ?>

  <div class="section-body">
    <div class="card col-12 col-md-8 col-lg-6">
      <div class="card-header">
        <h4>Form Input User Baru</h4>
      </div>
      <div class="card-body">
        <form action="<?= site_url('users/store') ?>" method="POST" autocomplete="off">
          <?= csrf_field() ?>

          <div class="form-group">
            <label for="username">Username <span class="text-danger">*</span></label>
            <input type="text" name="username" id="username" class="form-control" value="<?= old('username') ?>" placeholder="Masukkan username" required autofocus>
          </div>

          <div class="form-group">
            <label for="email">Email <span class="text-danger">*</span></label>
            <input type="email" name="email" id="email" class="form-control" value="<?= old('email') ?>" placeholder="nama@email.com" required>
          </div>

          <div class="form-group">
            <label for="password">Password <span class="text-danger">*</span></label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Minimal 8 karakter" required>
          </div>

          <div class="form-group">
            <label for="pass_confirm">Konfirmasi Password <span class="text-danger">*</span></label>
            <input type="password" name="pass_confirm" id="pass_confirm" class="form-control" placeholder="Ulangi password" required>
          </div>

          <div class="form-group">
            <label for="group_id">Pilih Role / Hak Akses <span class="text-danger">*</span></label>
            <select name="group_id" id="group_id" class="form-control selectric" required>
              <?php foreach ($groups as $group) : ?>
                <option value="<?= $group->id ?>" <?= (old('group_id') == $group->id || ($group->name == 'user' && !old('group_id'))) ? 'selected' : '' ?>>
                  <?= ucfirst(esc($group->name)) ?> &mdash; <?= esc($group->description) ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="form-group">
            <div class="control-label">Status Akun</div>
            <label class="custom-switch mt-2">
              <input type="checkbox" name="active" value="1" class="custom-switch-input" checked>
              <span class="custom-switch-indicator"></span>
              <span class="custom-switch-description">Aktifkan Akun Sekarang</span>
            </label>
          </div>

          <div class="form-group mt-4">
            <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i> Simpan User</button>
            <a href="<?= site_url('users') ?>" class="btn btn-secondary ml-1">Batal</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

<?= $this->endSection() ?>
