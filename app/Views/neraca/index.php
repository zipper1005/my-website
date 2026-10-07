<?= $this->extend('layout/backend') ?>

<?= $this->section('title') ?>
Laporan Neraca &bull; SIA AKN-IPB
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<section class="section">
  <div class="section-header">
    <h1>Laporan Neraca</h1>
  </div>

  <div class="section-body">
    <!-- Filter Periode Tanggal -->
    <div class="card mb-4">
      <div class="card-body">
        <form method="get" action="<?= site_url('neraca') ?>">
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
              <button type="submit" formaction="<?= site_url('neraca/cetakneracapdf') ?>" formtarget="_blank" class="btn btn-danger shadow-sm font-weight-bold">
                <i class="fas fa-file-pdf mr-1"></i> Cetak PDF
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>

    <!-- Tampilan Laporan Neraca (Bentuk Skontro / 2 Kolom atau Stafel) -->
    <div class="card">
      <div class="card-header text-center d-block py-3">
        <h4 class="mb-1 text-white font-weight-bold" style="letter-spacing: -0.02em;">SIA AKN-IPB</h4>
        <h5 class="mb-1 text-primary font-weight-bold font-mono">LAPORAN NERACA (BALANCE SHEET)</h5>
        <small class="text-secondary font-mono">
          Per <?= (!empty($tgl_akhir)) ? date('d F Y', strtotime($tgl_akhir)) : date('d F Y') ?>
        </small>
      </div>
      <div class="card-body p-4">
        <div class="row">
          <!-- KOLOM KIRI: AKTIVA -->
          <div class="col-md-6">
            <div class="table-responsive">
              <table class="table table-bordered table-md">
                <thead>
                  <tr class="table-primary text-center">
                    <th colspan="2">AKTIVA (ASET)</th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="bg-light font-weight-bold">
                    <td colspan="2">Aktiva Lancar</td>
                  </tr>
                  <?php if (!empty($data_neraca['aktiva_lancar'])) : ?>
                    <?php foreach ($data_neraca['aktiva_lancar'] as $al) : ?>
                      <tr>
                        <td><?= esc($al->nama_akun3) ?></td>
                        <td class="text-right font-mono text-white"><?= number_format($al->nominal, 0, ',', '.') ?></td>
                      </tr>
                    <?php endforeach; ?>
                  <?php endif; ?>
                  <tr class="font-weight-bold">
                    <td class="text-right">Total Aktiva Lancar</td>
                    <td class="text-right text-primary font-mono font-weight-bold">Rp <?= number_format($data_neraca['total_aktiva_lancar'], 0, ',', '.') ?></td>
                  </tr>

                  <tr class="bg-light font-weight-bold">
                    <td colspan="2">Aktiva Tetap</td>
                  </tr>
                  <?php if (!empty($data_neraca['aktiva_tetap'])) : ?>
                    <?php foreach ($data_neraca['aktiva_tetap'] as $at) : ?>
                      <tr>
                        <td><?= esc($at->nama_akun3) ?></td>
                        <td class="text-right font-mono text-white"><?= number_format($at->nominal, 0, ',', '.') ?></td>
                      </tr>
                    <?php endforeach; ?>
                  <?php endif; ?>
                  <tr class="font-weight-bold">
                    <td class="text-right">Total Aktiva Tetap</td>
                    <td class="text-right text-primary font-mono font-weight-bold">Rp <?= number_format($data_neraca['total_aktiva_tetap'], 0, ',', '.') ?></td>
                  </tr>

                  <tr class="table-success font-weight-bold" style="font-size: 1.05rem;">
                    <td class="text-uppercase text-right">TOTAL AKTIVA</td>
                    <td class="text-right text-success font-mono font-weight-bold">
                      Rp <?= number_format($data_neraca['total_aktiva'], 0, ',', '.') ?>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

          <!-- KOLOM KANAN: PASIVA (KEWAJIBAN & EKUITAS) -->
          <div class="col-md-6">
            <div class="table-responsive">
              <table class="table table-bordered table-md">
                <thead>
                  <tr class="table-primary text-center">
                    <th colspan="2">PASIVA (KEWAJIBAN & MODAL)</th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="bg-light font-weight-bold">
                    <td colspan="2">Kewajiban Jangka Pendek</td>
                  </tr>
                  <?php if (!empty($data_neraca['kewajiban_pendek'])) : ?>
                    <?php foreach ($data_neraca['kewajiban_pendek'] as $kp) : ?>
                      <tr>
                        <td><?= esc($kp->nama_akun3) ?></td>
                        <td class="text-right font-mono text-white"><?= number_format($kp->nominal, 0, ',', '.') ?></td>
                      </tr>
                    <?php endforeach; ?>
                  <?php else : ?>
                    <tr>
                      <td colspan="2" class="text-center text-secondary py-2">- Tidak ada utang jangka pendek -</td>
                    </tr>
                  <?php endif; ?>

                  <?php if (!empty($data_neraca['kewajiban_panjang'])) : ?>
                    <tr class="bg-light font-weight-bold">
                      <td colspan="2">Kewajiban Jangka Panjang</td>
                    </tr>
                    <?php foreach ($data_neraca['kewajiban_panjang'] as $kpj) : ?>
                      <tr>
                        <td><?= esc($kpj->nama_akun3) ?></td>
                        <td class="text-right font-mono text-white"><?= number_format($kpj->nominal, 0, ',', '.') ?></td>
                      </tr>
                    <?php endforeach; ?>
                  <?php endif; ?>

                  <tr class="font-weight-bold">
                    <td class="text-right">Total Kewajiban</td>
                    <td class="text-right text-danger font-mono font-weight-bold">Rp <?= number_format($data_neraca['total_kewajiban'], 0, ',', '.') ?></td>
                  </tr>

                  <tr class="bg-light font-weight-bold">
                    <td colspan="2">Ekuitas / Modal</td>
                  </tr>
                  <tr>
                    <td>Modal Akhir Pemilik</td>
                    <td class="text-right font-mono text-white"><?= number_format($data_neraca['modal_akhir'], 0, ',', '.') ?></td>
                  </tr>
                  <tr class="font-weight-bold">
                    <td class="text-right">Total Ekuitas</td>
                    <td class="text-right text-primary font-mono font-weight-bold">Rp <?= number_format($data_neraca['modal_akhir'], 0, ',', '.') ?></td>
                  </tr>

                  <tr class="table-success font-weight-bold" style="font-size: 1.05rem;">
                    <td class="text-uppercase text-right">TOTAL PASIVA</td>
                    <td class="text-right text-success font-mono font-weight-bold">
                      Rp <?= number_format($data_neraca['total_pasiva'], 0, ',', '.') ?>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <?php if ($data_neraca['total_aktiva'] == $data_neraca['total_pasiva']) : ?>
          <div class="alert alert-success text-center mt-3 font-weight-bold mb-0">
            <i class="fas fa-check-circle mr-2"></i> Laporan Neraca Seimbang (Balance): Total Aktiva Rp <?= number_format($data_neraca['total_aktiva'], 0, ',', '.') ?> = Total Pasiva Rp <?= number_format($data_neraca['total_pasiva'], 0, ',', '.') ?>
          </div>
        <?php else : ?>
          <div class="alert alert-warning text-center mt-3 font-weight-bold mb-0">
            <i class="fas fa-exclamation-triangle mr-2"></i> Perhatian: Neraca belum seimbang! Selisih: Rp <?= number_format(abs($data_neraca['total_aktiva'] - $data_neraca['total_pasiva']), 0, ',', '.') ?>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>

<?= $this->endSection() ?>
