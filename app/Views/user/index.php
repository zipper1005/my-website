<?= $this->extend('layout/backend') ?>

<?= $this->section('title') ?>
Manajemen User
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<section class="section">
  <div class="section-header">
    <h1>Manajemen User</h1>
    <div class="section-header-button">
      <a href="<?= site_url('users/new') ?>" class="btn btn-primary"><i class="fas fa-user-plus mr-1"></i> Tambah User</a>
    </div>
  </div>

  <?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success alert-dismissible show fade">
      <div class="alert-body">
        <button class="close" data-dismiss="alert"> &times; </button>
        <?= session()->getFlashdata('success') ?>
      </div>
    </div>
  <?php endif; ?>

  <?php if (session()->getFlashdata('error')) : ?>
    <div class="alert alert-danger alert-dismissible show fade">
      <div class="alert-body">
        <button class="close" data-dismiss="alert"> &times; </button>
        <?= session()->getFlashdata('error') ?>
      </div>
    </div>
  <?php endif; ?>

  <div class="section-body">
    <div class="card">
      <div class="card-header">
        <h4>Daftar Pengguna Sistem (Myth:Auth)</h4>
      </div>
      <div class="card-body p-4">
        <div class="table-responsive">
          <table class="table table-striped table-md" id="myTable">
            <thead>
              <tr>
                <th style="width: 50px;">No</th>
                <th>Username</th>
                <th>Email</th>
                <th>Role / Group</th>
                <th class="text-center">Status</th>
                <th>Tanggal Daftar</th>
                <th class="text-center" style="width: 180px;">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($users as $key => $row) : ?>
                <tr>
                  <td><?= $key + 1 ?></td>
                  <td>
                    <strong><?= esc($row->username) ?></strong>
                    <?php if (user_id() == $row->id) : ?>
                      <span class="badge badge-light text-primary ml-1">(Anda)</span>
                    <?php endif; ?>
                  </td>
                  <td><?= esc($row->email) ?></td>
                  <td>
                    <?php if ($row->group_name == 'admin') : ?>
                      <span class="badge badge-primary"><i class="fas fa-user-shield mr-1"></i> Admin</span>
                    <?php elseif ($row->group_name == 'user') : ?>
                      <span class="badge badge-info"><i class="fas fa-user mr-1"></i> User</span>
                    <?php else : ?>
                      <span class="badge badge-secondary"><?= esc($row->group_name ?? 'None') ?></span>
                    <?php endif; ?>
                  </td>
                  <td class="text-center">
                    <?php if ($row->active == 1) : ?>
                      <a href="<?= site_url('users/toggle/' . $row->id) ?>" class="badge badge-success" title="Klik untuk menonaktifkan">
                        <i class="fas fa-check-circle mr-1"></i> Aktif
                      </a>
                    <?php else : ?>
                      <a href="<?= site_url('users/toggle/' . $row->id) ?>" class="badge badge-warning" title="Klik untuk mengaktifkan">
                        <i class="fas fa-times-circle mr-1"></i> Nonaktif
                      </a>
                    <?php endif; ?>
                  </td>
                  <td><?= $row->created_at ? date('d/m/Y H:i', strtotime($row->created_at)) : '-' ?></td>
                  <td class="text-center">
                    <a href="<?= site_url('users/edit/' . $row->id) ?>" class="btn btn-warning btn-sm" title="Edit Role & Status">
                      <i class="fas fa-pencil-alt"></i> Edit
                    </a>
                    <?php if (user_id() != $row->id) : ?>
                      <form action="<?= site_url('users/delete/' . $row->id) ?>" method="POST" id="del-user-<?= $row->id ?>" class="d-inline">
                        <?= csrf_field() ?>
                        <button type="button" class="btn btn-danger btn-sm" onclick="hapus('user-<?= $row->id ?>')" title="Hapus User">
                          <i class="fas fa-trash"></i>
                        </button>
                      </form>
                    <?php endif; ?>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>

<?= $this->endSection() ?>
