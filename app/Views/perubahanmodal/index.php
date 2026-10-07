<?= $this->extend('layout/backend') ?>

<?= $this->section('title') ?>
Laporan Perubahan Modal &bull; SIA AKN-IPB
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<section class="section">
  <div class="section-header">
    <h1>Laporan Perubahan Modal</h1>
  </div>

  <div class="section-body">
    <!-- Filter Periode Tanggal -->
    <div class="card mb-4">
      <div class="card-body">
        <form method="get" action="<?= site_url('perubahanmodal') ?>">
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
              <button type="submit" formaction="<?= site_url('perubahanmodal/cetakperubahanmodalpdf') ?>" formtarget="_blank" class="btn btn-danger shadow-sm font-weight-bold">
                <i class="fas fa-file-pdf mr-1"></i> Cetak PDF
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>

    <!-- Tampilan Laporan Perubahan Modal -->
    <div class="card">
      <div class="card-header text-center d-block py-3">
        <h4 class="mb-1 text-white font-weight-bold" style="letter-spacing: -0.02em;">SIA AKN-IPB</h4>
        <h5 class="mb-1 text-primary font-weight-bold font-mono">LAPORAN PERUBAHAN EKUITAS (EQUITY STATEMENT)</h5>
        <small class="text-secondary font-mono">
          Periode: <?= (!empty($tgl_awal) && !empty($tgl_akhir)) ? date('d F Y', strtotime($tgl_awal)) . ' s/d ' . date('d F Y', strtotime($tgl_akhir)) : 'Semua Periode' ?>
        </small>
      </div>
      <div class="card-body p-4">
        <div class="table-responsive">
          <table class="table table-bordered table-md">
            <tbody>
              <tr>
                <td style="width: 70%;" class="font-weight-bold text-white">Modal Awal Pemilik</td>
                <td class="text-right font-weight-bold text-white font-mono" style="width: 30%;">
                  Rp <?= number_format($data_pm['modal_awal'], 0, ',', '.') ?>
                </td>
              </tr>
              <tr>
                <td class="pl-4 text-secondary">Laba Bersih Periode Berjalan</td>
                <td class="text-right text-success font-mono font-weight-bold">
                  Rp <?= number_format($data_pm['laba_bersih'], 0, ',', '.') ?>
                </td>
              </tr>
              <tr>
                <td class="pl-4 text-secondary">Pengambilan Pribadi (Prive)</td>
                <td class="text-right text-danger font-mono font-weight-bold">
                  (Rp <?= number_format($data_pm['prive'], 0, ',', '.') ?>)
                </td>
              </tr>
              <tr class="table-info font-weight-bold">
                <td>Penambahan / (Pengurangan) Modal</td>
                <td class="text-right text-primary font-mono font-weight-bold">
                  Rp <?= number_format($data_pm['penambahan_modal'], 0, ',', '.') ?>
                </td>
              </tr>
              <tr class="table-primary font-weight-bold" style="font-size: 1.05rem;">
                <td class="text-uppercase">Modal Akhir Pemilik</td>
                <td class="text-right text-primary font-mono font-weight-bold" style="font-size: 1.15rem;">
                  Rp <?= number_format($data_pm['modal_akhir'], 0, ',', '.') ?>
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
