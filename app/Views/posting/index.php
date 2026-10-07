<?= $this->extend('layout/backend') ?>

<?= $this->section('title') ?>
Posting Buku Besar
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<section class="section">
  <div class="section-header">
    <h1>Posting Buku Besar</h1>
  </div>

  <div class="section-body">
    <!-- Filter Periode Tanggal & Akun -->
    <div class="card mb-4">
      <div class="card-body">
        <form method="post" action="<?= site_url('posting') ?>">
          <?= csrf_field() ?>
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
            <div class="col-md-3">
              <div class="form-group mb-0">
                <label>Pilih Kode Akun</label>
                <select name="kode_akun3" class="form-control">
                  <option value="">-- Semua Akun --</option>
                  <?php if (!empty($dtakun3)) : ?>
                    <?php foreach ($dtakun3 as $akun) : ?>
                      <option value="<?= $akun->kode_akun3 ?>" <?= $akun->kode_akun3 == $kode_akun3 ? 'selected' : '' ?>>
                        <?= $akun->kode_akun3 ?> - <?= $akun->nama_akun3 ?>
                      </option>
                    <?php endforeach; ?>
                  <?php endif; ?>
                </select>
              </div>
            </div>
            <div class="col-md-3 mt-3 mt-md-0">
              <button type="submit" class="btn btn-primary mr-1">
                <i class="fas fa-filter"></i> Tampilkan
              </button>
              <button type="submit" formaction="<?= site_url('posting/cetakpostingpdf') ?>" formtarget="_blank" class="btn btn-danger">
                <i class="fas fa-file-pdf"></i> Cetak PDF
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>

    <!-- Tabel Data Posting Buku Besar -->
    <div class="card">
      <div class="card-header d-flex justify-content-between">
        <h4>Buku Besar (Ledger)</h4>
        <?php if (!empty($kode_akun3)) : ?>
          <span class="badge badge-primary">Filter Akun: <?= esc($kode_akun3) ?></span>
        <?php endif; ?>
      </div>
      <div class="card-body p-4">
        <div class="table-responsive">
          <table class="table table-bordered table-striped table-md">
            <thead>
              <tr class="bg-light text-center">
                <th rowspan="2" class="align-middle" style="width: 12%;">Tanggal</th>
                <th rowspan="2" class="align-middle" style="width: 28%;">Keterangan</th>
                <th rowspan="2" class="align-middle" style="width: 10%;">Ref</th>
                <th rowspan="2" class="align-middle text-right" style="width: 13%;">Debit</th>
                <th rowspan="2" class="align-middle text-right" style="width: 13%;">Kredit</th>
                <th colspan="2" class="text-center" style="width: 24%;">Saldo</th>
              </tr>
              <tr class="bg-light text-center">
                <th class="text-right" style="width: 12%;">Debit</th>
                <th class="text-right" style="width: 12%;">Kredit</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $saldo = 0;
              $totalDebit = 0;
              $totalKredit = 0;
              ?>
              <?php if (!empty($dtposting)) : ?>
                <?php foreach ($dtposting as $key => $value) : ?>
                  <?php
                  $debit  = (float)$value->debit;
                  $kredit = (float)$value->kredit;
                  $totalDebit  += $debit;
                  $totalKredit += $kredit;

                  $saldo += ($debit - $kredit);
                  $saldoDebit  = ($saldo >= 0) ? $saldo : 0;
                  $saldoKredit = ($saldo < 0) ? abs($saldo) : 0;
                  ?>
                  <tr>
                    <td class="text-center font-mono"><?= date('d/m/Y', strtotime($value->tanggal)) ?></td>
                    <td><?= esc($value->deskripsi) ?> (<?= esc($value->nama_akun3) ?>)</td>
                    <td class="text-center font-mono"><?= esc($value->kode_akun3) ?></td>
                    <td class="text-right font-mono"><?= $debit > 0 ? 'Rp ' . number_format($debit, 0, ',', '.') : '-' ?></td>
                    <td class="text-right font-mono"><?= $kredit > 0 ? 'Rp ' . number_format($kredit, 0, ',', '.') : '-' ?></td>
                    <td class="text-right font-mono"><?= $saldoDebit > 0 ? 'Rp ' . number_format($saldoDebit, 0, ',', '.') : '-' ?></td>
                    <td class="text-right font-mono"><?= $saldoKredit > 0 ? 'Rp ' . number_format($saldoKredit, 0, ',', '.') : '-' ?></td>
                  </tr>
                <?php endforeach; ?>
              <?php else : ?>
                <tr>
                  <td colspan="7" class="text-center py-4 text-muted">Data Posting tidak ditemukan.</td>
                </tr>
              <?php endif; ?>
            </tbody>
            <tfoot>
              <tr class="font-weight-bold bg-light">
                <td colspan="3" class="text-right">Total Transaksi:</td>
                <td class="text-right font-mono">Rp <?= number_format($totalDebit, 0, ',', '.') ?></td>
                <td class="text-right font-mono">Rp <?= number_format($totalKredit, 0, ',', '.') ?></td>
                <td class="text-right font-mono"><?= $saldo >= 0 ? 'Rp ' . number_format($saldo, 0, ',', '.') : '-' ?></td>
                <td class="text-right font-mono"><?= $saldo < 0 ? 'Rp ' . number_format(abs($saldo), 0, ',', '.') : '-' ?></td>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>

<?= $this->endSection() ?>
