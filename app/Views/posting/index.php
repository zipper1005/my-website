<?= $this->extend('layout/backend') ?>

<?= $this->section('title') ?>
Posting Buku Besar &bull; SIA AKN-IPB
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<section class="section">
  <div class="page-header-box">
    <div>
      <h1 class="page-title-main">Posting Buku Besar</h1>
      <p class="page-subtitle">Rekapitulasi mutasi debit, kredit, dan saldo berjalan seluruh akun buku besar SAK EMKM</p>
    </div>
    <div class="page-actions-group">
      <?php if (!empty($kode_akun3)) : ?>
        <span class="badge badge-light border font-mono px-3 py-2">
          <i class="fas fa-tag text-success mr-1"></i> Akun: <b><?= esc($kode_akun3) ?></b>
        </span>
      <?php endif; ?>
    </div>
  </div>

  <div class="section-body">
    <!-- Filter Periode Tanggal & Akun -->
    <div class="card mb-4">
      <div class="card-body p-3">
        <form method="post" action="<?= site_url('posting') ?>">
          <?= csrf_field() ?>
          <div class="row align-items-end">
            <div class="col-md-3">
              <div class="form-group mb-0">
                <label class="small font-weight-bold text-secondary">Tanggal Awal</label>
                <input type="date" class="form-control" name="tgl_awal" value="<?= esc($tgl_awal) ?>">
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group mb-0">
                <label class="small font-weight-bold text-secondary">Tanggal Akhir</label>
                <input type="date" class="form-control" name="tgl_akhir" value="<?= esc($tgl_akhir) ?>">
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group mb-0">
                <label class="small font-weight-bold text-secondary">Pilih Kode Akun</label>
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
            <div class="col-md-3 mt-3 mt-md-0 d-flex">
              <button type="submit" class="btn btn-primary btn-sm px-3 mr-2 font-weight-bold shadow-sm">
                <i class="fas fa-filter mr-1"></i> Tampilkan
              </button>
              <button type="submit" formaction="<?= site_url('posting/cetakpostingpdf') ?>" formtarget="_blank" class="btn btn-outline-danger btn-sm px-3">
                <i class="fas fa-file-pdf mr-1"></i> Unduh PDF
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>

    <!-- Tabel Data Posting Buku Besar -->
    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <div>
          <h4 class="mb-0 font-weight-bold" style="color: var(--color-ink);">Buku Besar Keuangan (General Ledger)</h4>
          <small class="text-secondary">Detail pergerakan saldo per akun buku besar berpasangan</small>
        </div>
      </div>
      <div class="card-body p-4">
        <div class="table-responsive">
          <table class="table table-bordered table-hover table-md">
            <thead style="background: var(--color-surface-muted);">
              <tr class="text-center">
                <th rowspan="2" class="align-middle" style="width: 12%;">Tanggal</th>
                <th rowspan="2" class="align-middle" style="width: 28%; text-align: left;">Keterangan / Transaksi</th>
                <th rowspan="2" class="align-middle" style="width: 10%;">Ref</th>
                <th rowspan="2" class="align-middle text-right" style="width: 13%;">Debit</th>
                <th rowspan="2" class="align-middle text-right" style="width: 13%;">Kredit</th>
                <th colspan="2" class="text-center" style="width: 24%;">Saldo Berjalan</th>
              </tr>
              <tr class="text-center" style="background: #E8ECE8;">
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
                    <td class="text-center font-mono text-secondary"><?= date('d/m/Y', strtotime($value->tanggal)) ?></td>
                    <td>
                      <div class="font-weight-600 text-dark"><?= esc($value->deskripsi) ?></div>
                      <small class="text-muted"><i class="fas fa-tag mr-1 text-primary" style="font-size: 10px;"></i> <?= esc($value->nama_akun3) ?></small>
                    </td>
                    <td class="text-center font-mono text-secondary"><?= esc($value->kode_akun3) ?></td>
                    <td class="text-right font-mono font-weight-600"><?= $debit > 0 ? 'Rp ' . number_format($debit, 0, ',', '.') : '-' ?></td>
                    <td class="text-right font-mono font-weight-600"><?= $kredit > 0 ? 'Rp ' . number_format($kredit, 0, ',', '.') : '-' ?></td>
                    <td class="text-right font-mono font-weight-600 text-success"><?= $saldoDebit > 0 ? 'Rp ' . number_format($saldoDebit, 0, ',', '.') : '-' ?></td>
                    <td class="text-right font-mono font-weight-600 text-danger"><?= $saldoKredit > 0 ? 'Rp ' . number_format($saldoKredit, 0, ',', '.') : '-' ?></td>
                  </tr>
                <?php endforeach; ?>
              <?php else : ?>
                <tr>
                  <td colspan="7" class="text-center py-4 text-muted">Data Posting Buku Besar tidak ditemukan.</td>
                </tr>
              <?php endif; ?>
            </tbody>
            <tfoot>
              <tr class="font-weight-bold" style="background: var(--color-surface-muted);">
                <td colspan="3" class="text-right">Total Transaksi:</td>
                <td class="text-right font-mono font-weight-bold" style="color: var(--color-ink);">Rp <?= number_format($totalDebit, 0, ',', '.') ?></td>
                <td class="text-right font-mono font-weight-bold" style="color: var(--color-ink);">Rp <?= number_format($totalKredit, 0, ',', '.') ?></td>
                <td class="text-right font-mono font-weight-bold text-success"><?= $saldo >= 0 ? 'Rp ' . number_format($saldo, 0, ',', '.') : '-' ?></td>
                <td class="text-right font-mono font-weight-bold text-danger"><?= $saldo < 0 ? 'Rp ' . number_format(abs($saldo), 0, ',', '.') : '-' ?></td>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>

<?= $this->endSection() ?>
