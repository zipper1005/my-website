<?= $this->extend('layout/backend') ?>

<?= $this->section('title') ?>
Jurnal Umum
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<section class="section">
  <div class="section-header">
    <h1>Jurnal Umum</h1>
  </div>

  <div class="section-body">
    <!-- Filter Periode Tanggal -->
    <div class="card mb-4">
      <div class="card-body">
        <form method="post" action="<?= site_url('jurnalumum') ?>">
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
            <div class="col-md-6 mt-3 mt-md-0">
              <button type="submit" class="btn btn-primary mr-2">
                <i class="fas fa-filter"></i> Tampilkan
              </button>
              <button type="submit" formaction="<?= site_url('jurnalumum/cetakjurnalpdf') ?>" formtarget="_blank" class="btn btn-danger">
                <i class="fas fa-file-pdf"></i> Cetak PDF
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>

    <!-- Tabel Data Jurnal Umum -->
    <div class="card">
      <div class="card-header d-flex justify-content-between">
        <h4>Laporan Jurnal Umum</h4>
        <?php if (!empty($tgl_awal) && !empty($tgl_akhir)) : ?>
          <span class="badge badge-info">Periode: <?= date('d/m/Y', strtotime($tgl_awal)) ?> s/d <?= date('d/m/Y', strtotime($tgl_akhir)) ?></span>
        <?php endif; ?>
      </div>
      <div class="card-body p-4">
        <div class="table-responsive">
          <table class="table table-bordered table-striped table-md">
            <thead>
              <tr class="bg-light text-center">
                <th style="width: 15%;">Tanggal</th>
                <th style="width: 35%;">Keterangan / Nama Akun</th>
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
                    <td class="text-center font-weight-bold font-mono"><?= $tglDisplay ?></td>
                    <td>
                      <?php if ($value->debit > 0) : ?>
                        <?= esc($value->nama_akun3) ?>
                      <?php else : ?>
                        <span style="padding-left: 30px;"><?= esc($value->nama_akun3) ?></span>
                      <?php endif; ?>
                    </td>
                    <td class="text-center font-mono"><?= esc($value->kode_akun3) ?></td>
                    <td class="text-right font-mono"><?= $value->debit > 0 ? 'Rp ' . number_format((float)$value->debit, 0, ',', '.') : '-' ?></td>
                    <td class="text-right font-mono"><?= $value->kredit > 0 ? 'Rp ' . number_format((float)$value->kredit, 0, ',', '.') : '-' ?></td>
                  </tr>
                <?php endforeach; ?>
              <?php else : ?>
                <tr>
                  <td colspan="5" class="text-center py-4 text-muted">Data Jurnal Umum tidak ditemukan.</td>
                </tr>
              <?php endif; ?>
            </tbody>
            <tfoot>
              <tr class="font-weight-bold bg-light">
                <td colspan="3" class="text-right">Total:</td>
                <td class="text-right font-mono">Rp <?= number_format($totalDebit, 0, ',', '.') ?></td>
                <td class="text-right font-mono">Rp <?= number_format($totalKredit, 0, ',', '.') ?></td>
              </tr>
              <tr>
                <td colspan="3" class="text-right font-weight-bold">Status:</td>
                <td colspan="2" class="text-center">
                  <?php if ($totalDebit > 0 && $totalDebit == $totalKredit) : ?>
                    <span class="badge badge-success px-3 py-1"><i class="fas fa-check-circle"></i> Seimbang (Balance)</span>
                  <?php elseif ($totalDebit > 0) : ?>
                    <span class="badge badge-danger px-3 py-1"><i class="fas fa-exclamation-triangle"></i> Tidak Seimbang (Not Balance)</span>
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
