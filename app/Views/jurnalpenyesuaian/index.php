<?= $this->extend('layout/backend') ?>

<?= $this->section('title') ?>
Jurnal Penyesuaian
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<section class="section">
  <div class="section-header">
    <h1>Jurnal Penyesuaian</h1>
  </div>

  <div class="section-body">
    <!-- Filter Periode Tanggal -->
    <div class="card mb-4">
      <div class="card-body">
        <form method="get" action="<?= site_url('jurnalpenyesuaian') ?>">
          <div class="row align-items-end">
            <div class="col-md-3">
              <div class="form-group mb-0">
                <label>Tanggal Awal</label>
                <input type="date" class="form-control" name="tgl_awal" value="<?= esc($tgl_awal) ?>">
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group mb-0">
                <label>Tanggal Akhir</label>
                <input type="date" class="form-control" name="tgl_akhir" value="<?= esc($tgl_akhir) ?>">
              </div>
            </div>
            <div class="col-md-6 mt-3 mt-md-0">
              <button type="submit" class="btn btn-primary mr-2">
                <i class="fas fa-filter"></i> Tampilkan
              </button>
              <button type="submit" formaction="<?= site_url('jurnalpenyesuaian/cetakjurnalpdf') ?>" formtarget="_blank" class="btn btn-danger">
                <i class="fas fa-file-pdf"></i> Cetak PDF
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>

    <!-- Tabel Data Jurnal Penyesuaian -->
    <div class="card">
      <div class="card-header d-flex justify-content-between">
        <h4>Laporan Jurnal Penyesuaian</h4>
        <?php if (!empty($tgl_awal) && !empty($tgl_akhir)) : ?>
          <span class="badge badge-info">Periode: <?= date('d/m/Y', strtotime($tgl_awal)) ?> s/d <?= date('d/m/Y', strtotime($tgl_akhir)) ?></span>
        <?php endif; ?>
      </div>
      <div class="card-body p-4">
        <div class="table-responsive">
          <table class="table table-bordered table-striped table-md">
            <thead>
              <tr class="bg-light text-center">
                <th style="width: 5%;">No</th>
                <th style="width: 12%;">Tanggal</th>
                <th style="width: 12%;">Kode Akun</th>
                <th style="width: 25%;">Nama Akun</th>
                <th style="width: 26%;">Deskripsi Penyesuaian</th>
                <th style="width: 10%;">Debit</th>
                <th style="width: 10%;">Kredit</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $totalDebit  = 0;
              $totalKredit = 0;
              ?>
              <?php if (!empty($dtpenyesuaian)) : ?>
                <?php foreach ($dtpenyesuaian as $key => $value) : ?>
                  <?php
                  $totalDebit  += (float)$value->jumdebit;
                  $totalKredit += (float)$value->jumkredit;
                  ?>
                  <tr>
                    <td class="text-center"><?= $key + 1 ?></td>
                    <td class="text-center"><?= date('d/m/Y', strtotime($value->tanggal)) ?></td>
                    <td class="text-center"><?= esc($value->kode_akun3) ?></td>
                    <td>
                      <?php if ($value->jumdebit > 0) : ?>
                        <?= esc($value->nama_akun3) ?>
                      <?php else : ?>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= esc($value->nama_akun3) ?>
                      <?php endif; ?>
                    </td>
                    <td><?= esc($value->deskripsi) ?></td>
                    <td class="text-right"><?= $value->jumdebit > 0 ? number_format((float)$value->jumdebit, 0, ',', '.') : '-' ?></td>
                    <td class="text-right"><?= $value->jumkredit > 0 ? number_format((float)$value->jumkredit, 0, ',', '.') : '-' ?></td>
                  </tr>
                <?php endforeach; ?>
              <?php else : ?>
                <tr>
                  <td colspan="7" class="text-center text-muted py-4">Data penyesuaian tidak ditemukan untuk periode ini.</td>
                </tr>
              <?php endif; ?>
            </tbody>
            <tfoot>
              <tr class="bg-light font-weight-bold">
                <td colspan="5" class="text-right">Total:</td>
                <td class="text-right">Rp <?= number_format($totalDebit, 0, ',', '.') ?></td>
                <td class="text-right">Rp <?= number_format($totalKredit, 0, ',', '.') ?></td>
              </tr>
              <tr>
                <td colspan="5" class="text-right font-weight-bold">Status:</td>
                <td colspan="2" class="text-center">
                  <?php if ($totalDebit == $totalKredit && $totalDebit > 0) : ?>
                    <span class="badge badge-success px-3 py-2"><i class="fas fa-check-circle"></i> SEIMBANG (BALANCE)</span>
                  <?php elseif ($totalDebit == 0 && $totalKredit == 0) : ?>
                    <span class="badge badge-secondary px-3 py-2">KOSONG</span>
                  <?php else : ?>
                    <span class="badge badge-danger px-3 py-2"><i class="fas fa-times-circle"></i> TIDAK SEIMBANG</span>
                  <?php endif; ?>
                </td>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>

<?= $this->endSection() ?>
