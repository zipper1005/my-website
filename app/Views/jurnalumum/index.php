<?= $this->extend('layout/backend') ?>

<?= $this->section('title') ?>
Buku Jurnal Umum &bull; SIA AKN-IPB
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<section class="section">
  <div class="page-header-box">
    <div>
      <h1 class="page-title-main">Buku Jurnal Umum</h1>
      <p class="page-subtitle">Pencatatan kronologis seluruh transaksi debit dan kredit sesuai standar akuntansi berpasangan SAK EMKM</p>
    </div>
    <div class="page-actions-group">
      <?php if (!empty($tgl_awal) && !empty($tgl_akhir)) : ?>
        <span class="badge badge-light border font-mono px-3 py-2">
          <i class="far fa-calendar-alt text-success mr-1"></i> <?= date('d/m/Y', strtotime($tgl_awal)) ?> &ndash; <?= date('d/m/Y', strtotime($tgl_akhir)) ?>
        </span>
      <?php endif; ?>
    </div>
  </div>

  <div class="section-body">
    <!-- Filter Periode Tanggal -->
    <div class="card mb-4">
      <div class="card-body p-3">
        <form method="post" action="<?= site_url('jurnalumum') ?>">
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
            <div class="col-md-6 mt-3 mt-md-0 d-flex">
              <button type="submit" class="btn btn-primary btn-sm px-3 mr-2 font-weight-bold shadow-sm">
                <i class="fas fa-filter mr-1"></i> Tampilkan
              </button>
              <button type="submit" formaction="<?= site_url('jurnalumum/cetakjurnalpdf') ?>" formtarget="_blank" class="btn btn-outline-danger btn-sm px-3">
                <i class="fas fa-file-pdf mr-1"></i> Unduh PDF
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>

    <!-- Tabel Data Jurnal Umum -->
    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <div>
          <h4 class="mb-0 font-weight-bold" style="color: var(--color-ink);">Entri Jurnal Umum Keuangan</h4>
          <small class="text-secondary">Daftar entri jurnal otomatis dari verifikasi voucher transaksi</small>
        </div>
      </div>
      <div class="card-body p-4">
        <div class="table-responsive">
          <table class="table table-bordered table-hover table-md">
            <thead style="background: var(--color-surface-muted);">
              <tr class="text-center">
                <th style="width: 15%;">Tanggal</th>
                <th style="width: 35%; text-align: left;">Keterangan / Nama Akun</th>
                <th style="width: 15%;">Ref</th>
                <th class="text-right" style="width: 17%;">Debit</th>
                <th class="text-right" style="width: 18%;">Kredit</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $totalDebit  = 0;
              $totalKredit = 0;
              $tempTgl     = '';
              $tempKw      = '';
              ?>
              <?php if (!empty($dtjurnal)) : ?>
                <?php foreach ($dtjurnal as $key => $value) : ?>
                  <?php
                  $totalDebit  += (float)$value->debit;
                  $totalKredit += (float)$value->kredit;

                  $isSameGroup = ($value->tanggal == $tempTgl && $value->kwitansi == $tempKw);
                  $tglDisplay  = $isSameGroup ? '' : date('d/m/Y', strtotime($value->tanggal));
                  $tempTgl     = $value->tanggal;
                  $tempKw      = $value->kwitansi;
                  ?>
                  <tr>
                    <td class="text-center font-weight-bold font-mono text-secondary"><?= $tglDisplay ?></td>
                    <td>
                      <?php if ($value->debit > 0) : ?>
                        <span class="font-weight-600 text-dark"><?= esc($value->nama_akun3) ?></span>
                      <?php else : ?>
                        <span class="text-muted" style="padding-left: 28px;"><?= esc($value->nama_akun3) ?></span>
                      <?php endif; ?>
                    </td>
                    <td class="text-center font-mono text-secondary"><?= esc($value->kode_akun3) ?></td>
                    <td class="text-right font-mono font-weight-600"><?= $value->debit > 0 ? 'Rp ' . number_format((float)$value->debit, 0, ',', '.') : '-' ?></td>
                    <td class="text-right font-mono font-weight-600"><?= $value->kredit > 0 ? 'Rp ' . number_format((float)$value->kredit, 0, ',', '.') : '-' ?></td>
                  </tr>
                <?php endforeach; ?>
              <?php else : ?>
                <tr>
                  <td colspan="5" class="text-center py-4 text-muted">Data Jurnal Umum tidak ditemukan.</td>
                </tr>
              <?php endif; ?>
            </tbody>
            <tfoot>
              <tr class="font-weight-bold" style="background: var(--color-surface-muted);">
                <td colspan="3" class="text-right">Total:</td>
                <td class="text-right font-mono font-weight-bold" style="color: var(--color-ink);">Rp <?= number_format($totalDebit, 0, ',', '.') ?></td>
                <td class="text-right font-mono font-weight-bold" style="color: var(--color-ink);">Rp <?= number_format($totalKredit, 0, ',', '.') ?></td>
              </tr>
              <tr>
                <td colspan="3" class="text-right font-weight-bold">Status Keseimbangan:</td>
                <td colspan="2" class="text-center">
                  <?php if ($totalDebit > 0 && $totalDebit == $totalKredit) : ?>
                    <span class="health-badge badge-pass px-3 py-1 font-weight-bold">
                      <i class="fas fa-check-circle mr-1"></i> Seimbang (Balanced)
                    </span>
                  <?php elseif ($totalDebit > 0) : ?>
                    <span class="health-badge badge-fail px-3 py-1 font-weight-bold">
                      <i class="fas fa-exclamation-triangle mr-1"></i> Selisih (Rp <?= number_format(abs($totalDebit - $totalKredit), 0, ',', '.') ?>)
                    </span>
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
