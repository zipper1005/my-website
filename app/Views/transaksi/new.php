<?= $this->extend('layout/backend') ?>

<?= $this->section('title') ?>
Studio Voucher Transaksi &bull; SIA AKN-IPB
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<section class="section">
  <!-- Header Navigasi & Breadcrumb -->
  <div class="d-flex justify-content-between align-items-center flex-wrap mb-4 pb-2">
    <div>
      <div class="text-secondary font-weight-500 mb-1" style="font-size: 0.88rem;">
        <a href="<?= site_url('transaksi') ?>" class="text-secondary text-decoration-none">
          <i class="fas fa-arrow-left mr-1"></i> Transaksi
        </a>
        <span class="mx-2">&bull;</span>
        <span class="text-primary font-mono">Voucher Studio</span>
      </div>
      <h2 class="text-white font-weight-bold mb-0" style="letter-spacing: -0.03em; font-size: 1.65rem;">
        Entri Voucher Transaksi Jurnal
      </h2>
    </div>
    <div class="mt-3 mt-md-0 d-flex align-items-center">
      <span class="badge badge-light border font-mono px-3 py-2 mr-2">
        <i class="fas fa-shield-alt text-success mr-1"></i> Double-Entry SAK EMKM
      </span>
      <a href="<?= site_url('transaksi') ?>" class="btn btn-outline-secondary font-weight-600">
        <i class="fas fa-list mr-1"></i> Daftar Transaksi
      </a>
    </div>
  </div>

  <div class="section-body">
    <form method="post" action="<?= site_url('transaksi') ?>" id="formVoucherTransaksi">
      <?= csrf_field() ?>

      <!-- 1. Metadata Dokumen Transaksi -->
      <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
          <div>
            <h4 class="mb-0 text-white font-weight-bold">1. Dokumen Sumber &amp; Informasi Header</h4>
            <small class="text-secondary">Identifikasi bukti pembukuan dan tanggal pengakuan</small>
          </div>
          <span class="badge badge-primary font-mono">BAGIAN 1 / 2</span>
        </div>
        <div class="card-body p-4">
          <div class="row">
            <div class="col-md-6 col-12 mb-3">
              <div class="form-group mb-0">
                <label class="d-flex justify-content-between align-items-center">
                  <span>Nomor Kwitansi / Bukti Transaksi <span class="text-danger">*</span></span>
                  <button type="button" class="btn btn-link btn-sm p-0 text-primary font-mono text-decoration-none" id="btnAutoKwitansi">
                    <i class="fas fa-magic mr-1"></i> Auto Nomor
                  </button>
                </label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text font-mono" style="background: #081D3A; border-color: var(--border-subtle); color: var(--text-secondary);">
                      <i class="fas fa-receipt"></i>
                    </span>
                  </div>
                  <input type="text" class="form-control font-mono" name="kwitansi" id="inputKwitansi" placeholder="Misal: KW-<?= date('Ym') ?>-001" required>
                </div>
              </div>
            </div>

            <div class="col-md-6 col-12 mb-3">
              <div class="form-group mb-0">
                <label>Tanggal Pembukuan <span class="text-danger">*</span></label>
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
          </div>

          <div class="row mt-2">
            <div class="col-md-6 col-12 mb-3">
              <div class="form-group mb-0">
                <label>Deskripsi Transaksi Lengkap <span class="text-danger">*</span></label>
                <textarea class="form-control" name="deskripsi" rows="3" placeholder="Jelaskan tujuan transaksi, pihak terkait, atau rincian pengeluaran/penerimaan kas..." required></textarea>
              </div>
            </div>

            <div class="col-md-6 col-12 mb-3">
              <div class="form-group mb-0">
                <label>Keterangan Memo Jurnal <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="ketjurnal" placeholder="Contoh: Penerimaan Piutang Usaha / Pembayaran Beban Listrik" required>
                <small class="text-secondary mt-1 d-block">Memo ringkas yang akan tertera pada kolom referensi Jurnal Umum.</small>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- 2. Dynamic Ledger Matrix (Rincian Akun Debit & Kredit) -->
      <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
          <div>
            <h4 class="mb-0 text-white font-weight-bold">2. Matriks Akun Debit &amp; Kredit</h4>
            <small class="text-secondary">Pilih minimal 2 akun berpasangan untuk menjaga prinsip double-entry</small>
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
                <!-- Baris dibuat otomatis via JavaScript (barisBaru) -->
              </tbody>
            </table>
          </div>

          <!-- Alert jika terjadi selisih -->
          <div id="balanceWarningAlert" class="alert alert-danger mt-3 mb-0" style="display: none; background-color: #350B15; border-color: #F43F5E; color: #FF7B90;">
            <div class="d-flex align-items-center">
              <i class="fas fa-exclamation-triangle fa-2x mr-3 text-danger"></i>
              <div>
                <strong class="text-white">Perhatian: Entri Jurnal Belum Seimbang!</strong>
                <div class="small">Total nominal Debit harus sama persis dengan total nominal Kredit sebelum transaksi dapat disimpan ke buku besar.</div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- 3. Balancing Telemetry Dock (Sticky Action Footer) -->
      <div class="balance-dock d-flex justify-content-between align-items-center flex-wrap">
        <div class="d-flex align-items-center flex-wrap mr-3 my-1">
          <!-- Total Debit -->
          <div class="mr-4">
            <small class="text-secondary font-mono d-block" style="font-size: 11px;">TOTAL DEBIT</small>
            <span class="font-mono font-weight-bold text-white" id="liveDebitTotal" style="font-size: 1.15rem;">Rp 0</span>
          </div>

          <!-- Total Kredit -->
          <div class="mr-4">
            <small class="text-secondary font-mono d-block" style="font-size: 11px;">TOTAL KREDIT</small>
            <span class="font-mono font-weight-bold text-white" id="liveKreditTotal" style="font-size: 1.15rem;">Rp 0</span>
          </div>

          <!-- Selisih -->
          <div class="mr-4">
            <small class="text-secondary font-mono d-block" style="font-size: 11px;">SELISIH (DELTA)</small>
            <span class="font-mono font-weight-bold text-danger" id="liveDeltaTotal" style="font-size: 1.15rem;">Rp 0</span>
          </div>

          <!-- Live Balance Pill -->
          <div>
            <span class="balance-pill unbalanced" id="liveBalancePill">
              <i class="fas fa-info-circle mr-1"></i> INPUT NOMINAL DEBIT &amp; KREDIT
            </span>
          </div>
        </div>

        <!-- Tombol Aksi Simpan -->
        <div class="d-flex align-items-center my-1">
          <a href="<?= site_url('transaksi') ?>" class="btn btn-outline-secondary mr-2">
            Batal
          </a>
          <button type="submit" class="btn btn-primary font-weight-bold shadow-sm" id="submitTransaksiBtn">
            <i class="fas fa-check-circle mr-1"></i> Simpan &amp; Posting Transaksi
          </button>
        </div>
      </div>
    </form>
  </div>
</section>

<script>
  let urlAkun3 = "<?= site_url('transaksi/akun3') ?>";
  let urlStatus = "<?= site_url('transaksi/status') ?>";

  // Auto Generate Nomor Kwitansi
  document.addEventListener('DOMContentLoaded', function() {
    const btn = document.getElementById('btnAutoKwitansi');
    const input = document.getElementById('inputKwitansi');
    if (btn && input) {
      btn.addEventListener('click', function() {
        const rand = Math.floor(1000 + Math.random() * 9000);
        const code = 'KW-' + '<?= date('ym') ?>-' + rand;
        input.value = code;
      });
    }
  });
</script>

<?= $this->endSection() ?>
