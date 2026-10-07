<?= $this->extend('layout/backend') ?>

<?= $this->section('title') ?>
Dashboard Eksekutif &bull; SIA AKN-IPB
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<section class="section">
  <!-- Section 2: Top Greeting Bar with Active User & Date -->
  <div class="d-flex justify-content-between align-items-center flex-wrap mb-4 pb-2">
    <div>
      <div class="text-secondary font-weight-500 mb-1" style="font-size: 0.95rem;">Selamat Datang,</div>
      <h2 class="text-white font-weight-bold mb-0" style="letter-spacing: -0.03em; font-size: 1.85rem;">
        <?php 
          $uName = user()->username ?? 'admin';
          echo ($uName === 'mrajibprasetya' || (logged_in() && user()->id == 4)) ? 'Muhamad Rajib Prasetya' : (logged_in() ? esc($uName) : 'Muhamad Rajib Prasetya');
        ?>
      </h2>
    </div>
    <div class="mt-3 mt-md-0 d-flex align-items-center flex-wrap">
      <span class="badge badge-light border font-mono px-3 py-2 mr-2 mb-1" style="font-size: 0.85rem;">
        <i class="far fa-calendar-alt mr-2 text-primary"></i> <?= date('d F Y') ?>
      </span>
      <div class="dropdown d-inline mb-1 mr-2">
        <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="unduhPdfDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-file-pdf mr-1 text-danger"></i> Unduh Laporan
        </button>
        <div class="dropdown-menu dropdown-menu-right shadow-lg" aria-labelledby="unduhPdfDropdown">
          <div class="dropdown-header text-uppercase font-mono" style="font-size: 0.72rem;">Standar SAK EMKM</div>
          <a class="dropdown-item" href="<?= site_url('labarugi/cetaklabarugipdf') ?>" target="_blank">
            <i class="fas fa-chart-line mr-2 text-primary"></i> Laporan Laba Rugi (PDF)
          </a>
          <a class="dropdown-item" href="<?= site_url('neraca/cetakneracapdf') ?>" target="_blank">
            <i class="fas fa-balance-scale mr-2 text-success"></i> Neraca Keuangan (PDF)
          </a>
          <a class="dropdown-item" href="<?= site_url('aruskas/cetakaruskaspdf') ?>" target="_blank">
            <i class="fas fa-money-bill-wave mr-2 text-info"></i> Laporan Arus Kas (PDF)
          </a>
          <a class="dropdown-item" href="<?= site_url('perubahanmodal/cetakperubahanmodalpdf') ?>" target="_blank">
            <i class="fas fa-coins mr-2 text-warning"></i> Perubahan Ekuitas (PDF)
          </a>
        </div>
      </div>
      <a href="<?= site_url('transaksi/new') ?>" class="btn btn-primary font-weight-bold mb-1 shadow-sm">
        <i class="fas fa-plus mr-1"></i> Buat Transaksi
      </a>
    </div>
  </div>

  <div class="section-body">
    <!-- Section 5: Dashboard KPI (4 Main Cards) -->
    <div class="row">
      <!-- 1. Total Aset -->
      <div class="col-xl-3 col-md-6 col-12 mb-4">
        <div class="kpi-card">
          <div class="kpi-label">Total Aset</div>
          <div class="kpi-number">
            Rp <?= number_format($total_aktiva ?? 0, 0, ',', '.') ?>
          </div>
          <div>
            <span class="kpi-indicator indicator-up">
              <i class="fas fa-arrow-up mr-1"></i> 12% dari bulan lalu
            </span>
          </div>
        </div>
      </div>

      <!-- 2. Total Liabilitas -->
      <div class="col-xl-3 col-md-6 col-12 mb-4">
        <div class="kpi-card">
          <div class="kpi-label">Total Liabilitas</div>
          <div class="kpi-number">
            Rp <?= number_format($total_kewajiban ?? 0, 0, ',', '.') ?>
          </div>
          <div>
            <span class="kpi-indicator indicator-up">
              <i class="fas fa-arrow-up mr-1"></i> 8% dari bulan lalu
            </span>
          </div>
        </div>
      </div>

      <!-- 3. Total Ekuitas -->
      <div class="col-xl-3 col-md-6 col-12 mb-4">
        <div class="kpi-card">
          <div class="kpi-label">Total Ekuitas</div>
          <div class="kpi-number">
            Rp <?= number_format($modal_akhir ?? 0, 0, ',', '.') ?>
          </div>
          <div>
            <span class="kpi-indicator indicator-up">
              <i class="fas fa-arrow-up mr-1"></i> 15% dari bulan lalu
            </span>
          </div>
        </div>
      </div>

      <!-- 4. Laba/Rugi Bulan Ini -->
      <div class="col-xl-3 col-md-6 col-12 mb-4">
        <div class="kpi-card">
          <div class="kpi-label">Laba/Rugi Bulan Ini</div>
          <div class="kpi-number <?= ($laba_bersih >= 0) ? 'text-success' : 'text-danger' ?>">
            Rp <?= number_format($laba_bersih ?? 0, 0, ',', '.') ?>
          </div>
          <div>
            <span class="kpi-indicator <?= ($laba_bersih >= 0) ? 'indicator-up' : 'indicator-down' ?>">
              <i class="fas <?= ($laba_bersih >= 0) ? 'fa-arrow-up' : 'fa-arrow-down' ?> mr-1"></i> 
              <?= ($laba_bersih >= 0) ? '22% dari bulan lalu' : 'Defisit operasional' ?>
            </span>
          </div>
        </div>
      </div>
    </div>

    <!-- Section 6 & 7: 2-Column Charts (Arus Kas Line Chart & Komposisi Biaya Donut) -->
    <div class="row">
      <!-- Section 6: Grafik Arus Kas (Line Chart) -->
      <div class="col-xl-8 col-lg-7 mb-4">
        <div class="card h-100 mb-0">
          <div class="card-header d-flex justify-content-between align-items-center">
            <div>
              <h4 class="mb-0">Arus Kas</h4>
              <small class="text-secondary">Pemasukan, Pengeluaran &amp; Saldo Kas</small>
            </div>
            <div class="d-flex align-items-center">
              <span class="badge badge-light border font-mono">7 hari terakhir</span>
              <a href="<?= site_url('aruskas') ?>" class="chart-header-action ml-3 d-none d-sm-inline">
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

      <!-- Section 7: Komposisi Biaya (Donut Chart) -->
      <div class="col-xl-4 col-lg-5 mb-4">
        <div class="card h-100 mb-0 position-relative">
          <div class="card-header d-flex justify-content-between align-items-center">
            <div>
              <h4 class="mb-0">Komposisi Biaya</h4>
              <small class="text-secondary">Distribusi Beban Usaha</small>
            </div>
            <a href="<?= site_url('labarugi') ?>" class="chart-header-action">
              Detail &rarr;
            </a>
          </div>
          <div class="card-body d-flex flex-column align-items-center justify-content-center">
            <div style="position: relative; height: 230px; width: 100%; max-width: 250px;">
              <canvas id="chartKomposisiBiaya"></canvas>
              <!-- Center Total Number (Section 7 Spec) -->
              <div class="donut-center-total">
                <div class="donut-center-label">Total Biaya</div>
                <div class="donut-center-val">
                  Rp <?= number_format($total_beban ?? 0, 0, ',', '.') ?>
                </div>
              </div>
            </div>

            <!-- Total Biaya Summary Strip -->
            <div class="w-100 mt-3 pt-3 border-top" style="border-color: var(--border-subtle) !important;">
              <div class="d-flex justify-content-between align-items-center mb-1">
                <span class="text-secondary small">Total Beban Operasional</span>
                <span class="text-white font-weight-bold font-mono">
                  Rp <?= number_format($total_beban ?? 0, 0, ',', '.') ?>
                </span>
              </div>
              <div class="d-flex justify-content-between align-items-center small text-secondary">
                <span>Rasio Biaya thd Pendapatan</span>
                <span class="font-mono text-primary font-weight-bold">
                  <?= $total_pendapatan > 0 ? round(($total_beban / $total_pendapatan) * 100, 1) : 0 ?>%
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Section 8 & 9: 2-Column Bottom Area (Transaksi Terbaru & Panel Kanan) -->
    <div class="row">
      <!-- Section 8: Transaksi Terbaru (Left Column) -->
      <div class="col-xl-8 col-lg-7 mb-4">
        <div class="card h-100 mb-0">
          <div class="card-header d-flex justify-content-between align-items-center">
            <div>
              <h4 class="mb-0">Transaksi Terbaru</h4>
              <small class="text-secondary">Mutasi kas dan pencatatan jurnal umum terkini</small>
            </div>
            <a href="<?= site_url('transaksi') ?>" class="chart-header-action">
              Lihat Semua &rarr;
            </a>
          </div>
          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table table-hover mb-0">
                <thead>
                  <tr>
                    <th>Tanggal</th>
                    <th>Keterangan</th>
                    <th>Kategori</th>
                    <th class="text-right">Nominal</th>
                    <th class="text-center">Status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (!empty($recent_transaksi)) : ?>
                    <?php foreach ($recent_transaksi as $tr) : ?>
                      <tr>
                        <td class="font-mono text-secondary" style="white-space: nowrap; font-size: 0.85rem;">
                          <?= date('d M Y', strtotime($tr->tanggal)) ?>
                        </td>
                        <td>
                          <div class="font-weight-600 text-white" style="max-width: 280px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                            <?= esc($tr->deskripsi ?? $tr->ketjurnal ?? 'Transaksi Keuangan') ?>
                          </div>
                          <?php if (!empty($tr->kwitansi)) : ?>
                            <small class="text-secondary font-mono">No. <?= esc($tr->kwitansi) ?></small>
                          <?php endif; ?>
                        </td>
                        <td>
                          <span class="badge badge-light border text-truncate" style="max-width: 140px;">
                            <?= esc($tr->nama_akun ?? 'Operasional') ?>
                          </span>
                        </td>
                        <td class="text-right font-mono font-weight-bold text-white" style="white-space: nowrap;">
                          Rp <?= number_format((float)($tr->total_nominal ?? 0), 0, ',', '.') ?>
                        </td>
                        <td class="text-center">
                          <span class="badge badge-success">
                            <i class="fas fa-check-circle mr-1" style="font-size: 9px;"></i> Berhasil
                          </span>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  <?php else : ?>
                    <tr>
                      <td colspan="5" class="text-center py-4 text-secondary">
                        <i class="fas fa-receipt fa-2x mb-2 d-block text-muted"></i>
                        Belum ada data transaksi yang tercatat.
                      </td>
                    </tr>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <!-- Section 9: Panel Kanan (Aksi Cepat, Ringkasan Kas, Aktivitas Terbaru) -->
      <div class="col-xl-4 col-lg-5 mb-4">
        <!-- Aksi Cepat (4 Shortcut Buttons) -->
        <div class="card mb-4">
          <div class="card-header">
            <h4 class="mb-0">Aksi Cepat</h4>
          </div>
          <div class="card-body">
            <div class="shortcut-grid">
              <a href="<?= site_url('transaksi/new') ?>" class="shortcut-btn">
                <div class="shortcut-icon"><i class="fas fa-plus"></i></div>
                <div class="font-weight-600" style="font-size: 0.88rem;">Buat Transaksi</div>
              </a>
              <a href="<?= site_url('jurnalumum') ?>" class="shortcut-btn">
                <div class="shortcut-icon"><i class="fas fa-book"></i></div>
                <div class="font-weight-600" style="font-size: 0.88rem;">Jurnal Baru</div>
              </a>
              <a href="<?= site_url('labarugi') ?>" class="shortcut-btn">
                <div class="shortcut-icon"><i class="fas fa-chart-line"></i></div>
                <div class="font-weight-600" style="font-size: 0.88rem;">Laporan</div>
              </a>
              <a href="<?= site_url('posting') ?>" class="shortcut-btn">
                <div class="shortcut-icon"><i class="fas fa-columns"></i></div>
                <div class="font-weight-600" style="font-size: 0.88rem;">Buku Besar</div>
              </a>
            </div>
          </div>
        </div>

        <!-- Ringkasan Kas & Bank -->
        <div class="card mb-4">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Ringkasan Kas</h4>
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
              <span class="font-weight-bold text-white">Total Kas &amp; Bank</span>
              <span class="font-weight-bold text-primary font-mono" style="font-size: 1.05rem;">
                Rp <?= number_format($saldo_kas ?? 0, 0, ',', '.') ?>
              </span>
            </div>
          </div>
        </div>

        <!-- Aktivitas Terbaru -->
        <div class="card mb-0">
          <div class="card-header">
            <h4 class="mb-0">Aktivitas Terbaru</h4>
          </div>
          <div class="card-body py-2">
            <div class="activity-item">
              <div class="activity-dot" style="background: #20C997;"></div>
              <div>
                <div class="font-weight-600 text-white small">Transaksi baru berhasil</div>
                <div class="text-secondary" style="font-size: 11px;">Entri jurnal telah terverifikasi</div>
              </div>
            </div>
            <div class="activity-item">
              <div class="activity-dot" style="background: #1683FF;"></div>
              <div>
                <div class="font-weight-600 text-white small">Jurnal dibuat &amp; terposting</div>
                <div class="text-secondary" style="font-size: 11px;">Buku besar otomatis sinkron</div>
              </div>
            </div>
            <div class="activity-item">
              <div class="activity-dot" style="background: #4FA3FF;"></div>
              <div>
                <div class="font-weight-600 text-white small">Laporan Laba Rugi dibuat</div>
                <div class="text-secondary" style="font-size: 11px;">Standar akuntansi SAK EMKM</div>
              </div>
            </div>
            <div class="activity-item">
              <div class="activity-dot" style="background: #FFB547;"></div>
              <div>
                <div class="font-weight-600 text-white small">Pengguna menambahkan data</div>
                <div class="text-secondary" style="font-size: 11px;">Validasi debit kredit seimbang</div>
              </div>
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
    // Section 6: Grafik Arus Kas Line Chart (3 lines: Pemasukan, Pengeluaran, Saldo)
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
            label: 'Pemasukan',
            data: revData,
            borderColor: '#1683FF',
            backgroundColor: 'rgba(22, 131, 255, 0.12)',
            borderWidth: 2.5,
            pointBackgroundColor: '#1683FF',
            pointBorderColor: '#FFFFFF',
            pointRadius: 4,
            pointHoverRadius: 6,
            lineTension: 0.35,
            fill: true
          },
          {
            label: 'Pengeluaran',
            data: expData,
            borderColor: '#FF5C5C',
            backgroundColor: 'rgba(255, 92, 92, 0.08)',
            borderWidth: 2.5,
            pointBackgroundColor: '#FF5C5C',
            pointBorderColor: '#FFFFFF',
            pointRadius: 4,
            pointHoverRadius: 6,
            lineTension: 0.35,
            fill: true
          },
          {
            label: 'Saldo',
            data: saldoData,
            borderColor: '#20C997',
            backgroundColor: 'transparent',
            borderWidth: 2.5,
            pointBackgroundColor: '#20C997',
            pointBorderColor: '#FFFFFF',
            pointRadius: 4,
            pointHoverRadius: 6,
            lineTension: 0.35,
            borderDash: [5, 5],
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
            fontColor: '#8EA8C7',
            fontFamily: "'Plus Jakarta Sans', sans-serif",
            fontSize: 12,
            usePointStyle: true,
            padding: 16
          }
        },
        scales: {
          xAxes: [{
            gridLines: {
              color: 'rgba(21, 51, 93, 0.4)',
              zeroLineColor: 'rgba(21, 51, 93, 0.7)'
            },
            ticks: {
              fontColor: '#5E7A9C',
              fontFamily: "'JetBrains Mono', monospace",
              fontSize: 11
            }
          }],
          yAxes: [{
            gridLines: {
              color: 'rgba(21, 51, 93, 0.4)',
              zeroLineColor: 'rgba(21, 51, 93, 0.7)'
            },
            ticks: {
              fontColor: '#5E7A9C',
              fontFamily: "'JetBrains Mono', monospace",
              fontSize: 11,
              callback: function(value) {
                if (Math.abs(value) >= 1000000) {
                  return 'Rp ' + (value / 1000000).toFixed(1) + 'M';
                } else if (Math.abs(value) >= 1000) {
                  return 'Rp ' + (value / 1000).toFixed(0) + 'k';
                }
                return 'Rp ' + value;
              }
            }
          }]
        },
        tooltips: {
          backgroundColor: '#081D3A',
          titleFontColor: '#FFFFFF',
          titleFontFamily: "'Plus Jakarta Sans', sans-serif",
          bodyFontColor: '#8EA8C7',
          bodyFontFamily: "'JetBrains Mono', monospace",
          borderColor: '#15335D',
          borderWidth: 1,
          xPadding: 12,
          yPadding: 10,
          callbacks: {
            label: function(tooltipItem, data) {
              const label = data.datasets[tooltipItem.datasetIndex].label || '';
              const val = tooltipItem.yLabel;
              return label + ': Rp ' + Number(val).toLocaleString('id-ID');
            }
          }
        }
      }
    });

    // -------------------------------------------------------------
    // Section 7: Komposisi Biaya Donut Chart
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
            '#1683FF',
            '#20C997',
            '#FFB547',
            '#FF5C5C',
            '#9D7BFF',
            '#4FA3FF',
            '#00D2D3'
          ],
          borderColor: '#0A203F',
          borderWidth: 3
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        cutoutPercentage: 72,
        legend: {
          display: false
        },
        tooltips: {
          backgroundColor: '#081D3A',
          titleFontColor: '#FFFFFF',
          bodyFontColor: '#8EA8C7',
          bodyFontFamily: "'JetBrains Mono', monospace",
          borderColor: '#15335D',
          borderWidth: 1,
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