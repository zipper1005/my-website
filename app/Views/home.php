<?= $this->extend('layout/backend') ?>

<?= $this->section('title') ?>
Dashboard Akuntansi &bull; SIA AKN-IPB
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<section class="section">
  <!-- Page Header & Reporting Period Context -->
  <div class="page-header-box">
    <div>
      <h2 class="page-title-main">
        Dashboard Akuntansi
      </h2>
      <div class="page-subtitle">
        SIA AKN-IPB &bull; Program Studi Akuntansi Sekolah Vokasi IPB University &bull; Standar SAK EMKM
      </div>
    </div>
    <div class="d-flex align-items-center flex-wrap" style="gap: 10px;">
      <!-- Active Accounting Period Badge -->
      <div class="period-badge">
        <i class="far fa-calendar-alt mr-2 text-success"></i>
        <span>Periode Pembukuan: <strong><?= esc($periode_formatted ?? 'Desember 2023') ?></strong></span>
      </div>

      <!-- Financial Report Export Dropdown -->
      <div class="dropdown d-inline">
        <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="unduhPdfDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-file-pdf mr-1 text-danger"></i> Unduh Laporan (PDF)
        </button>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="unduhPdfDropdown">
          <div class="dropdown-title">Laporan Keuangan SAK EMKM</div>
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

      <!-- Primary Action -->
      <a href="<?= site_url('transaksi/new') ?>" class="btn btn-primary">
        <i class="fas fa-plus mr-1"></i> Buat Transaksi
      </a>
    </div>
  </div>

  <div class="section-body">
    <!-- Financial Integrity Strip (Audit & Keseimbangan Buku) -->
    <div class="audit-strip">
      <div class="audit-strip-item">
        <span class="audit-strip-label"><i class="fas fa-balance-scale mr-1 text-success"></i> Keseimbangan Neraca:</span>
        <span class="audit-strip-val">Aset Rp <?= number_format($total_aktiva ?? 0, 0, ',', '.') ?> = Pasiva Rp <?= number_format($total_pasiva ?? 0, 0, ',', '.') ?></span>
        <?php if ($is_neraca_balanced ?? true) : ?>
          <span class="audit-badge audit-pass"><i class="fas fa-check-circle mr-1"></i> Seimbang</span>
        <?php else : ?>
          <span class="audit-badge audit-fail"><i class="fas fa-exclamation-triangle mr-1"></i> Selisih</span>
        <?php endif; ?>
      </div>

      <div class="audit-strip-item">
        <span class="audit-strip-label"><i class="fas fa-check-double mr-1 text-primary"></i> Audit Jurnal:</span>
        <span class="audit-strip-val">Debit Rp <?= number_format($total_debit ?? 0, 0, ',', '.') ?> = Kredit Rp <?= number_format($total_kredit ?? 0, 0, ',', '.') ?></span>
        <?php if ($is_debit_kredit_match ?? true) : ?>
          <span class="audit-badge audit-pass"><i class="fas fa-check-circle mr-1"></i> Seimbang</span>
        <?php else : ?>
          <span class="audit-badge audit-fail"><i class="fas fa-exclamation-triangle mr-1"></i> Selisih</span>
        <?php endif; ?>
      </div>

      <div class="audit-strip-item text-muted" style="font-size: 12px;">
        <i class="fas fa-book-open mr-1"></i> Total Entri Jurnal: <strong><?= esc($total_entri_jurnal ?? 0) ?></strong> baris (<strong><?= esc($count_transaksi ?? 0) ?></strong> transaksi)
      </div>
    </div>

    <!-- 4 Core Financial KPI Metrics -->
    <div class="row">
      <!-- 1. Total Aset -->
      <div class="col-xl-3 col-md-6 col-12 mb-4">
        <div class="kpi-card">
          <div class="kpi-label">
            <span>Total Aset (Aktiva)</span>
            <i class="fas fa-landmark text-muted"></i>
          </div>
          <div class="kpi-number">
            Rp <?= number_format($total_aktiva ?? 0, 0, ',', '.') ?>
          </div>
          <div class="kpi-subdetail">
            Lancar: <strong>Rp <?= number_format($aktiva_lancar ?? 0, 0, ',', '.') ?></strong> &bull; Tetap: <strong>Rp <?= number_format($aktiva_tetap ?? 0, 0, ',', '.') ?></strong>
          </div>
        </div>
      </div>

      <!-- 2. Total Liabilitas -->
      <div class="col-xl-3 col-md-6 col-12 mb-4">
        <div class="kpi-card">
          <div class="kpi-label">
            <span>Total Liabilitas (Kewajiban)</span>
            <i class="fas fa-file-invoice-dollar text-muted"></i>
          </div>
          <div class="kpi-number">
            Rp <?= number_format($total_kewajiban ?? 0, 0, ',', '.') ?>
          </div>
          <div class="kpi-subdetail">
            Kewajiban lancar &amp; jangka panjang yang tercatat
          </div>
        </div>
      </div>

      <!-- 3. Total Ekuitas -->
      <div class="col-xl-3 col-md-6 col-12 mb-4">
        <div class="kpi-card">
          <div class="kpi-label">
            <span>Total Ekuitas (Modal)</span>
            <i class="fas fa-coins text-muted"></i>
          </div>
          <div class="kpi-number">
            Rp <?= number_format($modal_akhir ?? 0, 0, ',', '.') ?>
          </div>
          <div class="kpi-subdetail">
            Saldo modal akhir pemilik per akhir periode
          </div>
        </div>
      </div>

      <!-- 4. Laba / Rugi Bersih -->
      <div class="col-xl-3 col-md-6 col-12 mb-4">
        <div class="kpi-card">
          <div class="kpi-label">
            <span>Laba / (Rugi) Bersih</span>
            <?php if (($laba_bersih ?? 0) >= 0) : ?>
              <span class="kpi-indicator indicator-surplus"><i class="fas fa-arrow-up mr-1"></i> Surplus</span>
            <?php else : ?>
              <span class="kpi-indicator indicator-deficit"><i class="fas fa-arrow-down mr-1"></i> Defisit</span>
            <?php endif; ?>
          </div>
          <div class="kpi-number" style="color: <?= (($laba_bersih ?? 0) >= 0) ? 'var(--financial-surplus)' : 'var(--financial-deficit)' ?>;">
            Rp <?= number_format($laba_bersih ?? 0, 0, ',', '.') ?>
          </div>
          <div class="kpi-subdetail">
            Pendapatan: <strong>Rp <?= number_format($total_pendapatan ?? 0, 0, ',', '.') ?></strong> &bull; Beban: <strong>Rp <?= number_format($total_beban ?? 0, 0, ',', '.') ?></strong>
          </div>
        </div>
      </div>
    </div>

    <!-- Charts Row: Arus Kas & Komposisi Beban -->
    <div class="row">
      <!-- Arus Kas Line Chart (Left Column) -->
      <div class="col-xl-8 col-lg-7 mb-4">
        <div class="card h-100 mb-0">
          <div class="card-header d-flex justify-content-between align-items-center">
            <div>
              <h4 class="mb-0">Tren Arus Kas &amp; Posisi Saldo</h4>
              <small class="text-secondary">Pencatatan penerimaan, pengeluaran operasional, dan saldo kas berjalan</small>
            </div>
            <div>
              <a href="<?= site_url('aruskas') ?>" class="btn btn-outline-secondary btn-sm">
                Laporan Lengkap &rarr;
              </a>
            </div>
          </div>
          <div class="card-body">
            <div style="position: relative; height: 320px; width: 100%;">
              <canvas id="chartArusKasLine"></canvas>
            </div>
          </div>
        </div>
      </div>

      <!-- Komposisi Beban Donut Chart (Right Column) -->
      <div class="col-xl-4 col-lg-5 mb-4">
        <div class="card h-100 mb-0">
          <div class="card-header d-flex justify-content-between align-items-center">
            <div>
              <h4 class="mb-0">Komposisi Beban</h4>
              <small class="text-secondary">Distribusi akun beban usaha SAK EMKM</small>
            </div>
            <div>
              <a href="<?= site_url('labarugi') ?>" class="btn btn-outline-secondary btn-sm">
                Detail &rarr;
              </a>
            </div>
          </div>
          <div class="card-body d-flex flex-column align-items-center justify-content-center">
            <div style="position: relative; height: 210px; width: 100%; max-width: 240px;">
              <canvas id="chartKomposisiBiaya"></canvas>
              <!-- Center Total Number -->
              <div class="donut-center-total">
                <div class="donut-center-label">Total Beban</div>
                <div class="donut-center-val">
                  Rp <?= number_format($total_beban ?? 0, 0, ',', '.') ?>
                </div>
              </div>
            </div>

            <!-- Expense Summary Metrics -->
            <div class="w-100 mt-3 pt-3 border-top" style="border-color: var(--border-subtle) !important;">
              <div class="d-flex justify-content-between align-items-center mb-1">
                <span class="text-secondary" style="font-size: 12.5px;">Total Beban Operasional</span>
                <span class="font-mono font-weight-bold" style="color: var(--brand-forest); font-size: 13px;">
                  Rp <?= number_format($total_beban ?? 0, 0, ',', '.') ?>
                </span>
              </div>
              <div class="d-flex justify-content-between align-items-center" style="font-size: 12px; color: var(--text-muted);">
                <span>Rasio Beban thd Pendapatan</span>
                <span class="font-mono font-weight-bold text-dark">
                  <?= ($total_pendapatan ?? 0) > 0 ? round((($total_beban ?? 0) / $total_pendapatan) * 100, 1) : 0 ?>%
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Recent Transactions & Right Sidebar Panels -->
    <div class="row">
      <!-- Recent Transactions Table (Left Column) -->
      <div class="col-xl-8 col-lg-7 mb-4">
        <div class="card h-100 mb-0">
          <div class="card-header d-flex justify-content-between align-items-center">
            <div>
              <h4 class="mb-0">Transaksi Terakhir</h4>
              <small class="text-secondary">Pencatatan voucher transaksi jurnal umum terkini</small>
            </div>
            <a href="<?= site_url('transaksi') ?>" class="btn btn-outline-secondary btn-sm">
              Lihat Semua &rarr;
            </a>
          </div>
          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table table-hover mb-0">
                <thead>
                  <tr>
                    <th style="width: 105px;">Tanggal</th>
                    <th style="width: 100px;">No. Bukti</th>
                    <th>Keterangan Transaksi</th>
                    <th style="width: 140px;">Kategori Akun</th>
                    <th class="text-right" style="width: 130px;">Nominal</th>
                    <th class="text-center" style="width: 110px;">Status / Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (!empty($recent_transaksi)) : ?>
                    <?php foreach ($recent_transaksi as $tr) : ?>
                      <tr>
                        <td class="font-mono text-secondary" style="white-space: nowrap; font-size: 0.84rem;">
                          <?= date('d/m/Y', strtotime($tr->tanggal)) ?>
                        </td>
                        <td>
                          <a href="<?= site_url('transaksi/' . $tr->id_transaksi) ?>" class="badge badge-light border font-mono font-weight-bold text-dark" title="Buka rincian voucher <?= esc($tr->kwitansi) ?>">
                            <?= esc($tr->kwitansi ?? '-') ?>
                          </a>
                        </td>
                        <td>
                          <div class="font-weight-600" style="color: var(--text-primary); font-size: 0.88rem; line-height: 1.35;">
                            <?= esc($tr->deskripsi ?? $tr->ketjurnal ?? 'Transaksi Keuangan') ?>
                          </div>
                          <?php if (!empty($tr->ketjurnal) && !empty($tr->deskripsi) && $tr->ketjurnal !== $tr->deskripsi) : ?>
                            <small class="text-muted d-block mt-1">
                              <i class="fas fa-tag mr-1 text-success"></i> <?= esc($tr->ketjurnal) ?>
                            </small>
                          <?php endif; ?>
                        </td>
                        <td>
                          <span class="badge badge-light border" style="font-size: 11.5px; max-width: 130px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; display: inline-block;">
                            <?= esc($tr->nama_akun ?? 'Operasional') ?>
                          </span>
                        </td>
                        <td class="text-right font-mono font-weight-bold" style="white-space: nowrap; color: var(--brand-forest); font-size: 0.88rem;">
                          Rp <?= number_format((float)($tr->total_nominal ?? 0), 0, ',', '.') ?>
                        </td>
                        <td class="text-center" style="white-space: nowrap;">
                          <a href="<?= site_url('transaksi/' . $tr->id_transaksi) ?>" class="badge badge-success" title="Lihat detail voucher jurnal">
                            <i class="fas fa-check mr-1" style="font-size: 9px;"></i> Rincian &rarr;
                          </a>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  <?php else : ?>
                    <tr>
                      <td colspan="6" class="text-center py-4 text-muted">
                        <i class="fas fa-receipt fa-2x mb-2 d-block text-muted"></i>
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

      <!-- Right Column: Likuiditas & Aksi Cepat -->
      <div class="col-xl-4 col-lg-5 mb-4">
        <!-- Posisi Kas & Bank (Likuiditas) -->
        <div class="card mb-4">
          <div class="card-header d-flex justify-content-between align-items-center">
            <div>
              <h4 class="mb-0">Kas &amp; Setara Kas</h4>
              <small class="text-secondary">Posisi saldo likuiditas terkini</small>
            </div>
            <span class="badge badge-light border font-mono">Likuiditas</span>
          </div>
          <div class="card-body py-2">
            <?php if (!empty($kas_bank_accounts)) : ?>
              <?php foreach ($kas_bank_accounts as $kb) : ?>
                <div class="kas-item">
                  <span class="kas-item-name"><?= esc($kb->nama_akun3) ?></span>
                  <span class="kas-item-val">Rp <?= number_format((float)$kb->saldo, 0, ',', '.') ?></span>
                </div>
              <?php endforeach; ?>
            <?php else : ?>
              <div class="kas-item">
                <span class="kas-item-name">Kas Operasional</span>
                <span class="kas-item-val">Rp <?= number_format($saldo_kas ?? 0, 0, ',', '.') ?></span>
              </div>
            <?php endif; ?>
            <div class="kas-item pt-3 mt-1 border-top" style="border-color: var(--border-subtle) !important;">
              <span class="font-weight-bold" style="color: var(--text-primary);">Total Kas &amp; Bank</span>
              <span class="font-weight-bold font-mono" style="font-size: 1.05rem; color: var(--brand-forest);">
                Rp <?= number_format($saldo_kas ?? 0, 0, ',', '.') ?>
              </span>
            </div>
          </div>
        </div>

        <!-- Aksi Pembukuan Cepat -->
        <div class="card mb-0">
          <div class="card-header">
            <h4 class="mb-0">Pintasan Pembukuan</h4>
            <small class="text-secondary">Modul operasional akuntansi harian</small>
          </div>
          <div class="card-body">
            <div class="shortcut-grid">
              <a href="<?= site_url('transaksi/new') ?>" class="shortcut-btn">
                <div class="shortcut-icon"><i class="fas fa-file-invoice"></i></div>
                <div class="shortcut-label">Buat Transaksi</div>
              </a>
              <a href="<?= site_url('jurnalumum') ?>" class="shortcut-btn">
                <div class="shortcut-icon"><i class="fas fa-book"></i></div>
                <div class="shortcut-label">Jurnal Umum</div>
              </a>
              <a href="<?= site_url('posting') ?>" class="shortcut-btn">
                <div class="shortcut-icon"><i class="fas fa-layer-group"></i></div>
                <div class="shortcut-label">Buku Besar</div>
              </a>
              <a href="<?= site_url('neracalajur') ?>" class="shortcut-btn">
                <div class="shortcut-icon"><i class="fas fa-table"></i></div>
                <div class="shortcut-label">Neraca Lajur</div>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</section>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
  $(document).ready(function() {
    // -------------------------------------------------------------
    // Line Chart: Arus Kas & Posisi Saldo
    // -------------------------------------------------------------
    const dates = <?= $timeline_dates ?>;
    const revData = <?= $timeline_rev ?>;
    const expData = <?= $timeline_exp ?>;
    const saldoData = <?= $timeline_saldo ?>;

    const ctxLine = document.getElementById('chartArusKasLine').getContext('2d');
    new Chart(ctxLine, {
      type: 'line',
      data: {
        labels: dates,
        datasets: [
          {
            label: 'Penerimaan Kas',
            data: revData,
            borderColor: '#243D32',
            backgroundColor: 'rgba(36, 61, 50, 0.08)',
            borderWidth: 2.2,
            pointBackgroundColor: '#243D32',
            pointBorderColor: '#FFFFFF',
            pointRadius: 3.5,
            pointHoverRadius: 5.5,
            lineTension: 0.25,
            fill: true
          },
          {
            label: 'Pengeluaran / Beban',
            data: expData,
            borderColor: '#B33A3A',
            backgroundColor: 'rgba(179, 58, 58, 0.06)',
            borderWidth: 2.2,
            pointBackgroundColor: '#B33A3A',
            pointBorderColor: '#FFFFFF',
            pointRadius: 3.5,
            pointHoverRadius: 5.5,
            lineTension: 0.25,
            fill: true
          },
          {
            label: 'Posisi Saldo Kas',
            data: saldoData,
            borderColor: '#47765A',
            backgroundColor: 'transparent',
            borderWidth: 2.2,
            pointBackgroundColor: '#47765A',
            pointBorderColor: '#FFFFFF',
            pointRadius: 3.5,
            pointHoverRadius: 5.5,
            lineTension: 0.25,
            borderDash: [4, 4],
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
            fontColor: '#68716A',
            fontFamily: "'Plus Jakarta Sans', sans-serif",
            fontSize: 12,
            usePointStyle: true,
            padding: 14
          }
        },
        scales: {
          xAxes: [{
            gridLines: {
              color: '#ECECE5',
              zeroLineColor: '#E2E5DE',
              drawBorder: false
            },
            ticks: {
              fontColor: '#68716A',
              fontFamily: "'JetBrains Mono', monospace",
              fontSize: 11
            }
          }],
          yAxes: [{
            gridLines: {
              color: '#ECECE5',
              zeroLineColor: '#E2E5DE',
              drawBorder: false
            },
            ticks: {
              fontColor: '#68716A',
              fontFamily: "'JetBrains Mono', monospace",
              fontSize: 11,
              callback: function(value) {
                if (Math.abs(value) >= 1000000000) {
                  return 'Rp ' + (value / 1000000000).toFixed(1).replace('.0', '') + 'M';
                } else if (Math.abs(value) >= 1000000) {
                  return 'Rp ' + (value / 1000000).toFixed(1).replace('.0', '') + 'jt';
                } else if (Math.abs(value) >= 1000) {
                  return 'Rp ' + (value / 1000).toFixed(0) + 'k';
                }
                return 'Rp ' + value;
              }
            }
          }]
        },
        tooltips: {
          backgroundColor: '#14241D',
          titleFontColor: '#FFFFFF',
          titleFontFamily: "'Plus Jakarta Sans', sans-serif",
          bodyFontColor: '#CAD5CE',
          bodyFontFamily: "'JetBrains Mono', monospace",
          borderColor: '#365C4C',
          borderWidth: 1,
          xPadding: 12,
          yPadding: 10,
          cornerRadius: 6,
          callbacks: {
            label: function(tooltipItem, data) {
              const datasetLabel = data.datasets[tooltipItem.datasetIndex].label || '';
              return datasetLabel + ': Rp ' + Number(tooltipItem.yLabel).toLocaleString('id-ID');
            }
          }
        }
      }
    });

    // -------------------------------------------------------------
    // Donut Chart: Komposisi Beban Usaha SAK EMKM
    // -------------------------------------------------------------
    const bebanLabels = <?= $beban_labels ?>;
    const bebanValues = <?= $beban_values ?>;

    const ctxDonut = document.getElementById('chartKomposisiBiaya').getContext('2d');
    new Chart(ctxDonut, {
      type: 'doughnut',
      data: {
        labels: bebanLabels,
        datasets: [{
          data: bebanValues,
          backgroundColor: [
            '#243D32',
            '#365C4C',
            '#47765A',
            '#5E9274',
            '#7BAE92',
            '#A3CBB6',
            '#B4690E',
            '#8C9B90'
          ],
          borderColor: '#FFFFFF',
          borderWidth: 2
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        cutoutPercentage: 70,
        legend: {
          display: false
        },
        tooltips: {
          backgroundColor: '#14241D',
          titleFontColor: '#FFFFFF',
          bodyFontColor: '#CAD5CE',
          bodyFontFamily: "'JetBrains Mono', monospace",
          borderColor: '#365C4C',
          borderWidth: 1,
          xPadding: 12,
          yPadding: 10,
          cornerRadius: 6,
          callbacks: {
            label: function(tooltipItem, data) {
              const idx = tooltipItem.index;
              const label = data.labels[idx] || '';
              const val = data.datasets[0].data[idx] || 0;
              return label + ': Rp ' + Number(val).toLocaleString('id-ID');
            }
          }
        }
      }
    });
  });
</script>
<?= $this->endSection() ?>
