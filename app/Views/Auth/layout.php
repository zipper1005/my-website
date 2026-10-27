<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title><?= $this->renderSection('title') ?> &mdash; SIA AKN-IPB</title>

  <!-- Google Fonts: Plus Jakarta Sans & IBM Plex Mono -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=IBM+Plex+Mono:wght@400;500;600&display=swap" rel="stylesheet">

  <!-- General CSS Files -->
  <link rel="stylesheet" href="<?= base_url() ?>/template/node_modules/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>/template/node_modules/@fortawesome/fontawesome-free/css/all.css">

  <!-- Template & Custom CSS -->
  <link rel="stylesheet" href="<?= base_url() ?>/template/assets/css/style.css">
  <link rel="stylesheet" href="<?= base_url() ?>/template/assets/css/components.css">
  <link rel="stylesheet" href="<?= base_url() ?>/template/assets/css/custom.css">

  <style>
    body, html {
      background-color: var(--color-canvas) !important;
      color: var(--color-ink) !important;
      font-family: var(--font-sans) !important;
      margin: 0;
      padding: 0;
      min-height: 100vh;
      overflow-x: hidden;
      width: 100%;
    }

    .auth-split-wrapper {
      min-height: 100vh;
      display: flex;
      width: 100%;
      overflow-x: hidden;
    }

    /* Left Showcase Panel: 42% Desktop, Deep Ink (PRD v3 Section 4) */
    .auth-showcase-panel {
      flex: 0 0 42%;
      background-color: #172923;
      color: #FFFFFF;
      padding: 56px 48px;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      border-right: 1px solid rgba(255, 255, 255, 0.08);
      position: relative;
    }

    .auth-showcase-brand {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .auth-brand-wordmark-title {
      font-size: 18px;
      font-weight: 800;
      letter-spacing: -0.02em;
      color: #FFFFFF;
      line-height: 1.1;
    }

    .auth-brand-wordmark-inst {
      font-family: var(--font-mono);
      font-size: 11px;
      font-weight: 600;
      letter-spacing: 0.6px;
      color: var(--color-primary-soft);
      text-transform: uppercase;
      margin-left: 6px;
    }

    .auth-brand-wordmark-desc {
      font-size: 10px;
      color: #8E9C94;
    }

    .auth-showcase-main {
      margin: auto 0;
      max-width: 460px;
    }

    .auth-showcase-title {
      font-size: 28px;
      font-weight: 700;
      letter-spacing: -0.03em;
      line-height: 1.25;
      color: #FFFFFF;
      margin-bottom: 14px;
    }

    .auth-showcase-desc {
      font-size: 14px;
      line-height: 1.6;
      color: #CAD5CE;
      margin-bottom: 24px;
    }

    /* Subtle abstract vector ledger graphic (PRD v3 Section 4) */
    .auth-ledger-graphic {
      background: rgba(255, 255, 255, 0.04);
      border: 1px solid rgba(255, 255, 255, 0.08);
      border-radius: var(--radius-md);
      padding: 16px 20px;
      font-family: var(--font-mono);
      font-size: 12px;
      color: #9FB2A7;
    }

    .auth-ledger-graphic-row {
      display: flex;
      justify-content: space-between;
      padding: 6px 0;
      border-bottom: 1px solid rgba(255, 255, 255, 0.06);
    }

    .auth-ledger-graphic-row:last-child {
      border-bottom: none;
    }

    .auth-showcase-footer {
      font-size: 12px;
      color: #7E9086;
      padding-top: 16px;
      border-top: 1px solid rgba(255, 255, 255, 0.08);
    }

    /* Right Form Panel: 58% Clean Canvas */
    .auth-form-panel {
      flex: 1 1 58%;
      background-color: var(--color-canvas);
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      padding: 32px 16px;
      width: 100%;
    }

    .auth-form-container {
      width: 100%;
      max-width: 380px;
      margin: 0 auto;
    }

    .auth-form-card {
      background: var(--color-surface);
      border: 1px solid var(--color-border);
      border-radius: var(--radius-lg);
      padding: 28px 22px;
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
      width: 100%;
      box-sizing: border-box;
    }

    .auth-form-footer {
      text-align: center;
      margin-top: 20px;
      font-size: 12px;
      color: var(--color-text-secondary);
    }

    @media (max-width: 991px) {
      .auth-split-wrapper {
        flex-direction: column !important;
        display: block !important;
        width: 100% !important;
      }
      .auth-showcase-panel {
        display: none !important;
        width: 0 !important;
        height: 0 !important;
        padding: 0 !important;
      }
      .auth-form-panel {
        flex: none !important;
        width: 100% !important;
        max-width: 100% !important;
        min-height: 100vh !important;
        padding: 40px 16px !important;
        display: flex !important;
        justify-content: center !important;
        align-items: center !important;
      }
      .auth-form-container {
        width: 100% !important;
        max-width: 350px !important;
        margin: 0 auto !important;
      }
      .auth-form-card {
        width: 100% !important;
        padding: 26px 20px !important;
      }
    }
  </style>

  <?= $this->renderSection('pageStyles') ?>
</head>

<body>
  <div class="auth-split-wrapper">
    
    <!-- LEFT PANEL: Restrained Academic Showcase (PRD v3 Section 4) -->
    <div class="auth-showcase-panel d-none d-lg-flex">
      
      <!-- Brand Lockup -->
      <div class="auth-showcase-brand">
        <svg width="30" height="30" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg" aria-label="SIA Logo">
          <rect x="3" y="4" width="4" height="24" rx="1.5" fill="#347657"/>
          <rect x="8" y="4" width="21" height="24" rx="2" fill="#245B45"/>
          <line x1="12" y1="9" x2="25" y2="9" stroke="#E7F0EA" stroke-width="1.5" stroke-linecap="round"/>
          <line x1="19" y1="9" x2="19" y2="23" stroke="#E7F0EA" stroke-width="1.2" stroke-dasharray="2 2"/>
          <line x1="12" y1="14" x2="17" y2="14" stroke="#A7C7B7" stroke-width="1.2" stroke-linecap="round"/>
          <line x1="21" y1="14" x2="25" y2="14" stroke="#A7C7B7" stroke-width="1.2" stroke-linecap="round"/>
          <line x1="12" y1="18" x2="17" y2="18" stroke="#A7C7B7" stroke-width="1.2" stroke-linecap="round"/>
          <line x1="21" y1="18" x2="25" y2="18" stroke="#A7C7B7" stroke-width="1.2" stroke-linecap="round"/>
          <line x1="12" y1="22" x2="25" y2="22" stroke="#E7F0EA" stroke-width="1.5" stroke-linecap="round"/>
        </svg>
        <div>
          <div class="d-flex align-items-baseline">
            <span class="auth-brand-wordmark-title">SIA</span>
            <span class="auth-brand-wordmark-inst">AKN &middot; IPB</span>
          </div>
          <div class="auth-brand-wordmark-desc">Sistem Informasi Akuntansi</div>
        </div>
      </div>

      <!-- Concise Headline & Description -->
      <div class="auth-showcase-main">
        <h1 class="auth-showcase-title">
          Sistem Informasi Akuntansi Presisi.
        </h1>
        <p class="auth-showcase-desc">
          Workspace pembukuan, buku besar otomatis, neraca lajur 10 kolom, dan pelaporan keuangan standar SAK EMKM Sekolah Vokasi IPB.
        </p>

        <!-- Subtle abstract vector ledger graphic -->
        <div class="auth-ledger-graphic">
          <div class="auth-ledger-graphic-row">
            <span>Jurnal Umum &bull; Siklus Akuntansi</span>
            <span class="text-white">SAK EMKM</span>
          </div>
          <div class="auth-ledger-graphic-row">
            <span>Neraca Saldo &amp; Penyesuaian</span>
            <span class="text-white">Terposting</span>
          </div>
          <div class="auth-ledger-graphic-row">
            <span>Kertas Kerja 10 Kolom</span>
            <span class="text-white">Valid</span>
          </div>
        </div>
      </div>

      <!-- Footer -->
      <div class="auth-showcase-footer">
        Program Studi Akuntansi &bull; Sekolah Vokasi IPB University
      </div>
    </div>

    <!-- RIGHT PANEL: Authentication Form (PRD v3 Section 4) -->
    <div class="auth-form-panel">
      <div class="auth-form-container">
        
        <!-- Mobile Brand Lockup (visible on < lg only) -->
        <div class="d-lg-none text-center mb-4">
          <div class="d-inline-flex align-items-center mb-1">
            <svg width="28" height="28" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg" class="mr-2">
              <rect x="3" y="4" width="4" height="24" rx="1.5" fill="#347657"/>
              <rect x="8" y="4" width="21" height="24" rx="2" fill="#245B45"/>
              <line x1="12" y1="9" x2="25" y2="9" stroke="#E7F0EA" stroke-width="1.5" stroke-linecap="round"/>
              <line x1="19" y1="9" x2="19" y2="23" stroke="#E7F0EA" stroke-width="1.2" stroke-dasharray="2 2"/>
              <line x1="12" y1="16" x2="25" y2="16" stroke="#A7C7B7" stroke-width="1.2" stroke-linecap="round"/>
              <line x1="12" y1="21" x2="25" y2="21" stroke="#E7F0EA" stroke-width="1.5" stroke-linecap="round"/>
            </svg>
            <span style="font-weight: 800; font-size: 16px; color: var(--color-ink);">SIA AKN &middot; IPB</span>
          </div>
          <div style="font-size: 11px; color: var(--color-text-secondary);">Sistem Informasi Akuntansi</div>
        </div>

        <!-- Form Card -->
        <div class="auth-form-card">
          <?= $this->renderSection('main') ?>
        </div>

        <!-- Footer -->
        <div class="auth-form-footer">
          SIA AKN-IPB &bull; Sekolah Vokasi IPB University &copy; <?= date('Y') ?>
        </div>

      </div>
    </div>

  </div>

  <!-- Scripts -->
  <script src="<?= base_url() ?>/template/node_modules/jquery/dist/jquery.min.js"></script>
  <script src="<?= base_url() ?>/template/node_modules/popper.js/dist/umd/popper.min.js"></script>
  <script src="<?= base_url() ?>/template/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
  
  <script>
    // Password Visibility Toggle
    document.addEventListener('DOMContentLoaded', function() {
      const btn = document.getElementById('btnTogglePassword');
      const input = document.getElementById('password');
      const icon = document.getElementById('toggleIcon');
      if (btn && input && icon) {
        btn.addEventListener('click', function() {
          if (input.type === 'password') {
            input.type = 'text';
            icon.className = 'fas fa-eye-slash';
          } else {
            input.type = 'password';
            icon.className = 'fas fa-eye';
          }
        });
      }
    });
  </script>

  <?= $this->renderSection('pageScripts') ?>
</body>
</html>
