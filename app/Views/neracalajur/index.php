<?= $this->extend('layout/backend') ?>

<?= $this->section('title') ?>
Neraca Lajur (Worksheet)
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<section class="section">
  <div class="section-header">
    <h1>Neraca Lajur (Worksheet 10 Kolom)</h1>
  </div>

  <div class="section-body">
    <!-- Filter Periode Tanggal -->
    <div class="card mb-4">
      <div class="card-body">
        <form method="get" action="<?= site_url('neracalajur') ?>">
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
              <button type="submit" formaction="<?= site_url('neracalajur/cetaklajurpdf') ?>" formtarget="_blank" class="btn btn-danger">
                <i class="fas fa-file-pdf"></i> Cetak PDF
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>

    <!-- Tabel Data Neraca Lajur -->
    <div class="card">
      <div class="card-header d-flex justify-content-between">
        <h4>Kertas Kerja / Neraca Lajur 10 Kolom</h4>
        <?php if (!empty($tgl_awal) && !empty($tgl_akhir)) : ?>
          <span class="badge badge-info">Periode: <?= date('d/m/Y', strtotime($tgl_awal)) ?> s/d <?= date('d/m/Y', strtotime($tgl_akhir)) ?></span>
        <?php endif; ?>
      </div>
      <div class="card-body p-3">
        <div class="table-responsive">
          <table class="table table-bordered table-striped table-hover table-sm">
            <thead class="bg-light text-center">
              <tr>
                <th rowspan="2" class="align-middle" style="width: 3%;">No</th>
                <th rowspan="2" class="align-middle" style="width: 8%;">Kode Akun</th>
                <th rowspan="2" class="align-middle" style="width: 17%;">Nama Akun</th>
                <th colspan="2" class="text-center">Neraca Saldo</th>
                <th colspan="2" class="text-center">Penyesuaian</th>
                <th colspan="2" class="text-center">NS Disesuaikan</th>
                <th colspan="2" class="text-center">Laba / Rugi</th>
                <th colspan="2" class="text-center">Neraca</th>
              </tr>
              <tr>
                <th style="width: 7%;">Debit</th>
                <th style="width: 7%;">Kredit</th>
                <th style="width: 7%;">Debit</th>
                <th style="width: 7%;">Kredit</th>
                <th style="width: 7%;">Debit</th>
                <th style="width: 7%;">Kredit</th>
                <th style="width: 7%;">Debit</th>
                <th style="width: 7%;">Kredit</th>
                <th style="width: 7%;">Debit</th>
                <th style="width: 7%;">Kredit</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $tot_debit_ns   = 0;
              $tot_kredit_ns  = 0;
              $tot_debit_ajp  = 0;
              $tot_kredit_ajp = 0;
              $tot_debit_nsd  = 0;
              $tot_kredit_nsd = 0;
              $tot_debit_lr   = 0;
              $tot_kredit_lr  = 0;
              $tot_debit_nrc  = 0;
              $tot_kredit_nrc = 0;
              ?>
              <?php if (!empty($dttransaksi)) : ?>
                <?php foreach ($dttransaksi as $key => $value) : ?>
                  <?php
                  // 1. Neraca Saldo
                  $d_ns = (float)$value->jumdebit;
                  $k_ns = (float)$value->jumkredit;
                  $ns = $d_ns - $k_ns;
                  if ($ns > 0) {
                      $debit_ns = $ns;
                      $kredit_ns = 0;
                  } else {
                      $debit_ns = 0;
                      $kredit_ns = abs($ns);
                  }
                  $tot_debit_ns += $debit_ns;
                  $tot_kredit_ns += $kredit_ns;

                  // 2. Penyesuaian (AJP)
                  $d_ajp = (float)$value->jumdebits;
                  $k_ajp = (float)$value->jumkredits;
                  $ajp = $d_ajp - $k_ajp;
                  if ($ajp > 0) {
                      $debit_ajp = $ajp;
                      $kredit_ajp = 0;
                  } else {
                      $debit_ajp = 0;
                      $kredit_ajp = abs($ajp);
                  }
                  $tot_debit_ajp += $debit_ajp;
                  $tot_kredit_ajp += $kredit_ajp;

                  // 3. Neraca Saldo Disesuaikan (NSD)
                  $nsd = ($debit_ns - $kredit_ns) + ($debit_ajp - $kredit_ajp);
                  if ($nsd > 0) {
                      $debit_nsd = $nsd;
                      $kredit_nsd = 0;
                  } else {
                      $debit_nsd = 0;
                      $kredit_nsd = abs($nsd);
                  }
                  $tot_debit_nsd += $debit_nsd;
                  $tot_kredit_nsd += $kredit_nsd;

                  // 4. Laba / Rugi vs Neraca
                  $first_digit = substr($value->kode_akun3, 0, 1);
                  if ($first_digit >= '4') {
                      $debit_lr  = $debit_nsd;
                      $kredit_lr = $kredit_nsd;
                      $debit_nrc = 0;
                      $kredit_nrc = 0;
                  } else {
                      $debit_lr  = 0;
                      $kredit_lr = 0;
                      $debit_nrc = $debit_nsd;
                      $kredit_nrc = $kredit_nsd;
                  }
                  $tot_debit_lr  += $debit_lr;
                  $tot_kredit_lr += $kredit_lr;
                  $tot_debit_nrc += $debit_nrc;
                  $tot_kredit_nrc += $kredit_nrc;
                  ?>
                  <tr>
                    <td class="text-center"><?= $key + 1 ?></td>
                    <td class="text-center font-mono"><?= esc($value->kode_akun3) ?></td>
                    <td><?= esc($value->nama_akun3) ?></td>
                    
                    <!-- Neraca Saldo -->
                    <td class="text-right font-mono"><?= $debit_ns > 0 ? number_format($debit_ns, 0, ',', '.') : '-' ?></td>
                    <td class="text-right font-mono"><?= $kredit_ns > 0 ? number_format($kredit_ns, 0, ',', '.') : '-' ?></td>

                    <!-- Penyesuaian -->
                    <td class="text-right font-mono"><?= $debit_ajp > 0 ? number_format($debit_ajp, 0, ',', '.') : '-' ?></td>
                    <td class="text-right font-mono"><?= $kredit_ajp > 0 ? number_format($kredit_ajp, 0, ',', '.') : '-' ?></td>

                    <!-- NSD -->
                    <td class="text-right font-mono"><?= $debit_nsd > 0 ? number_format($debit_nsd, 0, ',', '.') : '-' ?></td>
                    <td class="text-right font-mono"><?= $kredit_nsd > 0 ? number_format($kredit_nsd, 0, ',', '.') : '-' ?></td>

                    <!-- Laba Rugi -->
                    <td class="text-right font-mono"><?= $debit_lr > 0 ? number_format($debit_lr, 0, ',', '.') : '-' ?></td>
                    <td class="text-right font-mono"><?= $kredit_lr > 0 ? number_format($kredit_lr, 0, ',', '.') : '-' ?></td>

                    <!-- Neraca -->
                    <td class="text-right font-mono"><?= $debit_nrc > 0 ? number_format($debit_nrc, 0, ',', '.') : '-' ?></td>
                    <td class="text-right font-mono"><?= $kredit_nrc > 0 ? number_format($kredit_nrc, 0, ',', '.') : '-' ?></td>
                  </tr>
                <?php endforeach; ?>
              <?php else : ?>
                <tr>
                  <td colspan="13" class="text-center text-muted py-4">Data transaksi tidak ditemukan untuk periode ini.</td>
                </tr>
              <?php endif; ?>
            </tbody>
            <tfoot>
              <!-- Baris Total Saldo Sebelum Laba Bersih -->
              <tr class="bg-light font-weight-bold">
                <td colspan="3" class="text-center">Total Saldo</td>
                <td class="text-right font-mono"><?= number_format($tot_debit_ns, 0, ',', '.') ?></td>
                <td class="text-right font-mono"><?= number_format($tot_kredit_ns, 0, ',', '.') ?></td>
                <td class="text-right font-mono"><?= number_format($tot_debit_ajp, 0, ',', '.') ?></td>
                <td class="text-right font-mono"><?= number_format($tot_kredit_ajp, 0, ',', '.') ?></td>
                <td class="text-right font-mono"><?= number_format($tot_debit_nsd, 0, ',', '.') ?></td>
                <td class="text-right font-mono"><?= number_format($tot_kredit_nsd, 0, ',', '.') ?></td>
                <td class="text-right font-mono"><?= number_format($tot_debit_lr, 0, ',', '.') ?></td>
                <td class="text-right font-mono"><?= number_format($tot_kredit_lr, 0, ',', '.') ?></td>
                <td class="text-right font-mono"><?= number_format($tot_debit_nrc, 0, ',', '.') ?></td>
                <td class="text-right font-mono"><?= number_format($tot_kredit_nrc, 0, ',', '.') ?></td>
              </tr>

              <?php
              $laba_bersih = $tot_kredit_lr - $tot_debit_lr;
              $is_laba     = ($laba_bersih >= 0);
              $nominal_lr  = abs($laba_bersih);

              // Penyeimbang baris Laba Bersih
              $lr_debit_bal   = $is_laba ? $nominal_lr : 0;
              $lr_kredit_bal  = $is_laba ? 0 : $nominal_lr;
              $nrc_debit_bal  = $is_laba ? 0 : $nominal_lr;
              $nrc_kredit_bal = $is_laba ? $nominal_lr : 0;

              // Total Akhir Seimbang
              $akhir_debit_lr   = $tot_debit_lr + $lr_debit_bal;
              $akhir_kredit_lr  = $tot_kredit_lr + $lr_kredit_bal;
              $akhir_debit_nrc  = $tot_debit_nrc + $nrc_debit_bal;
              $akhir_kredit_nrc = $tot_kredit_nrc + $nrc_kredit_bal;
              ?>

              <!-- Baris Laba / Rugi Bersih -->
              <tr class="font-weight-bold table-info">
                <td colspan="3" class="text-center">
                  <?= $is_laba ? '<i class="fas fa-arrow-trend-up text-success mr-1"></i> Laba Bersih' : '<i class="fas fa-arrow-trend-down text-danger mr-1"></i> Rugi Bersih' ?>
                </td>
                <td class="text-right font-mono">-</td>
                <td class="text-right font-mono">-</td>
                <td class="text-right font-mono">-</td>
                <td class="text-right font-mono">-</td>
                <td class="text-right font-mono">-</td>
                <td class="text-right font-mono">-</td>
                <td class="text-right font-mono"><?= $lr_debit_bal > 0 ? number_format($lr_debit_bal, 0, ',', '.') : '-' ?></td>
                <td class="text-right font-mono"><?= $lr_kredit_bal > 0 ? number_format($lr_kredit_bal, 0, ',', '.') : '-' ?></td>
                <td class="text-right font-mono"><?= $nrc_debit_bal > 0 ? number_format($nrc_debit_bal, 0, ',', '.') : '-' ?></td>
                <td class="text-right font-mono"><?= $nrc_kredit_bal > 0 ? number_format($nrc_kredit_bal, 0, ',', '.') : '-' ?></td>
              </tr>

              <!-- Baris Total Akhir Seimbang -->
              <tr class="table-primary font-weight-bold">
                <td colspan="3" class="text-center"><i class="fas fa-check-circle text-success mr-1"></i> Total Akhir Seimbang</td>
                <td class="text-right font-mono"><?= number_format($tot_debit_ns, 0, ',', '.') ?></td>
                <td class="text-right font-mono"><?= number_format($tot_kredit_ns, 0, ',', '.') ?></td>
                <td class="text-right font-mono"><?= number_format($tot_debit_ajp, 0, ',', '.') ?></td>
                <td class="text-right font-mono"><?= number_format($tot_kredit_ajp, 0, ',', '.') ?></td>
                <td class="text-right font-mono"><?= number_format($tot_debit_nsd, 0, ',', '.') ?></td>
                <td class="text-right font-mono"><?= number_format($tot_kredit_nsd, 0, ',', '.') ?></td>
                <td class="text-right font-mono"><?= number_format($akhir_debit_lr, 0, ',', '.') ?></td>
                <td class="text-right font-mono"><?= number_format($akhir_kredit_lr, 0, ',', '.') ?></td>
                <td class="text-right font-mono"><?= number_format($akhir_debit_nrc, 0, ',', '.') ?></td>
                <td class="text-right font-mono"><?= number_format($akhir_kredit_nrc, 0, ',', '.') ?></td>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>

<?= $this->endSection() ?>
