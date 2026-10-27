<?= $this->extend('layout/backend') ?>

<?= $this->section('title') ?>
Ringkasan Keuangan &bull; SIA AKN-IPB
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<section class="section">
  <!-- 1. Page Header (PRD v3 Section 6.1) -->
  <div class="page-header-box">
    <div>
      <h1 class="page-title-main">Ringkasan Keuangan</h1>
      <p class="page-subtitle">
        Ringkasan arus kas, laba rugi, posisi neraca, dan voucher transaksi akuntansi aktif.
      </p>
    </div>
    
    <div class="page-actions-group">
      <!-- Export PDF Dropdown -->
      <div class="dropdown d-inline">
        <button class="btn btn-outline-secondary dropdown-toggle btn-sm" type="button" id="unduhPdfDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-file-pdf mr-1 text-danger"></i> Unduh Laporan
        </button>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="unduhPdfDropdown">
          <div class="dropdown-header font-weight-bold" style="color: var(--color-ink);">Laporan SAK EMKM</div>
          <a class="dropdown-item" href="<?= site_url('labarugi/cetaklabarugipdf') ?>" target="_blank">
            <i class="fas fa-chart-line mr-2 text-success"></i> Laporan Laba Rugi
          </a>
          <a class="dropdown-item" href="<?= site_url('neraca/cetakneracapdf') ?>" target="_blank">
            <i class="fas fa-balance-scale mr-2 text-primary"></i> Neraca Keuangan
          </a>
          <a class="dropdown-item" href="<?= site_url('aruskas/cetakaruskaspdf') ?>" target="_blank">
            <i class="fas fa-money-bill-wave mr-2 text-info"></i> Laporan Arus Kas
          </a>
          <a class="dropdown-item" href="<?= site_url('perubahanmodal/cetakperubahanmodalpdf') ?>" target="_blank">
            <i class="fas fa-coins mr-2 text-warning"></i> Perubahan Ekuitas
          </a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="<?= site_url('neracalajur/cetaklajurpdf') ?>" target="_blank">
            <i class="fas fa-table mr-2 text-dark"></i> Neraca Lajur 10 Kolom
          </a>
        </div>
      </div>

      <!-- Actions -->
      <a href="<?= site_url('transaksi') ?>" class="btn btn-outline-secondary btn-sm">
        <i class="fas fa-list mr-1"></i> Lihat Transaksi
      </a>
      <a href="<?= site_url('transaksi/new') ?>" class="btn btn-primary btn-sm font-weight-bold">
        <i class="fas fa-plus mr-1"></i> Buat Transaksi
      </a>
    </div>
  </div>

  <div class="section-body">
    <!-- 2. Accounting Health Strip: Single Compact Line (PRD v3 Section 6.2) -->
    <div class="health-status-strip">
      <div class="health-status-items">
        <div class="health-status-item">
          <span class="health-dot <?= ($is_neraca_balanced ?? true) ? 'dot-pass' : 'dot-fail' ?>"></span>
          <span>Neraca: Aset <b>Rp <?= number_format($total_aktiva ?? 0, 0, ',', '.') ?></b> = Pasiva <b>Rp <?= number_format($total_pasiva ?? 0, 0, ',', '.') ?></b></span>
          <span class="health-badge <?= ($is_neraca_balanced ?? true) ? 'badge-pass' : 'badge-fail' ?>">
            <?= ($is_neraca_balanced ?? true) ? 'Seimbang' : 'Selisih' ?>
          </span>
        </div>

        <div class="health-status-item">
          <span class="health-dot <?= ($is_debit_kredit_match ?? true) ? 'dot-pass' : 'dot-fail' ?>"></span>
          <span>Jurnal: Debit <b>Rp <?= number_format($total_debit ?? 0, 0, ',', '.') ?></b> = Kredit <b>Rp <?= number_format($total_kredit ?? 0, 0, ',', '.') ?></b></span>
          <span class="health-badge <?= ($is_debit_kredit_match ?? true) ? 'badge-pass' : 'badge-fail' ?>">
            <?= ($is_debit_kredit_match ?? true) ? 'Seimbang' : 'Selisih' ?>
          </span>
        </div>
      </div>

      <div class="text-muted font-mono" style="font-size: 11.5px;">
        <i class="fas fa-book-open mr-1"></i> <?= esc($total_entri_jurnal ?? 0) ?> baris entri &bull; <b><?= esc($count_transaksi ?? 0) ?></b> voucher terverifikasi
      </div>
    </div>

    <!-- 3. Financial Summary: 4 KPI Cards in 1 Row (PRD v3 Section 6.3) -->
    <div class="kpi-grid-4">
      <!-- 1. Total Pemasukan -->
      <div class="kpi-card-box">
        <div class="kpi-card-header">
          <span class="kpi-card-label">Total Pemasukan</span>
          <span class="small font-mono text-success font-weight-bold">&uarr; Masuk</span>
        </div>
        <div class="kpi-card-value val-income">
          Rp <?= number_format($total_pendapatan ?? 0, 0, ',', '.') ?>
        </div>
        <div class="kpi-card-sub">
          Total penerimaan pendapatan operasional
        </div>
      </div>

      <!-- 2. Total Pengeluaran -->
      <div class="kpi-card-box">
        <div class="kpi-card-header">
          <span class="kpi-card-label">Total Pengeluaran</span>
          <span class="small font-mono text-danger font-weight-bold">&darr; Keluar</span>
        </div>
        <div class="kpi-card-value val-expense">
          Rp <?= number_format($total_beban ?? 0, 0, ',', '.') ?>
        </div>
        <div class="kpi-card-sub">
          Total akumulasi beban operasional periode
        </div>
      </div>

      <!-- 3. Saldo Bersih / Laba Rugi -->
      <div class="kpi-card-box">
        <div class="kpi-card-header">
          <span class="kpi-card-label">Saldo Bersih (Laba/Rugi)</span>
          <span class="health-badge <?= (($laba_bersih ?? 0) >= 0) ? 'badge-pass' : 'badge-fail' ?>">
            <?= (($laba_bersih ?? 0) >= 0) ? 'Surplus' : 'Defisit' ?>
          </span>
        </div>
        <div class="kpi-card-value" style="color: <?= (($laba_bersih ?? 0) >= 0) ? 'var(--color-primary)' : 'var(--color-danger)' ?>;">
          Rp <?= number_format($laba_bersih ?? 0, 0, ',', '.') ?>
        </div>
        <div class="kpi-card-sub">
          Selisih bersih pendapatan terhadap beban
        </div>
      </div>

      <!-- 4. Jumlah Transaksi -->
      <div class="kpi-card-box">
        <div class="kpi-card-header">
          <span class="kpi-card-label">Jumlah Transaksi</span>
          <span class="small font-mono text-muted">Voucher</span>
        </div>
        <div class="kpi-card-value">
          <?= number_format($count_transaksi ?? 0, 0, ',', '.') ?>
        </div>
        <div class="kpi-card-sub">
          Voucher jurnal terverifikasi SAK EMKM
        </div>
      </div>
    </div>

    <!-- 4. Analysis Section: Arus Kas & Likuiditas (PRD v3 Section 6.4) -->
    <div class="row">
      <!-- Arus Kas Line Chart -->
      <div class="col-xl-8 col-lg-7 mb-4">
        <div class="card h-100 mb-0">
          <div class="card-header d-flex justify-content-between align-items-center">
            <div>
              <h4 class="mb-0">Tren Arus Kas &amp; Mutasi Saldo</h4>
              <small class="text-muted">Penerimaan, pengeluaran, dan saldo kas berjalan</small>
            </div>
            <a href="<?= site_url('aruskas') ?>" class="btn btn-outline-secondary btn-sm">
              Laporan Arus Kas &rarr;
            </a>
          </div>
          <div class="card-body">
            <div style="position: relative; height: 260px; width: 100%;">
              <canvas id="chartArusKasLine"></canvas>
            </div>
          </div>
        </div>
      </div>

      <!-- Likuiditas / Posisi Kas & Bank -->
      <div class="col-xl-4 col-lg-5 mb-4">
        <div class="card h-100 mb-0">
          <div class="card-header d-flex justify-content-between align-items-center">
            <div>
              <h4 class="mb-0">Kas &amp; Setara Kas</h4>
              <small class="text-muted">Posisi likuiditas per akun buku besar</small>
            </div>
            <span class="badge badge-light border font-mono">Likuiditas</span>
          </div>
          <div class="card-body p-0">
            <div class="p-3">
              <?php if (!empty($kas_bank_accounts)) : ?>
                <?php foreach ($kas_bank_accounts as $kb) : ?>
                  <div class="d-flex justify-content-between align-items-center py-2 border-bottom" style="border-color: var(--color-border) !important; font-size: 13px;">
                    <div>
                      <div class="font-weight-600" style="color: var(--color-ink);"><?= esc($kb->nama_akun3) ?></div>
                      <small class="font-mono text-muted">Kode #<?= esc($kb->kode_akun3) ?></small>
                    </div>
                    <span class="font-mono font-weight-bold" style="color: var(--color-primary);">
                      Rp <?= number_format((float)$kb->saldo, 0, ',', '.') ?>
                    </span>
                  </div>
                <?php endforeach; ?>
              <?php else : ?>
                <div class="d-flex justify-content-between align-items-center py-2">
                  <span class="text-muted">Kas Operasional</span>
                  <span class="font-mono font-weight-bold" style="color: var(--color-primary);">
                    Rp <?= number_format($saldo_kas ?? 0, 0, ',', '.') ?>
                  </span>
                </div>
              <?php endif; ?>

              <div class="d-flex justify-content-between align-items-center pt-3 mt-1">
                <span class="font-weight-700" style="color: var(--color-ink); font-size: 13.5px;">Total Kas &amp; Bank</span>
                <span class="font-mono font-weight-bold" style="font-size: 15px; color: var(--color-primary);">
                  Rp <?= number_format($saldo_kas ?? 0, 0, ',', '.') ?>
                </span>
              </div>
            </div>

            <div class="p-3 border-top" style="background: var(--color-surface-muted); border-color: var(--color-border) !important;">
              <div class="d-flex justify-content-between align-items-center" style="font-size: 12px;">
                <span class="text-muted">Rasio Kas thd Aset Lancar:</span>
                <span class="font-mono font-weight-bold text-dark">
                  <?= ($aktiva_lancar > 0) ? round(($saldo_kas / $aktiva_lancar) * 100, 1) : 0 ?>%
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- 5. Recent Transactions Section: High on Page (PRD v3 Section 6.5) -->
    <div class="card mb-4">
      <div class="card-header d-flex justify-content-between align-items-center flex-wrap" style="gap: 8px;">
        <div>
          <h4 class="mb-0">Voucher Transaksi Terbaru</h4>
          <small class="text-muted">Daftar entri voucher transaksi yang terposting ke buku besar</small>
        </div>
        <div>
          <a href="<?= site_url('transaksi') ?>" class="btn btn-outline-secondary btn-sm">
            Lihat Semua Transaksi &rarr;
          </a>
        </div>
      </div>
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-hover table-striped mb-0">
            <thead>
              <tr>
                <th style="width: 130px;">No. Kwitansi</th>
                <th style="width: 110px;" class="text-center">Tanggal</th>
                <th>Deskripsi &amp; Memo Transaksi</th>
                <th style="width: 180px;">Akun Terkait</th>
                <th style="width: 160px;" class="text-right">Nominal (Rp)</th>
                <th style="width: 90px;" class="text-center">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($recent_transaksi)) : ?>
                <?php foreach ($recent_transaksi as $tr) : ?>
                  <tr>
                    <td>
                      <a href="<?= site_url('transaksi/' . $tr->id_transaksi) ?>" class="font-mono font-weight-bold" style="color: var(--color-primary); font-size: 12.5px;">
                        <?= esc($tr->kwitansi ?? '-') ?>
                      </a>
                    </td>
                    <td class="text-center font-mono text-muted" style="font-size: 12.5px;">
                      <?= date('d/m/Y', strtotime($tr->tanggal)) ?>
                    </td>
                    <td>
                      <div class="font-weight-600" style="color: var(--color-ink); font-size: 13px; line-height: 1.35;">
                        <?= esc($tr->deskripsi ?? $tr->ketjurnal ?? 'Transaksi Keuangan') ?>
                      </div>
                      <?php if (!empty($tr->ketjurnal) && !empty($tr->deskripsi) && $tr->ketjurnal !== $tr->deskripsi) : ?>
                        <small class="text-muted d-block mt-0">
                          Memo: <?= esc($tr->ketjurnal) ?>
                        </small>
                      <?php endif; ?>
                    </td>
                    <td>
                      <span class="badge badge-light border text-truncate" style="max-width: 160px; font-size: 11.5px; font-weight: 500;">
                        <?= esc($tr->nama_akun ?? 'Operasional') ?>
                      </span>
                    </td>
                    <td class="text-right font-mono font-weight-bold" style="color: var(--color-primary); font-size: 13px;">
                      Rp <?= number_format((float)($tr->total_nominal ?? 0), 0, ',', '.') ?>
                    </td>
                    <td class="text-center">
                      <a href="<?= site_url('transaksi/' . $tr->id_transaksi) ?>" class="btn btn-outline-secondary btn-sm py-1 px-2" style="font-size: 11px;" title="Lihat detail voucher">
                        Rincian &rarr;
                      </a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php else : ?>
                <tr>
                  <td colspan="6" class="text-center py-4 text-muted">
                    Belum ada voucher transaksi yang tercatat dalam sistem.
                  </td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    // 1. Chart Arus Kas & Saldo (Restrained Forest & Crimson Palette)
    const ctxLine = document.getElementById('chartArusKasLine');
    if (ctxLine) {
      const dates    = <?= $timeline_dates ?? '[]' ?>;
      const dataRev  = <?= $timeline_rev ?? '[]' ?>;
      const dataExp  = <?= $timeline_exp ?? '[]' ?>;
      const dataBal  = <?= $timeline_saldo ?? '[]' ?>;

      new Chart(ctxLine, {
        type: 'line',
        data: {
          labels: dates,
          datasets: [
            {
              label: 'Penerimaan Kas (Pendapatan)',
              data: dataRev,
              borderColor: '#245B45',
              backgroundColor: 'rgba(36, 91, 69, 0.08)',
              borderWidth: 2,
              pointRadius: 3,
              pointBackgroundColor: '#245B45',
              tension: 0.15,
              fill: true
            },
            {
              label: 'Pengeluaran Kas (Beban)',
              data: dataExp,
              borderColor: '#A33E3E',
              backgroundColor: 'rgba(163, 62, 62, 0.04)',
              borderWidth: 2,
              pointRadius: 3,
              pointBackgroundColor: '#A33E3E',
              tension: 0.15,
              fill: true
            },
            {
              label: 'Posisi Saldo Kas',
              data: dataBal,
              borderColor: '#64736B',
              backgroundColor: 'transparent',
              borderWidth: 1.5,
              borderDash: [4, 4],
              pointRadius: 2,
              pointBackgroundColor: '#64736B',
              tension: 0.15,
              fill: false
            }
          ]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          legend: {
            position: 'top',
            labels: {
              boxWidth: 12,
              fontColor: '#64736B',
              fontFamily: 'Plus Jakarta Sans',
              fontSize: 12,
              padding: 14
            }
          },
          tooltips: {
            mode: 'index',
            intersect: false,
            backgroundColor: '#172923',
            titleFontFamily: 'Plus Jakarta Sans',
            bodyFontFamily: 'IBM Plex Mono',
            cornerRadius: 6,
            xPadding: 10,
            yPadding: 8,
            callbacks: {
              label: function(tooltipItem, data) {
                let label = data.datasets[tooltipItem.datasetIndex].label || '';
                let val = tooltipItem.yLabel || 0;
                return label + ': Rp ' + val.toLocaleString('id-ID');
              }
            }
          },
          layout: {
            padding: {
              left: 12,
              right: 12,
              top: 8,
              bottom: 4
            }
          },
          scales: {
            xAxes: [{
              gridLines: { color: '#EAEFEA', zeroLineColor: '#DDE4DE' },
              ticks: { fontColor: '#64736B', fontFamily: 'Plus Jakarta Sans', fontSize: 11 }
            }],
            yAxes: [{
              gridLines: { color: '#EAEFEA', zeroLineColor: '#DDE4DE' },
              ticks: {
                fontColor: '#64736B',
                fontFamily: 'IBM Plex Mono',
                fontSize: 11,
                callback: function(value) {
                  if (value >= 1000000) return (value / 1000000).toFixed(0) + ' jt';
                  if (value >= 1000) return (value / 1000).toFixed(0) + ' rb';
                  return value;
                }
              }
            }]
          }
        }
      });
    }
  });
</script>
<?= $this->endSection() ?>
