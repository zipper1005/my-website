  <li class="menu-header">Menu Utama</li>
  
  <!-- 1. Dashboard -->
  <li class="<?= (uri_string() == '' || uri_string() == '/') ? 'active' : '' ?>">
    <a class="nav-link" href="<?= site_url('/') ?>">
      <i class="fas fa-th-large"></i> <span>Dashboard</span>
    </a>
  </li>

  <!-- 2. Transaksi -->
  <li class="nav-item dropdown <?= in_array(uri_string(), ['transaksi', 'transaksi/new', 'penyesuaian']) ? 'active' : '' ?>">
    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
      <i class="fas fa-exchange-alt"></i> <span>Transaksi</span>
    </a>
    <ul class="dropdown-menu">
      <li class="<?= uri_string() == 'transaksi' ? 'active' : '' ?>"><a class="nav-link" href="<?= site_url('transaksi') ?>">Daftar Transaksi</a></li>
      <li class="<?= uri_string() == 'transaksi/new' ? 'active' : '' ?>"><a class="nav-link" href="<?= site_url('transaksi/new') ?>">Buat Transaksi</a></li>
      <li class="<?= uri_string() == 'penyesuaian' ? 'active' : '' ?>"><a class="nav-link" href="<?= site_url('penyesuaian') ?>">Penyesuaian</a></li>
    </ul>
  </li>

  <!-- 3. Jurnal -->
  <li class="nav-item dropdown <?= in_array(uri_string(), ['jurnalumum', 'jurnalpenyesuaian']) ? 'active' : '' ?>">
    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
      <i class="fas fa-book"></i> <span>Jurnal</span>
    </a>
    <ul class="dropdown-menu">
      <li class="<?= uri_string() == 'jurnalumum' ? 'active' : '' ?>"><a class="nav-link" href="<?= site_url('jurnalumum') ?>">Jurnal Umum</a></li>
      <li class="<?= uri_string() == 'jurnalpenyesuaian' ? 'active' : '' ?>"><a class="nav-link" href="<?= site_url('jurnalpenyesuaian') ?>">Jurnal Penyesuaian</a></li>
    </ul>
  </li>

  <!-- 4. Buku Besar -->
  <li class="nav-item dropdown <?= in_array(uri_string(), ['posting', 'neracasaldo']) ? 'active' : '' ?>">
    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
      <i class="fas fa-clipboard-list"></i> <span>Buku Besar</span>
    </a>
    <ul class="dropdown-menu">
      <li class="<?= uri_string() == 'posting' ? 'active' : '' ?>"><a class="nav-link" href="<?= site_url('posting') ?>">Posting Buku Besar</a></li>
      <li class="<?= uri_string() == 'neracasaldo' ? 'active' : '' ?>"><a class="nav-link" href="<?= site_url('neracasaldo') ?>">Neraca Saldo</a></li>
    </ul>
  </li>

  <!-- 5. Laporan -->
  <li class="nav-item dropdown <?= in_array(uri_string(), ['labarugi', 'neraca', 'aruskas', 'perubahanmodal', 'neracalajur']) ? 'active' : '' ?>">
    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
      <i class="fas fa-chart-line"></i> <span>Laporan</span>
    </a>
    <ul class="dropdown-menu">
      <li class="<?= uri_string() == 'labarugi' ? 'active' : '' ?>"><a class="nav-link" href="<?= site_url('labarugi') ?>">Laporan Laba Rugi</a></li>
      <li class="<?= uri_string() == 'neraca' ? 'active' : '' ?>"><a class="nav-link" href="<?= site_url('neraca') ?>">Neraca Keuangan</a></li>
      <li class="<?= uri_string() == 'aruskas' ? 'active' : '' ?>"><a class="nav-link" href="<?= site_url('aruskas') ?>">Arus Kas</a></li>
      <li class="<?= uri_string() == 'perubahanmodal' ? 'active' : '' ?>"><a class="nav-link" href="<?= site_url('perubahanmodal') ?>">Perubahan Ekuitas</a></li>
      <li class="<?= uri_string() == 'neracalajur' ? 'active' : '' ?>"><a class="nav-link" href="<?= site_url('neracalajur') ?>">Neraca Lajur 10 Kolom</a></li>
    </ul>
  </li>

  <!-- 6. Master Data -->
  <li class="menu-header">Master Data</li>
  <li class="nav-item dropdown <?= in_array(uri_string(), ['akun1', 'akun2', 'akun3']) ? 'active' : '' ?>">
    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
      <i class="fas fa-layer-group"></i> <span>Chart of Accounts</span>
    </a>
    <ul class="dropdown-menu">
      <li class="<?= (strpos(uri_string(), 'akun1') === 0) ? 'active' : '' ?>"><a class="nav-link" href="<?= site_url('akun1') ?>">Akun - 1 (Header)</a></li>
      <li class="<?= (strpos(uri_string(), 'akun2') === 0) ? 'active' : '' ?>"><a class="nav-link" href="<?= site_url('akun2') ?>">Akun - 2 (Sub Header)</a></li>
      <li class="<?= (strpos(uri_string(), 'akun3') === 0) ? 'active' : '' ?>"><a class="nav-link" href="<?= site_url('akun3') ?>">Akun - 3 (Buku Besar)</a></li>
    </ul>
  </li>

  <!-- 7. Pengaturan -->
  <?php if (in_groups('admin')) : ?>
  <li class="menu-header">Pengaturan</li>
  <li class="<?= (strpos(uri_string(), 'users') === 0) ? 'active' : '' ?>">
    <a class="nav-link" href="<?= site_url('users') ?>">
      <i class="fas fa-users-cog"></i> <span>Data Pengguna</span>
    </a>
  </li>
  <?php endif; ?>
