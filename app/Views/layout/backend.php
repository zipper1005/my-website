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
  <!-- Ambient Gradient Background -->
  <div class="ambient-navy-layer"></div>

  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
      
      <!-- Slim Top Header (Section 4) -->
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
          </ul>
          
          <!-- Search Bar with Shortcut Ctrl K -->
          <div class="search-element d-none d-md-flex align-items-center">
            <input class="form-control" type="search" id="globalSearchInput" placeholder="Cari transaksi, akun, atau laporan..." aria-label="Search">
            <span class="search-shortcut-badge">Ctrl K</span>
          </div>
        </form>

        <ul class="navbar-nav navbar-right align-items-center">
          <!-- Notification Bell -->
          <li class="dropdown dropdown-list-toggle">
            <a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg beep">
              <i class="far fa-bell"></i>
            </a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right">
              <div class="dropdown-header">
                Notifikasi Sistem
                <div class="float-right">
                  <a href="#">Tandai Dibaca</a>
                </div>
              </div>
              <div class="dropdown-list-content dropdown-list-icons">
                <a href="<?= site_url('posting') ?>" class="dropdown-item dropdown-item-unread">
                  <div class="dropdown-item-icon bg-success text-white">
                    <i class="fas fa-check-circle"></i>
                  </div>
                  <div class="dropdown-item-desc">
                    Posting Buku Besar Terverifikasi Seimbang
                    <div class="time text-primary">Baru saja</div>
                  </div>
                </a>
                <a href="<?= site_url('neracalajur') ?>" class="dropdown-item">
                  <div class="dropdown-item-icon bg-info text-white">
                    <i class="fas fa-table"></i>
                  </div>
                  <div class="dropdown-item-desc">
                    Neraca Lajur 10 Kolom siap diekspor
                    <div class="time">Hari ini</div>
                  </div>
                </a>
                <a href="<?= site_url('labarugi') ?>" class="dropdown-item">
                  <div class="dropdown-item-icon bg-primary text-white">
                    <i class="fas fa-chart-line"></i>
                  </div>
                  <div class="dropdown-item-desc">
                    Laporan Laba Rugi periode berjalan terupdate
                    <div class="time">Kemarin</div>
                  </div>
                </a>
              </div>
              <div class="dropdown-footer text-center">
                <a href="<?= site_url('transaksi') ?>">Lihat Semua Transaksi <i class="fas fa-chevron-right"></i></a>
              </div>
            </div>
          </li>

          <!-- Telemetry Quick Button -->
          <li class="d-none d-lg-inline-block mr-2">
            <button type="button" class="btn btn-outline-secondary btn-sm font-mono" data-toggle="modal" data-target="#siaTelemetryModal" title="Sistem Audit & Telemetri Real-Time">
              <span class="sia-pulse-dot mr-1"></span>
              <i class="fas fa-shield-alt mr-1 text-primary"></i> Audit Trail
            </button>
          </li>

          <!-- User Profile Dropdown (Section 4: User Profile & Role Admin) -->
          <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user d-flex align-items-center">
              <img alt="User Avatar" src="<?= base_url() ?>/template/assets/img/avatar/avatar-1.png" class="rounded-circle mr-2" style="width: 34px; height: 34px; border: 1px solid var(--border-accent);">
              <div class="d-none d-lg-inline-block text-left" style="line-height: 1.2;">
                <?php 
                  $activeUsername = user()->username ?? 'admin';
                  $activeName = ($activeUsername === 'mrajibprasetya' || (logged_in() && user()->id == 4)) ? 'Muhamad Rajib Prasetya' : (logged_in() ? esc($activeUsername) : 'Muhamad Rajib Prasetya');
                ?>
                <div class="font-weight-600 text-white" style="font-size: 0.88rem;"><?= $activeName ?></div>
                <small class="text-secondary font-mono" style="font-size: 11px;">
                  <i class="fas fa-circle text-success mr-1" style="font-size: 7px;"></i> Admin
                </small>
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow-lg">
              <div class="dropdown-title">
                Masuk sebagai <b><?= $activeName ?></b>
              </div>
              <?php if (in_groups('admin')) : ?>
                <a href="<?= site_url('users') ?>" class="dropdown-item has-icon">
                  <i class="fas fa-users-cog"></i> Kelola Pengguna
                </a>
              <?php endif; ?>
              <a href="<?= site_url('neracalajur') ?>" class="dropdown-item has-icon">
                <i class="fas fa-table"></i> Neraca Lajur
              </a>
              <div class="dropdown-divider"></div>
              <a href="<?= site_url('logout') ?>" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Keluar (Logout)
              </a>
            </div>
          </li>
        </ul>
      </nav>

      <!-- Sidebar (Section 3 & 14 Logo) -->
      <div class="main-sidebar">
        <aside id="sidebar-wrapper">
          <!-- Logo Brand SIA AKN-IPB (Letter A + Ledger) -->
          <div class="sidebar-brand">
            <a href="<?= site_url('/') ?>" class="d-flex align-items-center">
              <div class="sidebar-logo-icon mr-2">
                <svg width="24" height="24" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M10 27L18 9L26 27" stroke="#FFFFFF" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M13 21H23" stroke="#FFFFFF" stroke-width="3" stroke-linecap="round"/>
                  <rect x="25" y="16" width="3.5" height="11" rx="1.75" fill="#4FA3FF" />
                  <rect x="30" y="11" width="3.5" height="16" rx="1.75" fill="#20C997" />
                </svg>
              </div>
              <div class="text-left" style="line-height: 1.15;">
                <div class="font-weight-bold text-white" style="letter-spacing: -0.02em; font-size: 1.05rem;">SIA AKN-IPB</div>
                <small class="text-secondary font-mono" style="font-size: 10px; letter-spacing: 0.5px;">SEKOLAH VOKASI IPB</small>
              </div>
            </a>
          </div>
          
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="<?= site_url('/') ?>">
              <span class="sidebar-logo-icon" style="margin: 0;">A</span>
            </a>
          </div>

          <!-- Menu Utama Sidebar -->
          <ul class="sidebar-menu">
            <?= $this->include("layout/menu") ?>
          </ul>

          <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="<?= site_url('transaksi/new') ?>" class="btn btn-primary btn-block font-weight-bold shadow-sm">
              <i class="fas fa-plus mr-1"></i> Buat Transaksi
            </a>
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
            <i class="fas fa-globe text-primary mr-1"></i> siarajib.software
          </span>
          <span class="badge badge-light border font-mono">SAK EMKM STANDARD</span>
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
  <script src="<?= base_url() ?>/template/assets/js/custom.js"></script>

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

  <!-- SIA Live Audit & Telemetry Inspection Modal -->
  <div class="modal fade" id="siaTelemetryModal" tabindex="-1" role="dialog" aria-labelledby="siaTelemetryLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content border">
        <div class="modal-header d-flex justify-content-between align-items-center">
          <div>
            <span class="badge badge-primary font-mono mb-1">
              <span class="sia-pulse-dot mr-1"></span> LIVE AUDIT ENGINE
            </span>
            <h5 class="modal-title font-weight-bold text-white mb-0" id="siaTelemetryLabel">
              SIA AKN-IPB &mdash; Audit Trail &amp; Verification
            </h5>
          </div>
          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body p-4">
          <div class="row mb-4">
            <div class="col-md-4 col-12 mb-3 mb-md-0">
              <div class="p-3 rounded border" style="background: #081D3A; border-color: var(--border-subtle) !important;">
                <div class="text-secondary font-mono" style="font-size: 0.72rem;">CORE ENGINE</div>
                <div class="font-weight-bold text-white mt-1" style="font-size: 1rem;">
                  <i class="fab fa-php text-primary mr-1"></i> PHP <?= phpversion() ?>
                </div>
                <small class="text-secondary font-mono">CodeIgniter 4 &bull; MySQL</small>
              </div>
            </div>
            <div class="col-md-4 col-12 mb-3 mb-md-0">
              <div class="p-3 rounded border" style="background: #081D3A; border-color: var(--border-subtle) !important;">
                <div class="text-secondary font-mono" style="font-size: 0.72rem;">STATUS SESI</div>
                <div class="font-weight-bold text-success mt-1" style="font-size: 1rem;">
                  <i class="fas fa-shield-alt mr-1"></i> <?= logged_in() ? 'Authenticated' : 'Guest' ?>
                </div>
                <small class="text-secondary font-mono"><?= logged_in() ? esc(user()->username) : 'Guest' ?></small>
              </div>
            </div>
            <div class="col-md-4 col-12">
              <div class="p-3 rounded border" style="background: #081D3A; border-color: var(--border-subtle) !important;">
                <div class="text-secondary font-mono" style="font-size: 0.72rem;">STANDAR AKUNTANSI</div>
                <div class="font-weight-bold text-info mt-1" style="font-size: 1rem;">
                  <i class="fas fa-balance-scale mr-1"></i> SAK EMKM
                </div>
                <small class="text-secondary font-mono">Neraca Lajur 10 Kolom</small>
              </div>
            </div>
          </div>

          <h6 class="font-weight-bold text-white font-mono mb-2" style="font-size: 0.82rem; letter-spacing: 0.5px;">
            <i class="fas fa-bolt text-warning mr-1"></i> AUDIT SHORTCUTS
          </h6>
          <div class="row">
            <div class="col-md-6 col-12 mb-2">
              <a href="<?= site_url('neracalajur') ?>" class="p-3 rounded border d-flex justify-content-between align-items-center text-decoration-none" style="background: #06162E; border-color: var(--border-subtle) !important; color: #fff;">
                <div>
                  <div class="font-weight-bold font-mono">1. Neraca Lajur (Worksheet)</div>
                  <small class="text-secondary">Verifikasi 10 kolom debit-kredit</small>
                </div>
                <i class="fas fa-external-link-alt text-primary"></i>
              </a>
            </div>
            <div class="col-md-6 col-12 mb-2">
              <a href="<?= site_url('posting') ?>" class="p-3 rounded border d-flex justify-content-between align-items-center text-decoration-none" style="background: #06162E; border-color: var(--border-subtle) !important; color: #fff;">
                <div>
                  <div class="font-weight-bold font-mono">2. Posting Buku Besar</div>
                  <small class="text-secondary">Periksa mutasi saldo per akun</small>
                </div>
                <i class="fas fa-external-link-alt text-primary"></i>
              </a>
            </div>
            <div class="col-md-6 col-12 mb-2">
              <a href="<?= site_url('labarugi') ?>" class="p-3 rounded border d-flex justify-content-between align-items-center text-decoration-none" style="background: #06162E; border-color: var(--border-subtle) !important; color: #fff;">
                <div>
                  <div class="font-weight-bold font-mono">3. Laporan Laba Rugi</div>
                  <small class="text-secondary">Pendapatan vs beban usaha</small>
                </div>
                <i class="fas fa-external-link-alt text-primary"></i>
              </a>
            </div>
            <div class="col-md-6 col-12 mb-2">
              <a href="<?= site_url('jurnalumum') ?>" class="p-3 rounded border d-flex justify-content-between align-items-center text-decoration-none" style="background: #06162E; border-color: var(--border-subtle) !important; color: #fff;">
                <div>
                  <div class="font-weight-bold font-mono">4. Jurnal Umum Lengkap</div>
                  <small class="text-secondary">Histori entri kronologis</small>
                </div>
                <i class="fas fa-external-link-alt text-primary"></i>
              </a>
            </div>
          </div>
        </div>
        <div class="modal-footer d-flex justify-content-between">
          <small class="text-secondary font-mono">SIA AKN SV-IPB &bull; Sistem Informasi Akuntansi</small>
          <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Page Specific JS File -->
  <?= $this->renderSection('scripts') ?>
</body>
</html>
