<!DOCTYPE html>
<html>
<head>
  <style>
    body {
      font-family: helvetica, sans-serif;
      font-size: 9.5pt;
      color: #333;
    }
    .text-center {
      text-align: center;
    }
    .text-right {
      text-align: right;
    }
    .font-weight-bold {
      font-weight: bold;
    }
    table.data-table {
      width: 100%;
      border-collapse: collapse;
    }
    table.data-table th, table.data-table td {
      border: 1px solid #444;
      padding: 5px;
    }
    table.data-table th {
      background-color: #f2f2f2;
      font-weight: bold;
    }
    .header-section {
      background-color: #e9ecef;
      font-weight: bold;
    }
  </style>
</head>
<body>

  <div class="text-center" style="margin-bottom: 20px;">
    <h2 style="margin: 0; padding: 0;">SIA AKN SV-IPB</h2>
    <h3 style="margin: 5px 0 0 0; padding: 0;">LAPORAN ARUS KAS (CASH FLOW)</h3>
    <p style="margin: 5px 0 0 0; font-size: 9pt;">
      <?php if (!empty($tgl_awal) && !empty($tgl_akhir)) : ?>
        Periode: <?= date('d F Y', strtotime($tgl_awal)) ?> s/d <?= date('d F Y', strtotime($tgl_akhir)) ?>
      <?php else : ?>
        Semua Periode Transaksi
      <?php endif; ?>
    </p>
  </div>

  <table class="data-table" cellpadding="4">
    <tbody>
      <!-- KAS MASUK -->
      <tr class="header-section">
        <td colspan="3" width="75%"><b>PENERIMAAN KAS (ARUS KAS MASUK)</b></td>
        <td width="25%" class="text-right"><b>Nominal (Rp)</b></td>
      </tr>
      <?php if (!empty($data_ak['kas_masuk'])) : ?>
        <?php foreach ($data_ak['kas_masuk'] as $km) : ?>
          <tr>
            <td width="15%" class="text-center"><?= date('d/m/Y', strtotime($km->tanggal)) ?></td>
            <td width="15%" class="text-center"><?= esc($km->kwitansi) ?></td>
            <td width="45%"><?= esc($km->deskripsi) ?></td>
            <td width="25%" class="text-right"><?= number_format($km->debit, 0, ',', '.') ?></td>
          </tr>
        <?php endforeach; ?>
      <?php else : ?>
        <tr>
          <td colspan="4" class="text-center">Tidak ada penerimaan kas</td>
        </tr>
      <?php endif; ?>
      <tr style="background-color: #f9f9f9;">
        <td colspan="3" class="text-right"><b>Total Penerimaan Kas</b></td>
        <td class="text-right"><b>Rp <?= number_format($data_ak['total_kas_masuk'], 0, ',', '.') ?></b></td>
      </tr>

      <!-- KAS KELUAR -->
      <tr class="header-section">
        <td colspan="3"><b>PENGELUARAN KAS (ARUS KAS KELUAR)</b></td>
        <td class="text-right"><b>Nominal (Rp)</b></td>
      </tr>
      <?php if (!empty($data_ak['kas_keluar'])) : ?>
        <?php foreach ($data_ak['kas_keluar'] as $kk) : ?>
          <tr>
            <td class="text-center"><?= date('d/m/Y', strtotime($kk->tanggal)) ?></td>
            <td class="text-center"><?= esc($kk->kwitansi) ?></td>
            <td><?= esc($kk->deskripsi) ?></td>
            <td class="text-right"><?= number_format($kk->kredit, 0, ',', '.') ?></td>
          </tr>
        <?php endforeach; ?>
      <?php else : ?>
        <tr>
          <td colspan="4" class="text-center">Tidak ada pengeluaran kas</td>
        </tr>
      <?php endif; ?>
      <tr style="background-color: #f9f9f9;">
        <td colspan="3" class="text-right"><b>Total Pengeluaran Kas</b></td>
        <td class="text-right"><b>Rp <?= number_format($data_ak['total_kas_keluar'], 0, ',', '.') ?></b></td>
      </tr>

      <!-- SALDO AKHIR -->
      <tr style="background-color: #d4edda;">
        <td colspan="3" class="text-right"><b>KENAIKAN BERSIH / SALDO AKHIR KAS</b></td>
        <td class="text-right"><b>Rp <?= number_format($data_ak['saldo_akhir'], 0, ',', '.') ?></b></td>
      </tr>
    </tbody>
  </table>

  <br><br>
  <table width="100%" style="font-size: 9pt;">
    <tr>
      <td width="60%"></td>
      <td width="40%" class="text-center">
        Bogor, <?= date('d F Y') ?><br>
        Mengetahui,<br>
        <b>Pimpinan / Pengelola</b>
        <br><br><br><br>
        ( .................................... )
      </td>
    </tr>
  </table>

</body>
</html>
