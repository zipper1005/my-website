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

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="<?= base_url() ?>/template/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>/template/node_modules/izitoast/dist/css/iziToast.min.css">

  <!-- Template & Custom Design System CSS -->
  <link rel="stylesheet" href="<?= base_url() ?>/template/assets/css/style.css">
  <link rel="stylesheet" href="<?= base_url() ?>/template/assets/css/components.css">
  <link rel="stylesheet" href="<?= base_url() ?>/template/assets/css/custom.css">
  <?= $this->renderSection('styles') ?>
</head>

<body>
  <div id="app">
    <div class="main-wrapper">
      
      <!-- Topbar Header (PRD v3 Section 5: Height 58px, Single Baseline) -->
      <nav class="navbar navbar-expand-lg main-navbar">
        <div class="topbar-left">
          <a href="#" data-toggle="sidebar" class="sidebar-toggle-btn" aria-label="Buka/Tutup Navigasi">
            <i class="fas fa-bars"></i>
          </a>
          
          <div class="topbar-context d-none d-sm-flex align-items-center">
            <span>SIA AKN &middot; IPB</span>
            <span class="mx-2 text-muted">&bull;</span>
            <span class="topbar-period-chip">
              <i class="far fa-calendar-alt text-success mr-1"></i> Periode: <span class="font-weight-bold ml-1">Desember 2023</span>
            </span>
          </div>
        </div>

        <div class="topbar-right">
          <!-- Audit Trail Quick Modal Button -->
          <button type="button" class="btn-audit d-none d-md-inline-flex" data-toggle="modal" data-target="#siaAuditModal" title="Audit Status Pembukuan">
            <i class="fas fa-shield-alt text-success"></i> Status Pembukuan
          </button>

          <!-- User Profile Dropdown -->
          <div class="dropdown">
            <?php 
              $activeUsername = user()->username ?? 'admin';
              $userRole = (function_exists('in_groups') && in_groups('admin')) ? 'Administrator' : 'Staf Akuntansi';
              if ($activeUsername === 'mrajibprasetya' || (logged_in() && user()->id == 4)) {
                $activeDisplayName = 'Muhamad Rajib Prasetya';
              } elseif ($activeUsername === 'admin') {
                $activeDisplayName = 'Administrator';
              } else {
                $activeDisplayName = esc($activeUsername);
              }
              $initials = strtoupper(substr($activeDisplayName, 0, 1));
            ?>
            <a href="#" data-toggle="dropdown" class="topbar-user-toggle dropdown-toggle" aria-haspopup="true" aria-expanded="false">
              <div class="topbar-user-avatar"><?= $initials ?></div>
              <div class="d-none d-lg-block text-left">
                <div class="topbar-user-name"><?= $activeDisplayName ?></div>
                <div class="topbar-user-role"><?= $userRole ?></div>
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <div class="dropdown-header font-weight-bold" style="color: var(--color-ink);">
                <?= $activeDisplayName ?>
                <div class="small font-weight-normal text-muted"><?= $userRole ?></div>
              </div>
              <div class="dropdown-divider"></div>
              <?php if (function_exists('in_groups') && in_groups('admin')) : ?>
                <a href="<?= site_url('users') ?>" class="dropdown-item">
                  <i class="fas fa-users-cog mr-2 text-muted"></i> Kelola Pengguna
                </a>
              <?php endif; ?>
              <a href="<?= site_url('neracalajur') ?>" class="dropdown-item">
                <i class="fas fa-table mr-2 text-muted"></i> Neraca Lajur 10 Kolom
              </a>
              <a href="<?= site_url('posting') ?>" class="dropdown-item">
                <i class="fas fa-layer-group mr-2 text-muted"></i> Posting Buku Besar
              </a>
              <div class="dropdown-divider"></div>
              <a href="<?= site_url('logout') ?>" class="dropdown-item text-danger">
                <i class="fas fa-sign-out-alt mr-2"></i> Keluar (Logout)
              </a>
            </div>
          </div>
        </div>
      </nav>

      <!-- Sidebar (PRD v3 Section 5: Width 232px) -->
      <div class="main-sidebar">
        <aside id="sidebar-wrapper">
          <!-- Logo Brand SIA AKN-IPB -->
          <div class="sidebar-brand">
            <a href="<?= site_url('/') ?>" class="d-flex align-items-center">
              <!-- Geometric SVG Ledger Logo -->
              <svg width="26" height="26" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg" aria-label="SIA Logo">
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
              <div class="sidebar-brand-wordmark text-left">
                <div class="d-flex align-items-baseline">
                  <span class="sidebar-brand-main">SIA</span>
                  <span class="sidebar-brand-inst ml-1">AKN &middot; IPB</span>
                </div>
                <div class="sidebar-brand-desc">Sistem Informasi Akuntansi</div>
              </div>
            </a>
          </div>
          
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="<?= site_url('/') ?>" title="SIA AKN-IPB">
              <svg width="24" height="24" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="3" y="4" width="4" height="24" rx="1.5" fill="#347657"/>
                <rect x="8" y="4" width="21" height="24" rx="2" fill="#245B45"/>
                <line x1="12" y1="10" x2="25" y2="10" stroke="#E7F0EA" stroke-width="1.5" stroke-linecap="round"/>
                <line x1="19" y1="10" x2="19" y2="22" stroke="#E7F0EA" stroke-width="1.2" stroke-dasharray="2 2"/>
                <line x1="12" y1="16" x2="25" y2="16" stroke="#A7C7B7" stroke-width="1.2" stroke-linecap="round"/>
                <line x1="12" y1="21" x2="25" y2="21" stroke="#E7F0EA" stroke-width="1.5" stroke-linecap="round"/>
              </svg>
            </a>
          </div>

          <!-- Menu Navigasi Utama -->
          <ul class="sidebar-menu">
            <?= $this->include("layout/menu") ?>
          </ul>

          <!-- Sidebar Footer User Profile -->
          <div class="sidebar-user-footer hide-sidebar-mini">
            <div class="sidebar-user-card">
              <div class="sidebar-user-info">
                <div class="sidebar-user-name" title="<?= $activeDisplayName ?>"><?= $activeDisplayName ?></div>
                <span class="sidebar-user-role"><?= $userRole ?></span>
              </div>
              <a href="<?= site_url('logout') ?>" class="sidebar-logout-link" title="Keluar dari Sistem">
                <i class="fas fa-sign-out-alt"></i>
              </a>
            </div>
          </div>
        </aside>
      </div>

      <!-- Main Content Container -->
      <div class="main-content">
        <?= $this->renderSection("content") ?>
      </div>

      <!-- Footer -->
      <footer class="main-footer d-flex justify-content-between align-items-center flex-wrap">
        <div>
          <b>SIA AKN-IPB</b> &mdash; Sistem Informasi Akuntansi &bull; <b>Sekolah Vokasi IPB University</b> &copy; <?= date('Y') ?>
        </div>
        <div class="mt-1 mt-sm-0 d-flex align-items-center">
          <span class="badge badge-light border font-mono">STANDAR SAK EMKM</span>
        </div>
      </footer>
    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="<?= base_url() ?>/template/node_modules/jquery/dist/jquery.min.js"></script>
  <script src="<?= base_url() ?>/template/node_modules/popper.js/dist/umd/popper.min.js"></script>
  <script src="<?= base_url() ?>/template/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="<?= base_url() ?>/template/node_modules/nicescroll/dist/jquery.nicescroll.min.js"></script>

  <!-- JS Libraries -->
  <script src="<?= base_url() ?>/template/node_modules/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="<?= base_url() ?>/template/node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?= base_url() ?>/template/node_modules/chart.js/dist/Chart.min.js"></script>
  <script src="<?= base_url() ?>/template/node_modules/izitoast/dist/js/iziToast.min.js"></script>
  <script src="<?= base_url() ?>/template/node_modules/sweetalert/dist/sweetalert.min.js"></script>

  <!-- Template JS Files -->
  <script src="<?= base_url() ?>/template/assets/js/stisla.js"></script>
  <script src="<?= base_url() ?>/template/assets/js/scripts.js"></script>

  <!-- Flash Message Handler via iziToast -->
  <script>
    $(document).ready(function() {
      <?php if (session()->getFlashdata('sukses') || session()->getFlashdata('success') || session()->getFlashdata('message')) : ?>
        iziToast.success({
          title: 'Berhasil',
          message: '<?= esc(session()->getFlashdata('sukses') ?? session()->getFlashdata('success') ?? session()->getFlashdata('message')) ?>',
          position: 'topRight',
          timeout: 4000
        });
      <?php endif; ?>

      <?php if (session()->getFlashdata('error') || session()->getFlashdata('errors')) : ?>
        <?php 
          $err = session()->getFlashdata('error');
          if (is_array(session()->getFlashdata('errors'))) {
            $err = implode(', ', session()->getFlashdata('errors'));
          }
        ?>
        iziToast.error({
          title: 'Perhatian',
          message: '<?= esc($err) ?>',
          position: 'topRight',
          timeout: 5000
        });
      <?php endif; ?>
    });
  </script>

  <!-- Status Pembukuan & Audit Modal -->
  <div class="modal fade" id="siaAuditModal" tabindex="-1" role="dialog" aria-labelledby="siaAuditLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header d-flex justify-content-between align-items-center">
          <div>
            <h5 class="modal-title font-weight-bold" id="siaAuditLabel" style="color: var(--color-ink);">
              <i class="fas fa-shield-alt mr-2 text-success"></i> Status Pembukuan &amp; Audit Sistem
            </h5>
            <small class="text-secondary">SIA AKN-IPB &bull; Standar SAK EMKM</small>
          </div>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body p-4">
          <div class="row mb-3">
            <div class="col-md-4 col-12 mb-3 mb-md-0">
              <div class="p-3 rounded border" style="background: var(--color-surface-muted);">
                <div class="font-mono text-muted" style="font-size: 11px;">PLATFORM ENGINE</div>
                <div class="font-weight-bold mt-1" style="font-size: 14px; color: var(--color-ink);">
                  <i class="fab fa-php mr-1"></i> PHP <?= phpversion() ?>
                </div>
                <small class="text-muted font-mono">CodeIgniter 4 &bull; MySQL</small>
              </div>
            </div>
            <div class="col-md-4 col-12 mb-3 mb-md-0">
              <div class="p-3 rounded border" style="background: var(--color-surface-muted);">
                <div class="font-mono text-muted" style="font-size: 11px;">AUTENTIKASI</div>
                <div class="font-weight-bold text-success mt-1" style="font-size: 14px;">
                  <i class="fas fa-user-check mr-1"></i> <?= logged_in() ? 'Terverifikasi' : 'Tamu' ?>
                </div>
                <small class="text-muted font-mono"><?= logged_in() ? esc(user()->username) : 'Guest' ?></small>
              </div>
            </div>
            <div class="col-md-4 col-12">
              <div class="p-3 rounded border" style="background: var(--color-surface-muted);">
                <div class="font-mono text-muted" style="font-size: 11px;">STANDAR LAPORAN</div>
                <div class="font-weight-bold text-primary mt-1" style="font-size: 14px;">
                  <i class="fas fa-book mr-1"></i> SAK EMKM
                </div>
                <small class="text-muted font-mono">Neraca Lajur 10 Kolom</small>
              </div>
            </div>
          </div>

          <h6 class="font-weight-bold font-mono mb-2" style="font-size: 12px; letter-spacing: 0.5px; color: var(--color-text-secondary);">
            PINTASAN LAPORAN KEUANGAN
          </h6>
          <div class="row">
            <div class="col-md-6 col-12 mb-2">
              <a href="<?= site_url('neracalajur') ?>" class="p-3 rounded border d-flex justify-content-between align-items-center text-decoration-none" style="background: var(--color-surface);">
                <div>
                  <div class="font-weight-bold font-mono text-dark">1. Neraca Lajur (Worksheet)</div>
                  <small class="text-secondary">Verifikasi 10 kolom debit-kredit</small>
                </div>
                <i class="fas fa-external-link-alt text-muted"></i>
              </a>
            </div>
            <div class="col-md-6 col-12 mb-2">
              <a href="<?= site_url('posting') ?>" class="p-3 rounded border d-flex justify-content-between align-items-center text-decoration-none" style="background: var(--color-surface);">
                <div>
                  <div class="font-weight-bold font-mono text-dark">2. Posting Buku Besar</div>
                  <small class="text-secondary">Periksa mutasi saldo per akun</small>
                </div>
                <i class="fas fa-external-link-alt text-muted"></i>
              </a>
            </div>
            <div class="col-md-6 col-12 mb-2">
              <a href="<?= site_url('labarugi') ?>" class="p-3 rounded border d-flex justify-content-between align-items-center text-decoration-none" style="background: var(--color-surface);">
                <div>
                  <div class="font-weight-bold font-mono text-dark">3. Laporan Laba Rugi</div>
                  <small class="text-secondary">Pendapatan vs beban usaha</small>
                </div>
                <i class="fas fa-external-link-alt text-muted"></i>
              </a>
            </div>
            <div class="col-md-6 col-12 mb-2">
              <a href="<?= site_url('jurnalumum') ?>" class="p-3 rounded border d-flex justify-content-between align-items-center text-decoration-none" style="background: var(--color-surface);">
                <div>
                  <div class="font-weight-bold font-mono text-dark">4. Jurnal Umum Lengkap</div>
                  <small class="text-secondary">Histori voucher kronologis</small>
                </div>
                <i class="fas fa-external-link-alt text-muted"></i>
              </a>
            </div>
          </div>
        </div>
        <div class="modal-footer d-flex justify-content-between">
          <small class="text-muted font-mono">SIA AKN SV-IPB &bull; Sistem Informasi Akuntansi</small>
          <button type="button" class="btn btn-outline-secondary btn-sm" data-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Page Specific JS File -->
  <?= $this->renderSection('scripts') ?>
</body>
</html>
