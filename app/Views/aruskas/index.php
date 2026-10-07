<?= $this->extend('layout/backend') ?>

<?= $this->section('title') ?>
Laporan Arus Kas &bull; SIA AKN-IPB
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<section class="section">
  <div class="section-header">
    <h1>Laporan Arus Kas</h1>
  </div>

  <div class="section-body">
    <!-- Filter Periode Tanggal -->
    <div class="card mb-4">
      <div class="card-body">
        <form method="get" action="<?= site_url('aruskas') ?>">
          <div class="row align-items-end">
            <div class="col-md-3">
              <div class="form-group mb-0">
                <label>Tanggal Awal</label>
                <input type="date" class="form-control font-mono" name="tgl_awal" value="<?= esc($tgl_awal) ?>">
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group mb-0">
                <label>Tanggal Akhir</label>
                <input type="date" class="form-control font-mono" name="tgl_akhir" value="<?= esc($tgl_akhir) ?>">
              </div>
            </div>
            <div class="col-md-6 mt-3 mt-md-0">
              <button type="submit" class="btn btn-primary mr-2 shadow-sm font-weight-bold">
                <i class="fas fa-filter mr-1"></i> Tampilkan
              </button>
              <button type="submit" formaction="<?= site_url('aruskas/cetakaruskaspdf') ?>" formtarget="_blank" class="btn btn-danger shadow-sm font-weight-bold">
                <i class="fas fa-file-pdf mr-1"></i> Cetak PDF
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>

    <!-- Tampilan Laporan Arus Kas -->
    <div class="card">
      <div class="card-header text-center d-block py-3">
        <h4 class="mb-1 text-white font-weight-bold" style="letter-spacing: -0.02em;">SIA AKN-IPB</h4>
        <h5 class="mb-1 text-primary font-weight-bold font-mono">LAPORAN ARUS KAS (CASH FLOW)</h5>
        <small class="text-secondary font-mono">
          Periode: <?= (!empty($tgl_awal) && !empty($tgl_akhir)) ? date('d F Y', strtotime($tgl_awal)) . ' s/d ' . date('d F Y', strtotime($tgl_akhir)) : 'Semua Periode' ?>
        </small>
      </div>
      <div class="card-body p-4">
        <div class="table-responsive">
          <table class="table table-bordered table-md">
            <tbody>
              <!-- 1. KAS MASUK -->
              <tr class="table-success font-weight-bold">
                <th colspan="3">PENERIMAAN KAS (ARUS KAS MASUK)</th>
                <th class="text-right" style="width: 25%;">Nominal (Rp)</th>
              </tr>
              <?php if (!empty($data_ak['kas_masuk'])) : ?>
                <?php foreach ($data_ak['kas_masuk'] as $km) : ?>
                  <tr>
                    <td style="width: 12%;" class="text-center font-mono"><?= date('d/m/Y', strtotime($km->tanggal)) ?></td>
                    <td style="width: 12%;" class="text-center font-mono"><?= esc($km->kwitansi) ?></td>
                    <td><?= esc($km->deskripsi) ?></td>
                    <td class="text-right text-success font-mono font-weight-bold">+ <?= number_format($km->debit, 0, ',', '.') ?></td>
                  </tr>
                <?php endforeach; ?>
              <?php else : ?>
                <tr>
                  <td colspan="4" class="text-center text-secondary font-italic py-3">Tidak ada penerimaan kas pada periode ini</td>
                </tr>
              <?php endif; ?>
              <tr class="font-weight-bold bg-light">
                <td colspan="3" class="text-right">Total Penerimaan Kas</td>
                <td class="text-right text-success font-mono font-weight-bold" style="font-size: 1rem;">
                  Rp <?= number_format($data_ak['total_kas_masuk'], 0, ',', '.') ?>
                </td>
              </tr>

              <!-- 2. KAS KELUAR -->
              <tr class="table-danger font-weight-bold">
                <th colspan="3">PENGELUARAN KAS (ARUS KAS KELUAR)</th>
                <th class="text-right">Nominal (Rp)</th>
              </tr>
              <?php if (!empty($data_ak['kas_keluar'])) : ?>
                <?php foreach ($data_ak['kas_keluar'] as $kk) : ?>
                  <tr>
                    <td class="text-center font-mono"><?= date('d/m/Y', strtotime($kk->tanggal)) ?></td>
                    <td class="text-center font-mono"><?= esc($kk->kwitansi) ?></td>
                    <td><?= esc($kk->deskripsi) ?></td>
                    <td class="text-right text-danger font-mono font-weight-bold">- <?= number_format($kk->kredit, 0, ',', '.') ?></td>
                  </tr>
                <?php endforeach; ?>
              <?php else : ?>
                <tr>
                  <td colspan="4" class="text-center text-secondary font-italic py-3">Tidak ada pengeluaran kas pada periode ini</td>
                </tr>
              <?php endif; ?>
              <tr class="font-weight-bold bg-light">
                <td colspan="3" class="text-right">Total Pengeluaran Kas</td>
                <td class="text-right text-danger font-mono font-weight-bold" style="font-size: 1rem;">
                  Rp <?= number_format($data_ak['total_kas_keluar'], 0, ',', '.') ?>
                </td>
              </tr>

              <!-- 3. SALDO AKHIR KAS -->
              <tr class="table-primary font-weight-bold" style="font-size: 1.05rem;">
                <td colspan="3" class="text-uppercase text-right">
                  Kenaikan Bersih / Saldo Akhir Kas
                </td>
                <td class="text-right text-primary font-mono font-weight-bold" style="font-size: 1.15rem;">
                  Rp <?= number_format($data_ak['saldo_akhir'], 0, ',', '.') ?>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>

<?= $this->endSection() ?>
