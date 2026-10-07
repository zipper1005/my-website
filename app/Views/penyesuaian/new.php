<?= $this->extend('layout/backend') ?>

<?= $this->section('title') ?>
Studio Penyesuaian &bull; SIA AKN-IPB
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<section class="section">
  <!-- Top Navigation & Breadcrumb -->
  <div class="d-flex justify-content-between align-items-center flex-wrap mb-4 pb-2">
    <div>
      <div class="text-secondary font-weight-500 mb-1" style="font-size: 0.88rem;">
        <a href="<?= site_url('penyesuaian') ?>" class="text-secondary text-decoration-none">
          <i class="fas fa-arrow-left mr-1"></i> Penyesuaian
        </a>
        <span class="mx-2">&bull;</span>
        <span class="text-primary font-mono">Amortisasi &amp; Akrual Studio</span>
      </div>
      <h2 class="text-white font-weight-bold mb-0" style="letter-spacing: -0.03em; font-size: 1.65rem;">
        Entri Jurnal Penyesuaian (AJP)
      </h2>
    </div>
    <div class="mt-3 mt-md-0 d-flex align-items-center">
      <span class="badge badge-light border font-mono px-3 py-2 mr-2">
        <i class="fas fa-calculator text-warning mr-1"></i> Auto Amortization Calc
      </span>
      <a href="<?= site_url('penyesuaian') ?>" class="btn btn-outline-secondary font-weight-600">
        <i class="fas fa-list mr-1"></i> Daftar Penyesuaian
      </a>
    </div>
  </div>

  <div class="section-body">
    <form method="post" action="<?= site_url('penyesuaian') ?>" id="formPenyesuaian">
      <?= csrf_field() ?>

      <!-- 1. Parameter Penyesuaian & Amortisasi -->
      <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
          <div>
            <h4 class="mb-0 text-white font-weight-bold">1. Parameter Alokasi &amp; Amortisasi Nilai</h4>
            <small class="text-secondary">Hitung pembagian beban atau pendapatan per bulan secara proporsional</small>
          </div>
          <span class="badge badge-primary font-mono">BAGIAN 1 / 2</span>
        </div>
        <div class="card-body p-4">
          <div class="row">
            <div class="col-md-6 col-12 mb-3">
              <div class="form-group mb-0">
                <label>Tanggal Transaksi Penyesuaian <span class="text-danger">*</span></label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text font-mono" style="background: #081D3A; border-color: var(--border-subtle); color: var(--text-secondary);">
                      <i class="far fa-calendar-alt"></i>
                    </span>
                  </div>
                  <input type="date" class="form-control font-mono" name="tanggal" value="<?= date('Y-m-d') ?>" required>
                </div>
              </div>
            </div>

            <div class="col-md-6 col-12 mb-3">
              <div class="form-group mb-0">
                <label>Deskripsi Penyesuaian <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="deskripsi" placeholder="Misal: Penyesuaian sewa gedung 1 tahun dibayar dimuka" required>
              </div>
            </div>
          </div>

          <div class="row mt-2">
            <div class="col-md-4 col-12 mb-3">
              <div class="form-group mb-0">
                <label>Total Nilai yang Disesuaikan (Rp) <span class="text-danger">*</span></label>
                <input type="number" class="form-control font-mono" name="nilai" id="nilai" placeholder="Contoh: 12000000" onkeyup="hitung()" required>
              </div>
            </div>

            <div class="col-md-4 col-12 mb-3">
              <div class="form-group mb-0">
                <label>Masa Amortisasi / Waktu (Bulan) <span class="text-danger">*</span></label>
                <input type="number" class="form-control font-mono" name="waktu" id="waktu" placeholder="Contoh: 12" onkeyup="hitung()" required>
              </div>
            </div>

            <div class="col-md-4 col-12 mb-3">
              <div class="form-group mb-0">
                <label>Beban / Bulan yang Disesuaikan (Rp)</label>
                <input type="number" class="form-control font-mono font-weight-bold" name="jumlah" id="jumlah" placeholder="Otomatis dihitung..." readonly required style="background: #081D3A !important; color: #38BDF8 !important;">
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- 2. Dynamic Ledger Matrix -->
      <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
          <div>
            <h4 class="mb-0 text-white font-weight-bold">2. Pasangan Akun Buku Besar Penyesuaian</h4>
            <small class="text-secondary">Pilih akun beban/pendapatan yang didebet/dikreditkan</small>
          </div>
          <button type="button" class="btn btn-outline-primary btn-sm font-weight-bold" id="barisBaru">
            <i class="fas fa-plus mr-1"></i> Tambah Baris Akun
          </button>
        </div>
        <div class="card-body p-4">
          <div class="table-responsive">
            <table class="table table-bordered table-md" id="tableLoop">
              <thead>
                <tr>
                  <th class="text-center" style="width: 5%;">#</th>
                  <th style="width: 35%;">Akun Buku Besar (COA 3)</th>
                  <th style="width: 20%;" class="text-right">Nominal Debit (Rp)</th>
                  <th style="width: 20%;" class="text-right">Nominal Kredit (Rp)</th>
                  <th style="width: 14%;" class="text-center">Status Mutasi</th>
                  <th class="text-center" style="width: 6%;">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <!-- Baris dibuat otomatis via JavaScript custom.js -->
              </tbody>
            </table>
          </div>

          <!-- Alert jika terjadi selisih -->
          <div id="balanceWarningAlert" class="alert alert-danger mt-3 mb-0" style="display: none; background-color: #350B15; border-color: #F43F5E; color: #FF7B90;">
            <div class="d-flex align-items-center">
              <i class="fas fa-exclamation-triangle fa-2x mr-3 text-danger"></i>
              <div>
                <strong class="text-white">Perhatian: Jurnal Penyesuaian Belum Seimbang!</strong>
                <div class="small">Total nominal Debit harus sama dengan Kredit agar tidak merusak neraca saldo disesuaikan.</div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- 3. Balancing Telemetry Dock -->
      <div class="balance-dock d-flex justify-content-between align-items-center flex-wrap">
        <div class="d-flex align-items-center flex-wrap mr-3 my-1">
          <div class="mr-4">
            <small class="text-secondary font-mono d-block" style="font-size: 11px;">TOTAL DEBIT</small>
            <span class="font-mono font-weight-bold text-white" id="liveDebitTotal" style="font-size: 1.15rem;">Rp 0</span>
          </div>
          <div class="mr-4">
            <small class="text-secondary font-mono d-block" style="font-size: 11px;">TOTAL KREDIT</small>
            <span class="font-mono font-weight-bold text-white" id="liveKreditTotal" style="font-size: 1.15rem;">Rp 0</span>
          </div>
          <div class="mr-4">
            <small class="text-secondary font-mono d-block" style="font-size: 11px;">SELISIH (DELTA)</small>
            <span class="font-mono font-weight-bold text-danger" id="liveDeltaTotal" style="font-size: 1.15rem;">Rp 0</span>
          </div>
          <div>
            <span class="balance-pill unbalanced" id="liveBalancePill">
              <i class="fas fa-info-circle mr-1"></i> INPUT NOMINAL DEBIT &amp; KREDIT
            </span>
          </div>
        </div>

        <div class="d-flex align-items-center my-1">
          <a href="<?= site_url('penyesuaian') ?>" class="btn btn-outline-secondary mr-2">
            Batal
          </a>
          <button type="submit" class="btn btn-primary font-weight-bold shadow-sm" id="submitTransaksiBtn">
            <i class="fas fa-check-circle mr-1"></i> Simpan Penyesuaian
          </button>
        </div>
      </div>
    </form>
  </div>
</section>

<script>
  let urlAkun3 = "<?= site_url('penyesuaian/akun3') ?>";
  let urlStatus = "<?= site_url('penyesuaian/status') ?>";
</script>

<?= $this->endSection() ?>
