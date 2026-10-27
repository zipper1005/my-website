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
      
      <!-- Topbar Header -->
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
          <!-- Logo Brand SIA AKN-IPB -->
          <div class="sidebar-brand">
            <a href="<?= site_url('/') ?>">
              <div class="sidebar-logo-icon mr-2">
                <i class="fas fa-university"></i>
              </div>
              <div class="text-left" style="line-height: 1.15;">
                <div style="letter-spacing: -0.02em; font-size: 1.02rem; font-weight: 700; color: #FFFFFF;">SIA AKN-IPB</div>
                <small style="font-size: 9.5px; letter-spacing: 0.5px; color: #85B095; font-family: var(--font-mono);">SEKOLAH VOKASI IPB</small>
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

          <div class="sidebar-cta-box hide-sidebar-mini">
            <a href="<?= site_url('transaksi/new') ?>" class="sidebar-cta-btn">
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