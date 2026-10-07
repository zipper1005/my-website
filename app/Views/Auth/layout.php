<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title><?= $this->renderSection('title') ?> &mdash; SIA AKN-IPB</title>

  <!-- Google Fonts: Plus Jakarta Sans & JetBrains Mono -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">

  <!-- General CSS Files -->
  <link rel="stylesheet" href="<?= base_url() ?>/template/node_modules/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>/template/node_modules/@fortawesome/fontawesome-free/css/all.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="<?= base_url() ?>/template/assets/css/style.css">
  <link rel="stylesheet" href="<?= base_url() ?>/template/assets/css/components.css">
  <link rel="stylesheet" href="<?= base_url() ?>/template/assets/css/custom.css">

  <style>
    :root {
      --auth-bg-canvas: #030914;
      --auth-bg-panel: #071326;
      --auth-border: #163259;
      --auth-border-glow: #2563EB;
      --auth-accent-cobalt: #2563EB;
      --auth-accent-cyan: #38BDF8;
      --auth-accent-emerald: #10B981;
    }

    body, html {
      background-color: var(--auth-bg-canvas) !important;
      color: #FFFFFF !important;
      font-family: 'Plus Jakarta Sans', system-ui, sans-serif !important;
      margin: 0;
      padding: 0;
      min-height: 100vh;
      overflow-x: hidden;
    }

    .auth-split-wrapper {
      min-height: 100vh;
      display: flex;
      width: 100%;
    }

    /* Left Experience Showcase */
    .auth-showcase-panel {
      flex: 1 1 58%;
      background-color: var(--auth-bg-canvas);
      background-image: 
        linear-gradient(to right, rgba(22, 131, 255, 0.04) 1px, transparent 1px),
        linear-gradient(to bottom, rgba(22, 131, 255, 0.04) 1px, transparent 1px);
      background-size: 36px 36px;
      position: relative;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      padding: 48px 56px;
      overflow: hidden;
      border-right: 1px solid var(--auth-border);
    }

    .auth-ambient-glow-1 {
      position: absolute;
      top: -120px;
      left: -120px;
      width: 480px;
      height: 480px;
      border-radius: 50%;
      background: radial-gradient(circle, rgba(37, 99, 235, 0.16) 0%, transparent 70%);
      pointer-events: none;
    }

    .auth-ambient-glow-2 {
      position: absolute;
      bottom: -150px;
      right: -100px;
      width: 520px;
      height: 520px;
      border-radius: 50%;
      background: radial-gradient(circle, rgba(16, 185, 129, 0.10) 0%, transparent 70%);
      pointer-events: none;
    }

    /* Console UI Window (Pure HTML/CSS - Zero Stock Photo) */
    .auth-console-window {
      background: #06162E;
      border: 1px solid var(--auth-border);
      border-radius: 12px;
      box-shadow: 0 20px 50px rgba(0, 5, 15, 0.7), 0 0 35px rgba(37, 99, 235, 0.15);
      overflow: hidden;
      margin: 28px 0;
      position: relative;
    }

    .auth-console-titlebar {
      background: #081D3A;
      border-bottom: 1px solid var(--auth-border);
      padding: 10px 16px;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .mac-dots {
      display: flex;
      align-items: center;
      gap: 6px;
    }

    .mac-dot {
      width: 10px;
      height: 10px;
      border-radius: 50%;
      display: inline-block;
    }

    .mac-dot-red { background: #FF5F56; }
    .mac-dot-yellow { background: #FFBD2E; }
    .mac-dot-green { background: #27C93F; }

    .console-address-pill {
      background: #040D1A;
      border: 1px solid var(--auth-border);
      color: #94A3B8;
      font-family: 'JetBrains Mono', monospace;
      font-size: 11px;
      padding: 3px 14px;
      border-radius: 9999px;
      display: inline-flex;
      align-items: center;
      letter-spacing: 0.2px;
    }

    .console-kpi-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 12px;
      padding: 18px 20px 12px 20px;
    }

    .console-kpi-card {
      background: #081D3A;
      border: 1px solid var(--auth-border);
      border-radius: 8px;
      padding: 12px 14px;
    }

    .console-kpi-label {
      font-size: 0.72rem;
      color: #94A3B8;
      text-transform: uppercase;
      font-weight: 600;
      font-family: 'JetBrains Mono', monospace;
    }

    .console-kpi-val {
      font-family: 'JetBrains Mono', monospace;
      font-size: 1.15rem;
      font-weight: 700;
      color: #FFFFFF;
      margin-top: 4px;
    }

    .console-ledger-table {
      width: 100%;
      border-collapse: collapse;
      font-size: 0.82rem;
    }

    .console-ledger-table th {
      background: #040D1A;
      color: #64748B;
      font-family: 'JetBrains Mono', monospace;
      font-size: 0.7rem;
      text-transform: uppercase;
      padding: 8px 20px;
      border-bottom: 1px solid var(--auth-border);
      border-top: 1px solid var(--auth-border);
    }

    .console-ledger-table td {
      padding: 10px 20px;
      border-bottom: 1px solid rgba(22, 50, 89, 0.4);
      color: #E2EDF8;
      font-family: 'Plus Jakarta Sans', sans-serif;
    }

    .floating-chip {
      position: absolute;
      background: rgba(8, 29, 58, 0.85);
      border: 1px solid var(--auth-accent-cobalt);
      backdrop-filter: blur(12px);
      box-shadow: 0 10px 30px rgba(0, 5, 15, 0.6);
      padding: 8px 16px;
      border-radius: 9999px;
      font-size: 0.78rem;
      font-weight: 600;
      color: #FFFFFF;
      display: inline-flex;
      align-items: center;
      z-index: 10;
      animation: floatChip 4s ease-in-out infinite alternate;
    }

    @keyframes floatChip {
      0% { transform: translateY(0px); }
      100% { transform: translateY(-6px); }
    }

    /* Right Auth Form Panel */
    .auth-form-panel {
      flex: 1 1 42%;
      background-color: var(--auth-bg-panel);
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      padding: 48px 40px;
      position: relative;
    }

    .auth-form-container {
      width: 100%;
      max-width: 420px;
    }

    .auth-form-card {
      background: #081D3A;
      border: 1px solid var(--auth-border);
      border-radius: 14px;
      padding: 34px 28px;
      box-shadow: 0 16px 45px rgba(0, 5, 15, 0.5);
    }

    @media (max-width: 992px) {
      .auth-split-wrapper {
        flex-direction: column;
      }
      .auth-showcase-panel {
        display: none !important;
      }
      .auth-form-panel {
        flex: 1 1 100%;
        min-height: 100vh;
        padding: 32px 20px;
      }
    }
  </style>

  <?= $this->renderSection('pageStyles') ?>
</head>

<body>
  <div class="auth-split-wrapper">
    
    <!-- LEFT PANEL: Enterprise FinTech Experience Showcase (Pure HTML/CSS) -->
    <div class="auth-showcase-panel d-none d-lg-flex">
      <div class="auth-ambient-glow-1"></div>
      <div class="auth-ambient-glow-2"></div>

      <!-- Top Brand Header -->
      <div class="d-flex justify-content-between align-items-center" style="position: relative; z-index: 2;">
        <div class="d-flex align-items-center">
          <div class="mr-3" style="width: 40px; height: 40px; border-radius: 10px; background: linear-gradient(135deg, #2563EB 0%, #0E71E3 100%); display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 16px rgba(37, 99, 235, 0.4);">
            <svg width="22" height="22" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M10 27L18 9L26 27" stroke="#FFFFFF" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M13 21H23" stroke="#FFFFFF" stroke-width="3" stroke-linecap="round"/>
              <rect x="25" y="16" width="3.5" height="11" rx="1.75" fill="#38BDF8" />
              <rect x="30" y="11" width="3.5" height="16" rx="1.75" fill="#10B981" />
            </svg>
          </div>
          <div>
            <div class="font-weight-bold text-white" style="letter-spacing: -0.02em; font-size: 1.15rem;">SIA AKN-IPB</div>
            <small class="text-secondary font-mono" style="font-size: 10px; letter-spacing: 0.5px;">SEKOLAH VOKASI IPB UNIVERSITY</small>
          </div>
        </div>

        <div class="d-flex align-items-center">
          <span class="badge badge-light border font-mono px-3 py-2 mr-2" style="font-size: 11px;">
            <i class="fas fa-shield-alt text-primary mr-1"></i> SAK EMKM COMPLIANT
          </span>
          <span class="badge badge-light border font-mono px-3 py-2 text-primary" style="font-size: 11px;">
            <i class="fas fa-globe mr-1"></i> siarajib.software
          </span>
        </div>
      </div>

      <!-- Main Value Proposition & Headline -->
      <div class="my-4" style="position: relative; z-index: 2;">
        <span class="badge badge-primary font-mono px-3 py-1 mb-3" style="font-size: 11px;">
          <span class="sia-pulse-dot mr-1"></span> MODERN ACCOUNTING OPERATING SYSTEM
        </span>
        <h1 class="font-weight-800 text-white mb-2" style="font-size: 2.25rem; letter-spacing: -0.04em; line-height: 1.2;">
          Platform Akuntansi &amp; Keuangan Terintegrasi Standar Institusi.
        </h1>
        <p class="text-secondary mb-0" style="font-size: 0.95rem; line-height: 1.6; max-width: 620px;">
          Otomasi siklus akuntansi menyeluruh: entri voucher jurnal berpasangan, buku besar otomatis, validasi neraca lajur 10 kolom, hingga pelaporan laba rugi dan arus kas secara real-time.
        </p>

        <!-- THE HERO CONSOLE WINDOW (Pure HTML/CSS Mockup) -->
        <div class="auth-console-window">
          <!-- Floating Status Chips -->
          <div class="floating-chip" style="top: 14px; right: 20px;">
            <i class="fas fa-check-double text-success mr-2"></i> Real-time Ledger: 0 Selisih
          </div>

          <!-- Console Header Bar -->
          <div class="auth-console-titlebar">
            <div class="mac-dots">
              <span class="mac-dot mac-dot-red"></span>
              <span class="mac-dot mac-dot-yellow"></span>
              <span class="mac-dot mac-dot-green"></span>
              <span class="font-mono text-muted small ml-2" style="font-size: 11px;">SIA Production v2.0</span>
            </div>
            <div class="console-address-pill">
              <i class="fas fa-lock text-success mr-1"></i> https://siarajib.software/dashboard
            </div>
            <div>
              <span class="badge badge-success font-mono" style="font-size: 9px; padding: 3px 8px;">
                <span class="sia-pulse-dot mr-1" style="width: 5px; height: 5px; background: #10B981;"></span> ONLINE 99.9%
              </span>
            </div>
          </div>

          <!-- Console KPI Grid -->
          <div class="console-kpi-grid">
            <div class="console-kpi-card">
              <div class="console-kpi-label">Kas &amp; Bank</div>
              <div class="console-kpi-val">Rp 142.500.000</div>
              <small class="text-success font-mono" style="font-size: 10px;">
                <i class="fas fa-arrow-up mr-1"></i> +12.4% MoM
              </small>
            </div>
            <div class="console-kpi-card">
              <div class="console-kpi-label">Laba Bersih Berjalan</div>
              <div class="console-kpi-val text-success">Rp 57.800.000</div>
              <small class="text-success font-mono" style="font-size: 10px;">
                <i class="fas fa-arrow-up mr-1"></i> +22.1% Surplus
              </small>
            </div>
            <div class="console-kpi-card">
              <div class="console-kpi-label">Keseimbangan Neraca</div>
              <div class="console-kpi-val text-info">100% Balanced</div>
              <small class="text-secondary font-mono" style="font-size: 10px;">
                <i class="fas fa-check-circle text-info mr-1"></i> Aktiva = Pasiva
              </small>
            </div>
          </div>

          <!-- SVG Visual Trend Wave -->
          <div style="padding: 0 20px 10px 20px;">
            <svg viewBox="0 0 500 65" style="width: 100%; height: 50px; overflow: visible;">
              <defs>
                <linearGradient id="chartGradientAuth" x1="0" y1="0" x2="0" y2="1">
                  <stop offset="0%" stop-color="#2563EB" stop-opacity="0.35"/>
                  <stop offset="100%" stop-color="#2563EB" stop-opacity="0.0"/>
                </linearGradient>
              </defs>
              <path d="M 0 45 Q 70 15, 140 35 T 280 20 T 420 10 T 500 5 L 500 65 L 0 65 Z" fill="url(#chartGradientAuth)"/>
              <path d="M 0 45 Q 70 15, 140 35 T 280 20 T 420 10 T 500 5" fill="none" stroke="#38BDF8" stroke-width="2.5" stroke-linecap="round"/>
              <circle cx="500" cy="5" r="4" fill="#38BDF8" />
            </svg>
          </div>

          <!-- Live Double-Entry Voucher Ledger Table Preview -->
          <table class="console-ledger-table">
            <thead>
              <tr>
                <th style="width: 120px;">No. Voucher</th>
                <th>Akun Buku Besar</th>
                <th class="text-right" style="width: 150px;">Nominal (Rp)</th>
                <th class="text-center" style="width: 100px;">Verifikasi</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="font-mono text-primary font-weight-bold" style="font-size: 0.78rem;">KW-2026-081</td>
                <td>
                  <span class="font-weight-600 text-white">Kas Operasional SV-IPB</span>
                  <small class="text-secondary d-block font-mono" style="font-size: 10px;">Debet &bull; Akun #111</small>
                </td>
                <td class="text-right font-mono font-weight-bold text-success">+ 15.000.000</td>
                <td class="text-center">
                  <span class="badge badge-success" style="font-size: 9px; padding: 2px 6px;">Posted</span>
                </td>
              </tr>
              <tr>
                <td class="font-mono text-primary font-weight-bold" style="font-size: 0.78rem;">KW-2026-082</td>
                <td>
                  <span class="font-weight-600 text-white">Beban Operasional Pelatihan</span>
                  <small class="text-secondary d-block font-mono" style="font-size: 10px;">Kredit &bull; Akun #512</small>
                </td>
                <td class="text-right font-mono font-weight-bold text-danger">- 4.250.000</td>
                <td class="text-center">
                  <span class="badge badge-success" style="font-size: 9px; padding: 2px 6px;">Posted</span>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <!-- Bottom Feature Badges -->
      <div class="d-flex align-items-center flex-wrap" style="position: relative; z-index: 2; gap: 12px;">
        <div class="d-flex align-items-center py-2 px-3 rounded border" style="background: #081D3A; border-color: var(--auth-border) !important;">
          <i class="fas fa-sync-alt text-primary mr-2"></i>
          <span class="small font-weight-600 text-white">Otomasi Siklus Transaksi</span>
        </div>
        <div class="d-flex align-items-center py-2 px-3 rounded border" style="background: #081D3A; border-color: var(--auth-border) !important;">
          <i class="fas fa-balance-scale text-success mr-2"></i>
          <span class="small font-weight-600 text-white">Neraca 10 Kolom Seimbang</span>
        </div>
        <div class="d-flex align-items-center py-2 px-3 rounded border" style="background: #081D3A; border-color: var(--auth-border) !important;">
          <i class="fas fa-file-invoice text-info mr-2"></i>
          <span class="small font-weight-600 text-white">Laporan Standar SAK EMKM</span>
        </div>
      </div>
    </div>

    <!-- RIGHT PANEL: Authentication Portal Form -->
    <div class="auth-form-panel">
      <div class="auth-form-container">
        
        <!-- Mobile Logo Header (Visible only on < lg) -->
        <div class="d-lg-none text-center mb-4">
          <div class="mx-auto mb-2" style="width: 44px; height: 44px; border-radius: 10px; background: linear-gradient(135deg, #2563EB 0%, #0E71E3 100%); display: flex; align-items: center; justify-content: center;">
            <svg width="24" height="24" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M10 27L18 9L26 27" stroke="#FFFFFF" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M13 21H23" stroke="#FFFFFF" stroke-width="3" stroke-linecap="round"/>
              <rect x="25" y="16" width="3.5" height="11" rx="1.75" fill="#38BDF8" />
              <rect x="30" y="11" width="3.5" height="16" rx="1.75" fill="#10B981" />
            </svg>
          </div>
          <h4 class="text-white font-weight-bold mb-0">SIA AKN-IPB</h4>
          <small class="text-secondary font-mono">siarajib.software</small>
        </div>

        <!-- Form Card -->
        <div class="auth-form-card">
          <?= $this->renderSection('main') ?>
        </div>

        <!-- Security & Copyright Footer -->
        <div class="text-center mt-4">
          <div class="d-flex justify-content-center align-items-center mb-1">
            <i class="fas fa-shield-alt text-success mr-2" style="font-size: 11px;"></i>
            <small class="text-secondary font-mono" style="font-size: 11px;">
              Enkripsi Sesi Aktif &bull; SAK EMKM Standard
            </small>
          </div>
          <small class="text-muted font-mono" style="font-size: 11px;">
            SIA AKN-IPB &bull; Sekolah Vokasi IPB University &copy; <?= date('Y') ?>
          </small>
        </div>

      </div>
    </div>

  </div>

  <!-- General JS Scripts -->
  <script src="<?= base_url() ?>/template/node_modules/jquery/dist/jquery.min.js"></script>
  <script src="<?= base_url() ?>/template/node_modules/popper.js/dist/umd/popper.min.js"></script>
  <script src="<?= base_url() ?>/template/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="<?= base_url() ?>/template/assets/js/scripts.js"></script>
  <script src="<?= base_url() ?>/template/assets/js/custom.js"></script>

  <?= $this->renderSection('pageScripts') ?>
</body>
</html>
