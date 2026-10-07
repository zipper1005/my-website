<?= $this->extend('layout/backend') ?>

<?= $this->section('title') ?>
Daftar Penyesuaian &bull; SIA AKN-IPB
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<section class="section">
  <!-- Top Navigation & Action Bar -->
  <div class="d-flex justify-content-between align-items-center flex-wrap mb-4 pb-2">
    <div>
      <div class="text-secondary font-weight-500 mb-1" style="font-size: 0.88rem;">
        <span>Operasional</span>
        <span class="mx-2">&bull;</span>
        <span class="text-primary font-mono">Buku Penyesuaian</span>
      </div>
      <h2 class="text-white font-weight-bold mb-0" style="letter-spacing: -0.03em; font-size: 1.65rem;">
        Daftar Transaksi Penyesuaian (AJP)
      </h2>
    </div>
    <div class="mt-3 mt-md-0 d-flex align-items-center flex-wrap">
      <span class="badge badge-light border font-mono px-3 py-2 mr-2 mb-1">
        <i class="fas fa-calculator text-warning mr-1"></i> Total: <?= count($dtpenyesuaian ?? []) ?> Penyesuaian
      </span>
      <a href="<?= site_url('penyesuaian/new') ?>" class="btn btn-primary font-weight-bold mb-1 shadow-sm">
        <i class="fas fa-plus mr-1"></i> Buat Penyesuaian
      </a>
    </div>
  </div>

  <div class="section-body">
    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <div>
          <h4 class="mb-0 text-white font-weight-bold">Katalog Penyesuaian &amp; Amortisasi Periode</h4>
          <small class="text-secondary">Pencatatan akrual dan amortisasi beban/pendapatan terjadwal</small>
        </div>
        <div class="d-none d-sm-block">
          <a href="<?= site_url('jurnalpenyesuaian') ?>" class="btn btn-outline-secondary btn-sm font-mono">
            <i class="fas fa-book mr-1"></i> Buka Jurnal Penyesuaian &rarr;
          </a>
        </div>
      </div>
      <div class="card-body p-4">
        <div class="table-responsive">
          <table class="table table-hover table-bordered table-md" id="myTable">
            <thead>
              <tr>
                <th class="text-center" style="width: 50px;">No</th>
                <th style="width: 120px;" class="text-center">Tanggal</th>
                <th>Deskripsi Penyesuaian</th>
                <th class="text-right" style="width: 180px;">Nilai Total (Rp)</th>
                <th class="text-center" style="width: 110px;">Durasi</th>
                <th class="text-right" style="width: 180px;">Beban / Bln (Rp)</th>
                <th class="text-center" style="width: 180px;">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php /** @var array $dtpenyesuaian */ ?>
              <?php foreach ($dtpenyesuaian as $key => $value) : ?>
                <tr>
                  <td class="text-center font-mono text-secondary"><?= $key + 1 ?></td>
                  <td class="text-center font-mono text-secondary"><?= date('d/m/Y', strtotime($value->tanggal)) ?></td>
                  <td>
                    <div class="font-weight-600 text-white"><?= esc($value->deskripsi) ?></div>
                  </td>
                  <td class="text-right font-mono font-weight-bold text-white">
                    Rp <?= number_format((float)$value->nilai, 0, ',', '.') ?>
                  </td>
                  <td class="text-center font-mono">
                    <span class="badge badge-light border">
                      <i class="far fa-clock mr-1 text-primary"></i> <?= esc($value->waktu) ?> bln
                    </span>
                  </td>
                  <td class="text-right font-mono font-weight-bold text-primary">
                    Rp <?= number_format((float)$value->jumlah, 0, ',', '.') ?>
                  </td>
                  <td class="text-center">
                    <a href="<?= site_url('penyesuaian/' . $value->id_penyesuaian) ?>" class="btn btn-outline-info btn-sm mr-1" title="Lihat Detail">
                      <i class="fas fa-eye"></i>
                    </a>
                    <a href="<?= site_url('penyesuaian/' . $value->id_penyesuaian . '/edit') ?>" class="btn btn-outline-warning btn-sm mr-1" title="Edit Penyesuaian">
                      <i class="fas fa-pencil-alt"></i>
                    </a>
                    <form action="<?= site_url('penyesuaian/' . $value->id_penyesuaian) ?>" method="post" id="del-peny-<?= $value->id_penyesuaian ?>" class="d-inline">
                      <?= csrf_field() ?>
                      <input type="hidden" name="_method" value="DELETE">
                      <button type="button" class="btn btn-outline-danger btn-sm" onclick="hapus('peny-<?= $value->id_penyesuaian ?>')" title="Hapus Penyesuaian">
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
