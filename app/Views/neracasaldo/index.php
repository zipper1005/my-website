<?= $this->extend('layout/backend') ?>

<?= $this->section('title') ?>
Neraca Saldo
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<section class="section">
  <div class="section-header">
    <h1>Neraca Saldo</h1>
  </div>

  <div class="section-body">
    <!-- Filter Periode Tanggal -->
    <div class="card mb-4">
      <div class="card-body">
        <form method="get" action="<?= site_url('neracasaldo') ?>">
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
              <button type="submit" formaction="<?= site_url('neracasaldo/cetakneracasaldopdf') ?>" formtarget="_blank" class="btn btn-danger">
                <i class="fas fa-file-pdf"></i> Cetak PDF
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>

    <!-- Tabel Data Neraca Saldo -->
    <div class="card">
      <div class="card-header d-flex justify-content-between">
        <h4>Laporan Neraca Saldo</h4>
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
                <th style="width: 15%;">Kode Akun</th>
                <th style="width: 40%;">Keterangan / Nama Akun</th>
                <th style="width: 20%;">Debit</th>
                <th style="width: 20%;">Kredit</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $total_debit  = 0;
              $total_kredit = 0;
              ?>
              <?php if (!empty($dttransaksi)) : ?>
                <?php foreach ($dttransaksi as $key => $value) : ?>
                  <?php
                  $d = (float)$value->debit;
                  $k = (float)$value->kredit;
                  $neraca = $d - $k;

                  if ($neraca > 0) {
                      $debit_new  = $neraca;
                      $kredit_new = 0;
                      $total_debit += $debit_new;
                  } else {
                      $debit_new  = 0;
                      $kredit_new = abs($neraca);
                      $total_kredit += $kredit_new;
                  }
                  ?>
                  <tr>
                    <td class="text-center"><?= $key + 1 ?></td>
                    <td class="text-center font-mono"><?= esc($value->kode_akun3) ?></td>
                    <td><?= esc($value->nama_akun3) ?></td>
                    <td class="text-right font-mono"><?= $debit_new > 0 ? number_format($debit_new, 0, ',', '.') : '-' ?></td>
                    <td class="text-right font-mono"><?= $kredit_new > 0 ? number_format($kredit_new, 0, ',', '.') : '-' ?></td>
                  </tr>
                <?php endforeach; ?>
              <?php else : ?>
                <tr>
                  <td colspan="5" class="text-center text-muted py-4">Data transaksi tidak ditemukan untuk periode ini.</td>
                </tr>
              <?php endif; ?>
            </tbody>
            <tfoot>
              <tr class="bg-light font-weight-bold">
                <td colspan="3" class="text-center">Total</td>
                <td class="text-right font-mono">Rp <?= number_format($total_debit, 0, ',', '.') ?></td>
                <td class="text-right font-mono">Rp <?= number_format($total_kredit, 0, ',', '.') ?></td>
              </tr>
              <tr>
                <td colspan="3" class="text-right font-weight-bold">Status:</td>
                <td colspan="2" class="text-center">
                  <?php if ($total_debit == $total_kredit && $total_debit > 0) : ?>
                    <span class="badge badge-success px-3 py-2"><i class="fas fa-check-circle"></i> SEIMBANG (BALANCE)</span>
                  <?php elseif ($total_debit == 0 && $total_kredit == 0) : ?>
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
