<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title><?= $this->renderSection('title') ?> &mdash; SIA AKN-IPB</title>

  <!-- Google Fonts: Plus Jakarta Sans & IBM Plex Mono -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=IBM+Plex+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">

  <!-- General CSS Files -->
  <link rel="stylesheet" href="<?= base_url() ?>/template/node_modules/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>/template/node_modules/@fortawesome/fontawesome-free/css/all.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="<?= base_url() ?>/template/assets/css/style.css">
  <link rel="stylesheet" href="<?= base_url() ?>/template/assets/css/components.css">
  <link rel="stylesheet" href="<?= base_url() ?>/template/assets/css/custom.css">

  <style>
    :root {
      --ink-950: #14251F;
      --ink-800: #263D34;
      --forest-700: #245B45;
      --forest-600: #347657;
      --mint-100: #E5F1E9;
      --paper-50: #F7F8F4;
      --surface-0: #FFFFFF;
      --line-200: #E1E6DF;
      --muted-600: #69776F;
    }

    body, html {
      background-color: var(--paper-50) !important;
      color: var(--ink-950) !important;
      font-family: 'Plus Jakarta Sans', system-ui, sans-serif !important;
      margin: 0;
      padding: 0;
      min-height: 100vh;
    }

    .auth-split-wrapper {
      min-height: 100vh;
      display: flex;
      width: 100%;
    }

    /* Left Showcase Panel: Dark Academic Ink */
    .auth-showcase-panel {
      flex: 1 1 54%;
      background-color: var(--ink-950);
      position: relative;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      padding: 56px 64px;
      overflow: hidden;
      border-right: 1px solid rgba(255, 255, 255, 0.08);
      color: #FFFFFF;
    }

    .auth-brand-badge {
      display: inline-flex;
      align-items: center;
      gap: 10px;
    }

    .auth-hero-eyebrow {
      font-family: var(--font-mono);
      font-size: 11px;
      font-weight: 700;
      letter-spacing: 1px;
      text-transform: uppercase;
      color: var(--mint-100);
      background: rgba(36, 91, 69, 0.45);
      border: 1px solid rgba(229, 241, 233, 0.2);
      padding: 4px 10px;
      border-radius: var(--radius-badge);
      display: inline-block;
      margin-bottom: 16px;
    }

    .auth-hero-title {
      font-size: 2.1rem;
      font-weight: 800;
      letter-spacing: -0.03em;
      line-height: 1.25;
      color: #FFFFFF;
      margin-bottom: 14px;
    }

    .auth-hero-desc {
      font-size: 14.5px;
      line-height: 1.6;
      color: #CAD5CE;
      max-width: 540px;
      margin-bottom: 28px;
    }

    /* Clean Ledger Preview Window */
    .auth-ledger-card {
      background: #192D26;
      border: 1px solid rgba(255, 255, 255, 0.1);
      border-radius: 12px;
      box-shadow: 0 12px 32px rgba(0, 0, 0, 0.25);
      overflow: hidden;
      margin: 16px 0 24px 0;
      max-width: 580px;
    }

    .auth-ledger-header {
      background: #11201B;
      padding: 10px 18px;
      border-bottom: 1px solid rgba(255, 255, 255, 0.08);
      display: flex;
      align-items: center;
      justify-content: space-between;
      font-family: var(--font-mono);
      font-size: 11px;
      color: #9FB2A7;
    }

    .auth-ledger-body {
      padding: 16px 18px;
    }

    .auth-ledger-row {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 8px 0;
      border-bottom: 1px solid rgba(255, 255, 255, 0.06);
      font-size: 13px;
    }

    .auth-ledger-row:last-child {
      border-bottom: none;
    }

    .auth-showcase-footer {
      display: flex;
      align-items: center;
      gap: 16px;
      flex-wrap: wrap;
      font-size: 12px;
      color: #9FB2A7;
      border-top: 1px solid rgba(255, 255, 255, 0.08);
      padding-top: 20px;
    }

    /* Right Auth Form Panel: Clean Paper & Surface-0 */
    .auth-form-panel {
      flex: 1 1 46%;
      background-color: var(--paper-50);
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      padding: 48px 32px;
      position: relative;
    }

    .auth-form-container {
      width: 100%;
      max-width: 440px;
    }

    .auth-form-card {
      background: var(--surface-0);
      border: 1px solid var(--line-200);
      border-radius: var(--radius-panel);
      padding: 36px 32px;
      box-shadow: var(--shadow-card);
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
    
    <!-- LEFT PANEL: Academic Ledger Editorial Showcase -->
    <div class="auth-showcase-panel d-none d-lg-flex">
      
      <!-- Top Brand Header -->
      <div class="d-flex justify-content-between align-items-center">
        <div class="auth-brand-badge">
          <!-- Geometric Ledger SVG Logo -->
          <svg width="34" height="34" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg" aria-label="SIA Logo">
            <rect x="3" y="4" width="4" height="24" rx="1.5" fill="#347657"/>
            <rect x="8" y="4" width="21" height="24" rx="2" fill="#245B45"/>
            <line x1="12" y1="9" x2="25" y2="9" stroke="#E5F1E9" stroke-width="1.5" stroke-linecap="round"/>
            <line x1="19" y1="9" x2="19" y2="23" stroke="#E5F1E9" stroke-width="1.2" stroke-dasharray="2 2"/>
            <line x1="12" y1="13.5" x2="17" y2="13.5" stroke="#A7C7B7" stroke-width="1.2" stroke-linecap="round"/>
            <line x1="21" y1="13.5" x2="25" y2="13.5" stroke="#A7C7B7" stroke-width="1.2" stroke-linecap="round"/>
            <line x1="12" y1="17.5" x2="17" y2="17.5" stroke="#A7C7B7" stroke-width="1.2" stroke-linecap="round"/>
            <line x1="21" y1="17.5" x2="25" y2="17.5" stroke="#A7C7B7" stroke-width="1.2" stroke-linecap="round"/>
            <line x1="12" y1="21.5" x2="25" y2="21.5" stroke="#E5F1E9" stroke-width="1.5" stroke-linecap="round"/>
          </svg>
          <div>
            <div class="d-flex align-items-baseline">
              <span style="font-weight: 800; font-size: 18px; letter-spacing: -0.02em; color: #FFFFFF;">SIA</span>
              <span class="ml-1" style="font-family: var(--font-mono); font-size: 11px; font-weight: 600; letter-spacing: 0.8px; color: var(--mint-100); text-transform: uppercase;">AKN &middot; IPB</span>
            </div>
            <div style="font-size: 9.5px; color: #9FB2A7;">Sistem Informasi Akuntansi</div>
          </div>
        </div>

        <div class="d-flex align-items-center">
          <span class="badge badge-light border font-mono px-3 py-1" style="font-size: 11px;">
            <i class="fas fa-book-open mr-1 text-success"></i> STANDAR SAK EMKM
          </span>
        </div>
      </div>

      <!-- Main Value Proposition -->
      <div class="my-4">
        <span class="auth-hero-eyebrow">
          <i class="fas fa-layer-group mr-1"></i> ACADEMIC LEDGER WORKSPACE
        </span>
        <h1 class="auth-hero-title">
          Sistem Informasi Akuntansi Presisi untuk Akademik &amp; Keuangan.
        </h1>
        <p class="auth-hero-desc">
          Pencatatan voucher transaksi berpasangan, buku besar otomatis, neraca lajur 10 kolom, serta laporan laba rugi dan posisi keuangan secara akurat dan terverifikasi.
        </p>

        <!-- Ledger Summary Preview Box -->
        <div class="auth-ledger-card">
          <div class="auth-ledger-header">
            <span><i class="fas fa-check-circle text-success mr-1"></i> STATUS SIKLUS: SEIMBANG</span>
            <span class="badge badge-success font-mono" style="font-size: 10px; padding: 2px 7px;">SAK EMKM</span>
          </div>
          <div class="auth-ledger-body">
            <div class="auth-ledger-row">
              <span class="text-white font-weight-500">1. Jurnal Umum &amp; Entri Voucher</span>
              <span class="font-mono text-success font-weight-600">Terverifikasi Seimbang</span>
            </div>
            <div class="auth-ledger-row">
              <span class="text-white font-weight-500">2. Neraca Saldo &amp; Penyesuaian</span>
              <span class="font-mono text-white font-weight-600">Otomatis Terposting</span>
            </div>
            <div class="auth-ledger-row">
              <span class="text-white font-weight-500">3. Neraca Lajur 10 Kolom</span>
              <span class="font-mono text-white font-weight-600">Siap Ekspor PDF</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Bottom Feature Footer -->
      <div class="auth-showcase-footer">
        <div><i class="fas fa-shield-alt text-success mr-1"></i> Autentikasi Terenkripsi</div>
        <div>&bull;</div>
        <div><i class="fas fa-globe text-success mr-1"></i> siarajib.free.nf</div>
        <div>&bull;</div>
        <div>Sekolah Vokasi IPB University</div>
      </div>
    </div>

    <!-- RIGHT PANEL: Authentication Form -->
    <div class="auth-form-panel">
      <div class="auth-form-container">
        
        <!-- Mobile Logo Header (Visible only on < lg) -->
        <div class="d-lg-none text-center mb-4">
          <div class="d-inline-flex align-items-center mb-2">
            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg" class="mr-2">
              <rect x="3" y="4" width="4" height="24" rx="1.5" fill="#347657"/>
              <rect x="8" y="4" width="21" height="24" rx="2" fill="#245B45"/>
              <line x1="12" y1="9" x2="25" y2="9" stroke="#E5F1E9" stroke-width="1.5" stroke-linecap="round"/>
              <line x1="19" y1="9" x2="19" y2="23" stroke="#E5F1E9" stroke-width="1.2" stroke-dasharray="2 2"/>
              <line x1="12" y1="15" x2="25" y2="15" stroke="#A7C7B7" stroke-width="1.2" stroke-linecap="round"/>
              <line x1="12" y1="21" x2="25" y2="21" stroke="#E5F1E9" stroke-width="1.5" stroke-linecap="round"/>
            </svg>
            <div class="text-left">
              <div class="font-weight-800" style="font-size: 1.1rem; color: var(--ink-950);">SIA AKN &middot; IPB</div>
              <small class="text-muted font-mono" style="font-size: 9px;">SISTEM INFORMASI AKUNTANSI</small>
            </div>
          </div>
        </div>

        <!-- Form Card -->
        <div class="auth-form-card">
          <?= $this->renderSection('main') ?>
        </div>

        <!-- Security & Copyright Footer -->
        <div class="text-center mt-4">
          <div class="d-flex justify-content-center align-items-center mb-1 font-mono text-muted" style="font-size: 11px;">
            <i class="fas fa-lock mr-1 text-success"></i> Sesi Aman &bull; Standar SAK EMKM
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

  <!-- Password Visibility Toggle Script -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const btnToggle = document.getElementById('btnTogglePassword');
      const inputPass = document.getElementById('password');
      const iconPass = document.getElementById('togglePasswordIcon');
      if (btnToggle && inputPass && iconPass) {
        btnToggle.addEventListener('click', function() {
          if (inputPass.type === 'password') {
            inputPass.type = 'text';
            iconPass.classList.remove('fa-eye');
            iconPass.classList.add('fa-eye-slash');
          } else {
            inputPass.type = 'password';
            iconPass.classList.remove('fa-eye-slash');
            iconPass.classList.add('fa-eye');
          }
        });
      }
    });
  </script>

  <?= $this->renderSection('pageScripts') ?>
</body>
</html>
