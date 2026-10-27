<?= $this->extend('layout/backend') ?>

<?= $this->section('title') ?>
Daftar Transaksi &bull; SIA AKN-IPB
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<section class="section">
  <!-- Top Navigation & Action Bar (PRD v3) -->
  <div class="page-header-box">
    <div>
      <h1 class="page-title-main">Daftar Voucher Transaksi</h1>
      <p class="page-subtitle">Seluruh bukti transaksi kas masuk, kas keluar, dan mutasi terverifikasi SAK EMKM</p>
    </div>
    <div class="page-actions-group">
      <span class="badge badge-light border font-mono px-3 py-2" style="font-size: 11.5px;">
        <i class="fas fa-database text-success mr-1"></i> Total: <b><?= count($dttransaksi ?? []) ?></b> Transaksi
      </span>
      <a href="<?= site_url('transaksi/new') ?>" class="btn btn-primary btn-sm font-weight-bold shadow-sm">
        <i class="fas fa-plus mr-1"></i> Tambah Transaksi
      </a>
    </div>
  </div>

  <div class="section-body">
    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <div>
          <h4 class="mb-0 font-weight-bold" style="color: var(--color-ink);">Katalog Voucher Transaksi Terverifikasi</h4>
          <small class="text-secondary">Seluruh bukti transaksi terhubung langsung ke Jurnal Umum &amp; Buku Besar</small>
        </div>
        <div class="d-none d-sm-block">
          <span class="badge badge-light border font-mono text-secondary" style="font-size: 11px;">
            <i class="fas fa-shield-alt mr-1 text-success"></i> Standar SAK EMKM
          </span>
        </div>
      </div>
      <div class="card-body p-4">
        <div class="table-responsive">
          <table class="table table-hover table-bordered table-md" id="myTable">
            <thead style="background: var(--color-surface-muted);">
              <tr>
                <th class="text-center" style="width: 50px;">No</th>
                <th style="width: 140px;">No. Kwitansi</th>
                <th style="width: 120px;" class="text-center">Tanggal</th>
                <th>Deskripsi &amp; Memo Transaksi</th>
                <th style="width: 130px;" class="text-center">Status</th>
                <th class="text-center" style="width: 160px;">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php /** @var array $dttransaksi */ ?>
              <?php foreach ($dttransaksi as $key => $value) : ?>
                <tr>
                  <td class="text-center font-mono text-secondary"><?= $key + 1 ?></td>
                  <td>
                    <span class="badge font-mono font-weight-bold" style="background: var(--color-surface-muted); color: var(--color-ink); border: 1px solid var(--color-border); font-size: 11px;">
                      <i class="fas fa-receipt mr-1 text-success"></i> <?= esc($value->kwitansi) ?>
                    </span>
                  </td>
                  <td class="text-center font-mono text-secondary">
                    <?= date('d/m/Y', strtotime($value->tanggal)) ?>
                  </td>
                  <td>
                    <div class="font-weight-600 text-dark" style="line-height: 1.3;">
                      <?= esc($value->deskripsi) ?>
                    </div>
                    <?php if (!empty($value->ketjurnal)) : ?>
                      <small class="text-secondary d-block mt-1">
                        <i class="fas fa-tag mr-1 text-primary" style="font-size: 10px;"></i> Memo: <?= esc($value->ketjurnal) ?>
                      </small>
                    <?php endif; ?>
                  </td>
                  <td class="text-center">
                    <span class="health-badge badge-pass">
                      <i class="fas fa-check-circle mr-1" style="font-size: 10px;"></i> Terverifikasi
                    </span>
                  </td>
                  <td class="text-center">
                    <a href="<?= site_url('transaksi/' . $value->id_transaksi) ?>" class="btn btn-outline-secondary btn-sm py-1 px-2 mr-1" title="Lihat Detail Transaksi">
                      <i class="fas fa-eye text-primary"></i>
                    </a>
                    <a href="<?= site_url('transaksi/' . $value->id_transaksi . '/edit') ?>" class="btn btn-outline-secondary btn-sm py-1 px-2 mr-1" title="Koreksi / Edit Voucher">
                      <i class="fas fa-pencil-alt text-warning"></i>
                    </a>
                    <form action="<?= site_url('transaksi/' . $value->id_transaksi) ?>" method="post" id="del-<?= $value->id_transaksi ?>" class="d-inline">
                      <?= csrf_field() ?>
                      <input type="hidden" name="_method" value="DELETE">
                      <button type="button" class="btn btn-outline-secondary btn-sm py-1 px-2" onclick="hapus('<?= $value->id_transaksi ?>')" title="Hapus Transaksi">
                        <i class="fas fa-trash text-danger"></i>
                      </button>
                    </form>
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
