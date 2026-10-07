<?= $this->extend('layout/backend') ?>

<?= $this->section('title') ?>
Laporan Laba Rugi &bull; SIA AKN-IPB
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<section class="section">
  <div class="section-header">
    <h1>Laporan Laba Rugi</h1>
  </div>

  <div class="section-body">
    <!-- Filter Periode Tanggal -->
    <div class="card mb-4">
      <div class="card-body">
        <form method="get" action="<?= site_url('labarugi') ?>">
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
              <button type="submit" formaction="<?= site_url('labarugi/cetaklabarugipdf') ?>" formtarget="_blank" class="btn btn-danger shadow-sm font-weight-bold">
                <i class="fas fa-file-pdf mr-1"></i> Cetak PDF
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>

    <!-- Tampilan Laporan Laba Rugi -->
    <div class="card">
      <div class="card-header text-center d-block py-3">
        <h4 class="mb-1 text-white font-weight-bold" style="letter-spacing: -0.02em;">SIA AKN-IPB</h4>
        <h5 class="mb-1 text-primary font-weight-bold font-mono">LAPORAN LABA RUGI (INCOME STATEMENT)</h5>
        <small class="text-secondary font-mono">
          Periode: <?= (!empty($tgl_awal) && !empty($tgl_akhir)) ? date('d F Y', strtotime($tgl_awal)) . ' s/d ' . date('d F Y', strtotime($tgl_akhir)) : 'Semua Periode' ?>
        </small>
      </div>
      <div class="card-body p-4">
        <div class="table-responsive">
          <table class="table table-bordered table-md">
            <tbody>
              <!-- 1. PENDAPATAN -->
              <tr class="table-primary font-weight-bold">
                <th colspan="2">PENDAPATAN USAHA</th>
                <th class="text-right" style="width: 25%;">Nominal (Rp)</th>
              </tr>
              <?php if (!empty($data_lr['pendapatan'])) : ?>
                <?php foreach ($data_lr['pendapatan'] as $p) : ?>
                  <tr>
                    <td style="width: 15%;" class="text-center font-mono"><?= esc($p->kode_akun3) ?></td>
                    <td><?= esc($p->nama_akun3) ?></td>
                    <td class="text-right font-mono font-weight-bold text-white"><?= number_format($p->nominal, 0, ',', '.') ?></td>
                  </tr>
                <?php endforeach; ?>
              <?php else : ?>
                <tr>
                  <td colspan="3" class="text-center text-secondary font-italic py-3">Tidak ada data pendapatan</td>
                </tr>
              <?php endif; ?>
              <tr class="font-weight-bold bg-light">
                <td colspan="2" class="text-right">Total Pendapatan</td>
                <td class="text-right text-primary font-mono font-weight-bold" style="font-size: 1rem;">
                  Rp <?= number_format($data_lr['total_pendapatan'], 0, ',', '.') ?>
                </td>
              </tr>

              <!-- 2. BEBAN -->
              <tr class="table-danger font-weight-bold">
                <th colspan="2">BEBAN OPERASIONAL</th>
                <th class="text-right">Nominal (Rp)</th>
              </tr>
              <?php if (!empty($data_lr['beban'])) : ?>
                <?php foreach ($data_lr['beban'] as $b) : ?>
                  <tr>
                    <td class="text-center font-mono"><?= esc($b->kode_akun3) ?></td>
                    <td><?= esc($b->nama_akun3) ?></td>
                    <td class="text-right font-mono font-weight-bold text-white"><?= number_format($b->nominal, 0, ',', '.') ?></td>
                  </tr>
                <?php endforeach; ?>
              <?php else : ?>
                <tr>
                  <td colspan="3" class="text-center text-secondary font-italic py-3">Tidak ada data beban</td>
                </tr>
              <?php endif; ?>
              <tr class="font-weight-bold bg-light">
                <td colspan="2" class="text-right">Total Beban</td>
                <td class="text-right text-danger font-mono font-weight-bold" style="font-size: 1rem;">
                  Rp <?= number_format($data_lr['total_beban'], 0, ',', '.') ?>
                </td>
              </tr>

              <!-- 3. LABA / RUGI BERSIH -->
              <?php $isLaba = ($data_lr['laba_rugi_bersih'] >= 0); ?>
              <tr class="<?= $isLaba ? 'table-success' : 'table-warning' ?> font-weight-bold" style="font-size: 1.05rem;">
                <td colspan="2" class="text-uppercase text-right">
                  <?= $isLaba ? 'Laba Bersih Operasional' : 'Rugi Bersih Operasional' ?>
                </td>
                <td class="text-right <?= $isLaba ? 'text-success' : 'text-danger' ?> font-mono font-weight-bold" style="font-size: 1.15rem;">
                  Rp <?= number_format($data_lr['laba_rugi_bersih'], 0, ',', '.') ?>
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
