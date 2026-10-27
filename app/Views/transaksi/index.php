<?= $this->extend('layout/backend') ?>

<?= $this->section('title') ?>
Daftar Transaksi &bull; SIA AKN-IPB
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<section class="section">
  <!-- Top Navigation & Action Bar (PRD v2.0 Bab 5.1 & 6) -->
  <div class="d-flex justify-content-between align-items-center flex-wrap mb-4 pb-2">
    <div>
      <div class="text-secondary font-weight-600 mb-1 font-mono" style="font-size: 11px; letter-spacing: 0.8px;">
        WORKSPACE &bull; TRANSAKSI
      </div>
      <h2 class="font-weight-bold mb-0" style="color: var(--ink-950); letter-spacing: -0.03em; font-size: 1.65rem;">
        Daftar Voucher Transaksi Keuangan
      </h2>
    </div>
    <div class="mt-3 mt-md-0 d-flex align-items-center flex-wrap">
      <span class="badge badge-light border font-mono px-3 py-2 mr-2 mb-1" style="font-size: 11.5px;">
        <i class="fas fa-database text-success mr-1"></i> Total: <b><?= count($dttransaksi ?? []) ?></b> Transaksi
      </span>
      <a href="<?= site_url('transaksi/new') ?>" class="btn btn-primary font-weight-bold mb-1 shadow-sm">
        <i class="fas fa-plus mr-1"></i> Tambah Transaksi
      </a>
    </div>
  </div>

  <div class="section-body">
    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <div>
          <h4 class="mb-0 font-weight-bold" style="color: var(--ink-950);">Katalog Voucher Transaksi Terverifikasi</h4>
          <small class="text-secondary">Seluruh bukti transaksi terhubung langsung ke Jurnal Umum &amp; Buku Besar</small>
        </div>
        <div class="d-none d-sm-block">
          <span class="badge badge-light border font-mono text-secondary" style="font-size: 11px;">
            <i class="fas fa-filter mr-1 text-success"></i> Standar SAK EMKM
          </span>
        </div>
      </div>
      <div class="card-body p-4">
        <div class="table-responsive">
          <table class="table table-hover table-bordered table-md" id="myTable">
            <thead>
              <tr>
                <th class="text-center" style="width: 50px;">No</th>
                <th style="width: 140px;">No. Kwitansi</th>
                <th style="width: 120px;" class="text-center">Tanggal</th>
                <th>Deskripsi &amp; Memo Transaksi</th>
                <th style="width: 130px;" class="text-center">Status</th>
                <th class="text-center" style="width: 180px;">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php /** @var array $dttransaksi */ ?>
              <?php foreach ($dttransaksi as $key => $value) : ?>
                <tr>
                  <td class="text-center font-mono text-secondary"><?= $key + 1 ?></td>
                  <td>
                    <span class="badge badge-primary font-mono font-weight-bold">
                      <i class="fas fa-receipt mr-1"></i> <?= esc($value->kwitansi) ?>
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
                    <span class="badge badge-success font-weight-600">
                      <i class="fas fa-check-circle mr-1" style="font-size: 10px;"></i> Terverifikasi
                    </span>
                  </td>
                  <td class="text-center">
                    <a href="<?= site_url('transaksi/' . $value->id_transaksi) ?>" class="btn btn-outline-info btn-sm mr-1" title="Lihat Detail Transaksi">
                      <i class="fas fa-eye"></i>
                    </a>
                    <a href="<?= site_url('transaksi/' . $value->id_transaksi . '/edit') ?>" class="btn btn-outline-warning btn-sm mr-1" title="Koreksi / Edit Voucher">
                      <i class="fas fa-pencil-alt"></i>
                    </a>
                    <form action="<?= site_url('transaksi/' . $value->id_transaksi) ?>" method="post" id="del-<?= $value->id_transaksi ?>" class="d-inline">
                      <?= csrf_field() ?>
                      <input type="hidden" name="_method" value="DELETE">
                      <button type="button" class="btn btn-outline-danger btn-sm" onclick="hapus('<?= $value->id_transaksi ?>')" title="Hapus Transaksi">
                        <i class="fas fa-trash"></i>
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
