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

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="<?= base_url() ?>/template/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>/template/node_modules/izitoast/dist/css/iziToast.min.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="<?= base_url() ?>/template/assets/css/style.css">
  <link rel="stylesheet" href="<?= base_url() ?>/template/assets/css/components.css">
  <link rel="stylesheet" href="<?= base_url() ?>/template/assets/css/custom.css">
  <?= $this->renderSection('styles') ?>
</head>

<body>
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
      
      <!-- Topbar Header (PRD v2.0 Bab 4.3) -->
      <nav class="navbar navbar-expand-lg main-navbar">
        <div class="d-flex align-items-center mr-auto">
          <a href="#" data-toggle="sidebar" class="nav-link nav-link-lg mr-2" aria-label="Buka/Tutup Navigasi">
            <i class="fas fa-bars"></i>
          </a>
          
          <div class="topbar-work-area d-none d-sm-flex align-items-center">
            <span class="topbar-crumb-root font-weight-bold">SIA AKN &bull; IPB</span>
            <span class="mx-2 text-muted">&bull;</span>
            <span class="topbar-period-pill font-mono">
              <i class="far fa-calendar-alt mr-1 text-success"></i> Periode: <b>Desember 2023</b>
            </span>
          </div>
        </div>

        <ul class="navbar-nav navbar-right align-items-center">
          <!-- Notification Dropdown -->
          <li class="dropdown dropdown-list-toggle">
            <a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg beep">
              <i class="far fa-bell"></i>
            </a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right">
              <div class="dropdown-header">
                Notifikasi Sistem
                <div class="float-right">
                  <a href="#" class="text-secondary" style="font-size: 11px;">Tandai Dibaca</a>
                </div>
              </div>
              <div class="dropdown-list-content dropdown-list-icons">
                <a href="<?= site_url('posting') ?>" class="dropdown-item dropdown-item-unread">
                  <div class="dropdown-item-icon bg-success text-white">
                    <i class="fas fa-check-circle"></i>
                  </div>
                  <div class="dropdown-item-desc">
                    <b>Posting Buku Besar</b> mutasi saldo terverifikasi seimbang
                    <div class="time text-muted">Berdasarkan data jurnal</div>
                  </div>
                </a>
                <a href="<?= site_url('neracalajur') ?>" class="dropdown-item">
                  <div class="dropdown-item-icon bg-primary text-white">
                    <i class="fas fa-table"></i>
                  </div>
                  <div class="dropdown-item-desc">
                    <b>Neraca Lajur 10 Kolom</b> siap diekspor ke PDF
                    <div class="time text-muted">Standar SAK EMKM</div>
                  </div>
                </a>
                <a href="<?= site_url('labarugi') ?>" class="dropdown-item">
                  <div class="dropdown-item-icon bg-info text-white">
                    <i class="fas fa-chart-line"></i>
                  </div>
                  <div class="dropdown-item-desc">
                    <b>Laporan Laba Rugi</b> perhitungan pendapatan &amp; beban
                    <div class="time text-muted">Periode pembukuan</div>
                  </div>
                </a>
              </div>
              <div class="dropdown-footer text-center">
                <a href="<?= site_url('transaksi') ?>">Lihat Seluruh Transaksi <i class="fas fa-chevron-right ml-1"></i></a>
              </div>
            </div>
          </li>

          <!-- Audit Trail Quick Modal Button -->
          <li class="d-none d-lg-inline-block mr-2">
            <button type="button" class="btn btn-outline-secondary btn-sm" data-toggle="modal" data-target="#siaAuditModal" title="Audit Trail & Status Sistem">
              <i class="fas fa-shield-alt mr-1 text-success"></i> Status Pembukuan
            </button>
          </li>

          <!-- User Profile Dropdown -->
          <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user d-flex align-items-center">
              <img alt="User Avatar" src="<?= base_url() ?>/template/assets/img/avatar/avatar-1.png" class="rounded-circle mr-2" style="width: 32px; height: 32px; border: 1px solid var(--border-medium);">
              <div class="d-none d-lg-inline-block text-left" style="line-height: 1.2;">
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
                ?>
                <div class="font-weight-600" style="font-size: 0.88rem; color: var(--text-primary);"><?= $activeDisplayName ?></div>
                <div class="user-role-badge mt-1"><?= $userRole ?></div>
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <div class="dropdown-title">
                Masuk sebagai <b><?= $activeDisplayName ?></b>
              </div>
              <?php if (function_exists('in_groups') && in_groups('admin')) : ?>
                <a href="<?= site_url('users') ?>" class="dropdown-item has-icon">
                  <i class="fas fa-users-cog"></i> Kelola Pengguna
                </a>
              <?php endif; ?>
              <a href="<?= site_url('neracalajur') ?>" class="dropdown-item has-icon">
                <i class="fas fa-table"></i> Neraca Lajur 10 Kolom
              </a>
              <a href="<?= site_url('posting') ?>" class="dropdown-item has-icon">
                <i class="fas fa-clipboard-list"></i> Posting Buku Besar
              </a>
              <div class="dropdown-divider"></div>
              <a href="<?= site_url('logout') ?>" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Keluar (Logout)
              </a>
            </div>
          </li>
        </ul>
      </nav>

      <!-- Sidebar -->
      <div class="main-sidebar">
        <aside id="sidebar-wrapper">
          <!-- Logo Brand SIA AKN-IPB (PRD v2.0 Bab 3.1 & 4.2) -->
          <div class="sidebar-brand">
            <a href="<?= site_url('/') ?>" class="d-flex align-items-center">
              <div class="sidebar-logo-icon mr-2">
                <!-- Original Geometric Ledger SVG Logo -->
                <svg width="28" height="28" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg" aria-label="SIA Logo">
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
              </div>
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
                <line x1="12" y1="10" x2="25" y2="10" stroke="#E5F1E9" stroke-width="1.5" stroke-linecap="round"/>
                <line x1="19" y1="10" x2="19" y2="22" stroke="#E5F1E9" stroke-width="1.2" stroke-dasharray="2 2"/>
                <line x1="12" y1="16" x2="25" y2="16" stroke="#A7C7B7" stroke-width="1.2" stroke-linecap="round"/>
                <line x1="12" y1="21" x2="25" y2="21" stroke="#E5F1E9" stroke-width="1.5" stroke-linecap="round"/>
              </svg>
            </a>
          </div>

          <!-- Menu Utama Sidebar -->
          <ul class="sidebar-menu">
            <?= $this->include("layout/menu") ?>
          </ul>

          <div class="sidebar-cta-box hide-sidebar-mini">
            <a href="<?= site_url('transaksi/new') ?>" class="sidebar-cta-btn">
              <i class="fas fa-plus mr-1"></i> Buat Transaksi
            </a>
          </div>

          <!-- Sidebar Footer User Profile (PRD v2.0 Bab 4.2) -->
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
          <span class="badge badge-light border font-mono mr-2">
            <i class="fas fa-globe text-success mr-1"></i> siarajib.free.nf
          </span>
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

  <!-- Template JS File -->
  <script src="<?= base_url() ?>/template/assets/js/stisla.js"></script>
  <script src="<?= base_url() ?>/template/assets/js/scripts.js"></script>

  <!-- Global Keyboard Shortcut (Ctrl K / Cmd K) for Search Focus -->
  <script>
    document.addEventListener('keydown', function(e) {
      if ((e.ctrlKey || e.metaKey) && e.key.toLowerCase() === 'k') {
        e.preventDefault();
        const searchInput = document.getElementById('globalSearchInput');
        if (searchInput) {
          searchInput.focus();
        }
      }
    });
  </script>

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
            <h5 class="modal-title font-weight-bold" id="siaAuditLabel" style="color: var(--brand-forest);">
              <i class="fas fa-shield-alt mr-2 text-success"></i> Status Pembukuan &amp; Audit Sistem
            </h5>
            <small class="text-secondary">SIA AKN-IPB &bull; Sistem Informasi Akuntansi Terpadu</small>
          </div>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body p-4">
          <div class="row mb-4">
            <div class="col-md-4 col-12 mb-3 mb-md-0">
              <div class="p-3 rounded border bg-light">
                <div class="text-secondary font-mono" style="font-size: 0.72rem;">PLATFORM ENGINE</div>
                <div class="font-weight-bold mt-1" style="font-size: 0.95rem; color: var(--brand-forest);">
                  <i class="fab fa-php mr-1"></i> PHP <?= phpversion() ?>
                </div>
                <small class="text-muted font-mono">CodeIgniter 4 &bull; MySQL</small>
              </div>
            </div>
            <div class="col-md-4 col-12 mb-3 mb-md-0">
              <div class="p-3 rounded border bg-light">
                <div class="text-secondary font-mono" style="font-size: 0.72rem;">STATUS AUTENTIKASI</div>
                <div class="font-weight-bold text-success mt-1" style="font-size: 0.95rem;">
                  <i class="fas fa-user-check mr-1"></i> <?= logged_in() ? 'Terverifikasi' : 'Tamu' ?>
                </div>
                <small class="text-muted font-mono"><?= logged_in() ? esc(user()->username) : 'Guest' ?></small>
              </div>
            </div>
            <div class="col-md-4 col-12">
              <div class="p-3 rounded border bg-light">
                <div class="text-secondary font-mono" style="font-size: 0.72rem;">STANDAR LAPORAN</div>
                <div class="font-weight-bold text-primary mt-1" style="font-size: 0.95rem;">
                  <i class="fas fa-book mr-1"></i> SAK EMKM
                </div>
                <small class="text-muted font-mono">Neraca Lajur 10 Kolom</small>
              </div>
            </div>
          </div>

          <h6 class="font-weight-bold font-mono mb-2" style="font-size: 0.82rem; letter-spacing: 0.5px; color: var(--text-secondary);">
            <i class="fas fa-link mr-1"></i> PINTASAN LAPORAN KEUANGAN
          </h6>
          <div class="row">
            <div class="col-md-6 col-12 mb-2">
              <a href="<?= site_url('neracalajur') ?>" class="p-3 rounded border d-flex justify-content-between align-items-center text-decoration-none bg-white">
                <div>
                  <div class="font-weight-bold font-mono text-dark">1. Neraca Lajur (Worksheet)</div>
                  <small class="text-secondary">Verifikasi 10 kolom debit-kredit</small>
                </div>
                <i class="fas fa-external-link-alt text-muted"></i>
              </a>
            </div>
            <div class="col-md-6 col-12 mb-2">
              <a href="<?= site_url('posting') ?>" class="p-3 rounded border d-flex justify-content-between align-items-center text-decoration-none bg-white">
                <div>
                  <div class="font-weight-bold font-mono text-dark">2. Posting Buku Besar</div>
                  <small class="text-secondary">Periksa mutasi saldo per akun</small>
                </div>
                <i class="fas fa-external-link-alt text-muted"></i>
              </a>
            </div>
            <div class="col-md-6 col-12 mb-2">
              <a href="<?= site_url('labarugi') ?>" class="p-3 rounded border d-flex justify-content-between align-items-center text-decoration-none bg-white">
                <div>
                  <div class="font-weight-bold font-mono text-dark">3. Laporan Laba Rugi</div>
                  <small class="text-secondary">Pendapatan vs beban usaha</small>
                </div>
                <i class="fas fa-external-link-alt text-muted"></i>
              </a>
            </div>
            <div class="col-md-6 col-12 mb-2">
              <a href="<?= site_url('jurnalumum') ?>" class="p-3 rounded border d-flex justify-content-between align-items-center text-decoration-none bg-white">
                <div>
                  <div class="font-weight-bold font-mono text-dark">4. Jurnal Umum Lengkap</div>
                  <small class="text-secondary">Histori entri voucher kronologis</small>
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