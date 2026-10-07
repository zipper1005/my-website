<?= $this->extend('layout/backend') ?>

<?= $this->section('title') ?>
Detail Penyesuaian #<?= esc($dtpenyesuaian->id_penyesuaian) ?> &bull; SIA AKN-IPB
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<section class="section">
  <!-- Top Navigation & Action Bar -->
  <div class="d-flex justify-content-between align-items-center flex-wrap mb-4 pb-2">
    <div>
      <div class="text-secondary font-weight-500 mb-1" style="font-size: 0.88rem;">
        <a href="<?= site_url('penyesuaian') ?>" class="text-secondary text-decoration-none">
          <i class="fas fa-arrow-left mr-1"></i> Penyesuaian
        </a>
        <span class="mx-2">&bull;</span>
        <span class="text-primary font-mono">AJP Audit Trail</span>
      </div>
      <h2 class="text-white font-weight-bold mb-0" style="letter-spacing: -0.03em; font-size: 1.65rem;">
        Detail Jurnal Penyesuaian #<?= esc($dtpenyesuaian->id_penyesuaian) ?>
      </h2>
    </div>
    <div class="mt-3 mt-md-0 d-flex align-items-center flex-wrap">
      <a href="<?= site_url('penyesuaian/' . $dtpenyesuaian->id_penyesuaian . '/edit') ?>" class="btn btn-warning font-weight-bold mr-2 mb-1 shadow-sm">
        <i class="fas fa-pencil-alt mr-1"></i> Koreksi Penyesuaian
      </a>
      <a href="<?= site_url('penyesuaian') ?>" class="btn btn-outline-secondary font-weight-600 mb-1">
        <i class="fas fa-list mr-1"></i> Daftar Penyesuaian
      </a>
    </div>
  </div>

  <div class="section-body">
    <!-- Header Dokumen Bukti -->
    <div class="card mb-4">
      <div class="card-header d-flex justify-content-between align-items-center">
        <div>
          <h4 class="mb-0 text-white font-weight-bold">Parameter Alokasi &amp; Amortisasi</h4>
          <small class="text-secondary">Rincian amortisasi dan perhitungan nilai per bulan</small>
        </div>
        <span class="badge badge-primary font-mono">
          <i class="fas fa-calculator mr-1"></i> AJP-<?= date('Ym', strtotime($dtpenyesuaian->tanggal)) ?>-<?= esc($dtpenyesuaian->id_penyesuaian) ?>
        </span>
      </div>
      <div class="card-body p-4">
        <div class="row">
          <div class="col-md-6 col-12 mb-3 mb-md-0">
            <div class="p-3 rounded border" style="background: #081D3A; border-color: var(--border-subtle) !important;">
              <div class="text-secondary font-mono" style="font-size: 0.75rem;">TANGGAL PENYESUAIAN</div>
              <div class="font-weight-600 text-white mt-1">
                <i class="far fa-calendar-alt text-primary mr-1"></i> <?= date('d F Y', strtotime($dtpenyesuaian->tanggal)) ?>
              </div>
              <div class="mt-3 text-secondary font-mono" style="font-size: 0.75rem;">DESKRIPSI PENYESUAIAN</div>
              <div class="text-white mt-1 font-weight-500" style="line-height: 1.4;">
                <?= esc($dtpenyesuaian->deskripsi) ?>
              </div>
            </div>
          </div>

          <div class="col-md-6 col-12">
            <div class="p-3 rounded border" style="background: #081D3A; border-color: var(--border-subtle) !important;">
              <div class="row">
                <div class="col-6">
                  <div class="text-secondary font-mono" style="font-size: 0.75rem;">TOTAL NILAI DISESUAIKAN</div>
                  <div class="font-mono font-weight-bold text-white mt-1" style="font-size: 1.1rem;">
                    Rp <?= number_format((float)$dtpenyesuaian->nilai, 0, ',', '.') ?>
                  </div>
                </div>
                <div class="col-6">
                  <div class="text-secondary font-mono" style="font-size: 0.75rem;">MASA AMORTISASI</div>
                  <div class="font-mono font-weight-bold text-info mt-1" style="font-size: 1.1rem;">
                    <?= esc($dtpenyesuaian->waktu) ?> Bulan
                  </div>
                </div>
              </div>
              <div class="mt-3 text-secondary font-mono" style="font-size: 0.75rem;">ALOKASI BEBAN / BULAN</div>
              <div class="font-mono font-weight-bold text-success mt-1" style="font-size: 1.2rem;">
                Rp <?= number_format((float)$dtpenyesuaian->jumlah, 0, ',', '.') ?>
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
          <h4 class="mb-0 text-white font-weight-bold">Pasangan Akun Buku Besar Penyesuaian</h4>
          <small class="text-secondary">Akun yang didebet dan dikreditkan dalam periode ini</small>
        </div>
        <span class="badge badge-light border font-mono">
          <?= count($dtnilai_penyesuaian ?? []) ?> Baris Mutasi
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
              <?php /** @var array $dtnilai_penyesuaian */ ?>
              <?php foreach ($dtnilai_penyesuaian as $key => $value) : ?>
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
                <td colspan="4" class="text-right">TOTAL MUTASI AJP:</td>
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
                Jurnal penyesuaian ini telah divalidasi dan seimbang sebesar <b>Rp <?= number_format($totalDebit, 0, ',', '.') ?></b>.
              </span>
            <?php else : ?>
              <span class="balance-pill unbalanced mr-3">
                <i class="fas fa-exclamation-triangle mr-1"></i> TIDAK SEIMBANG
              </span>
              <span class="text-danger small">
                Perhatian: Terdapat selisih AJP sebesar <b>Rp <?= number_format(abs($totalDebit - $totalKredit), 0, ',', '.') ?></b>.
              </span>
            <?php endif; ?>
          </div>
          <div class="mt-2 mt-sm-0">
            <a href="<?= site_url('jurnalpenyesuaian') ?>" class="btn btn-outline-secondary btn-sm font-mono">
              <i class="fas fa-book mr-1"></i> Lihat Jurnal Penyesuaian &rarr;
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?= $this->endSection() ?>
