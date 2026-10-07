<?= $this->extend('layout/backend') ?>

<?= $this->section('title') ?>
Detail Transaksi #<?= esc($dttransaksi->kwitansi) ?> &bull; SIA AKN-IPB
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<section class="section">
  <!-- Top Navigation & Action Bar -->
  <div class="d-flex justify-content-between align-items-center flex-wrap mb-4 pb-2">
    <div>
      <div class="text-secondary font-weight-500 mb-1" style="font-size: 0.88rem;">
        <a href="<?= site_url('transaksi') ?>" class="text-secondary text-decoration-none">
          <i class="fas fa-arrow-left mr-1"></i> Transaksi
        </a>
        <span class="mx-2">&bull;</span>
        <span class="text-primary font-mono">Voucher Audit Trail</span>
      </div>
      <h2 class="text-white font-weight-bold mb-0" style="letter-spacing: -0.03em; font-size: 1.65rem;">
        Detail Voucher #<?= esc($dttransaksi->kwitansi) ?>
      </h2>
    </div>
    <div class="mt-3 mt-md-0 d-flex align-items-center flex-wrap">
      <a href="<?= site_url('transaksi/' . $dttransaksi->id_transaksi . '/edit') ?>" class="btn btn-warning font-weight-bold mr-2 mb-1 shadow-sm">
        <i class="fas fa-pencil-alt mr-1"></i> Koreksi Voucher
      </a>
      <a href="<?= site_url('transaksi') ?>" class="btn btn-outline-secondary font-weight-600 mb-1">
        <i class="fas fa-list mr-1"></i> Daftar Transaksi
      </a>
    </div>
  </div>

  <div class="section-body">
    <!-- Header Dokumen Bukti -->
    <div class="card mb-4">
      <div class="card-header d-flex justify-content-between align-items-center">
        <div>
          <h4 class="mb-0 text-white font-weight-bold">Informasi Bukti Transaksi</h4>
          <small class="text-secondary">Dokumen sumber pencatatan buku besar</small>
        </div>
        <span class="badge badge-primary font-mono">
          <i class="fas fa-receipt mr-1"></i> <?= esc($dttransaksi->kwitansi) ?>
        </span>
      </div>
      <div class="card-body p-4">
        <div class="row">
          <div class="col-md-6 col-12 mb-3 mb-md-0">
            <div class="p-3 rounded border" style="background: #081D3A; border-color: var(--border-subtle) !important;">
              <div class="text-secondary font-mono" style="font-size: 0.75rem;">NOMOR KWITANSI / BUKTI</div>
              <div class="font-mono font-weight-bold text-white mt-1" style="font-size: 1.1rem;">
                <?= esc($dttransaksi->kwitansi) ?>
              </div>
              <div class="mt-3 text-secondary font-mono" style="font-size: 0.75rem;">TANGGAL TRANSAKSI</div>
              <div class="font-weight-600 text-white mt-1">
                <i class="far fa-calendar-alt text-primary mr-1"></i> <?= date('d F Y', strtotime($dttransaksi->tanggal)) ?>
              </div>
            </div>
          </div>

          <div class="col-md-6 col-12">
            <div class="p-3 rounded border" style="background: #081D3A; border-color: var(--border-subtle) !important;">
              <div class="text-secondary font-mono" style="font-size: 0.75rem;">DESKRIPSI OPERASIONAL</div>
              <div class="text-white mt-1" style="font-size: 0.95rem; line-height: 1.4;">
                <?= esc($dttransaksi->deskripsi) ?>
              </div>
              <div class="mt-3 text-secondary font-mono" style="font-size: 0.75rem;">MEMO JURNAL UMUM</div>
              <div class="font-weight-600 text-primary mt-1">
                <i class="fas fa-tag mr-1"></i> <?= esc($dttransaksi->ketjurnal) ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Rincian Mutasi Debit & Kredit -->
    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <div>
          <h4 class="mb-0 text-white font-weight-bold">Rincian Pasangan Akun Buku Besar (Jurnal)</h4>
          <small class="text-secondary">Daftar mutasi akun yang terpengaruh oleh voucher ini</small>
        </div>
        <span class="badge badge-light border font-mono">
          <?= count($dtnilai ?? []) ?> Baris Mutasi
        </span>
      </div>
      <div class="card-body p-4">
        <div class="table-responsive">
          <table class="table table-bordered table-md">
            <thead>
              <tr>
                <th class="text-center" style="width: 50px;">No</th>
                <th style="width: 130px;" class="text-center">Kode Akun</th>
                <th>Nama Akun Buku Besar</th>
                <th style="width: 120px;" class="text-center">Status</th>
                <th style="width: 220px;" class="text-right">Debit (Rp)</th>
                <th style="width: 220px;" class="text-right">Kredit (Rp)</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $totalDebit = 0;
              $totalKredit = 0;
              ?>
              <?php /** @var array $dtnilai */ ?>
              <?php foreach ($dtnilai as $key => $value) : ?>
                <?php
                $totalDebit  += (float)$value->debit;
                $totalKredit += (float)$value->kredit;
                ?>
                <tr>
                  <td class="text-center font-mono text-secondary"><?= $key + 1 ?></td>
                  <td class="text-center font-mono text-primary font-weight-bold"><?= esc($value->kode_akun3) ?></td>
                  <td>
                    <span class="font-weight-600 text-white"><?= esc($value->nama_akun3) ?></span>
                  </td>
                  <td class="text-center">
                    <span class="badge badge-info font-weight-600"><?= esc($value->status) ?></span>
                  </td>
                  <td class="text-right font-mono font-weight-bold text-white">
                    <?= $value->debit > 0 ? 'Rp ' . number_format((float)$value->debit, 0, ',', '.') : '-' ?>
                  </td>
                  <td class="text-right font-mono font-weight-bold text-white">
                    <?= $value->kredit > 0 ? 'Rp ' . number_format((float)$value->kredit, 0, ',', '.') : '-' ?>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
            <tfoot>
              <!-- Baris Total -->
              <tr class="table-primary font-weight-bold accounting-double-rule">
                <td colspan="4" class="text-right">TOTAL MUTASI JURNAL:</td>
                <td class="text-right font-mono font-weight-bold" style="font-size: 1.05rem;">
                  Rp <?= number_format($totalDebit, 0, ',', '.') ?>
                </td>
                <td class="text-right font-mono font-weight-bold" style="font-size: 1.05rem;">
                  Rp <?= number_format($totalKredit, 0, ',', '.') ?>
                </td>
              </tr>
            </tfoot>
          </table>
        </div>

        <!-- Status Keseimbangan Ledger -->
        <div class="mt-4 p-3 rounded d-flex justify-content-between align-items-center flex-wrap border" style="background: #081D3A; border-color: var(--border-subtle) !important;">
          <div class="d-flex align-items-center">
            <?php if ($totalDebit == $totalKredit && $totalDebit > 0) : ?>
              <span class="balance-pill balanced mr-3">
                <i class="fas fa-check-circle mr-1"></i> SEIMBANG (BALANCE)
              </span>
              <span class="text-secondary small">
                Voucher ini telah divalidasi dan secara matematis seimbang dengan total mutasi <b>Rp <?= number_format($totalDebit, 0, ',', '.') ?></b>.
              </span>
            <?php else : ?>
              <span class="balance-pill unbalanced mr-3">
                <i class="fas fa-exclamation-triangle mr-1"></i> TIDAK SEIMBANG
              </span>
              <span class="text-danger small">
                Perhatian: Terdapat selisih mutasi sebesar <b>Rp <?= number_format(abs($totalDebit - $totalKredit), 0, ',', '.') ?></b>. Silakan lakukan koreksi voucher.
              </span>
            <?php endif; ?>
          </div>
          <div class="mt-2 mt-sm-0">
            <a href="<?= site_url('jurnalumum') ?>" class="btn btn-outline-secondary btn-sm font-mono">
              <i class="fas fa-book mr-1"></i> Lihat di Jurnal Umum &rarr;
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?= $this->endSection() ?>
