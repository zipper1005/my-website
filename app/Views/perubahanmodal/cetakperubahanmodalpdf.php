<!DOCTYPE html>
<html>
<head>
  <style>
    body {
      font-family: helvetica, sans-serif;
      font-size: 10pt;
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
      padding: 6px;
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
    <h3 style="margin: 5px 0 0 0; padding: 0;">LAPORAN PERUBAHAN MODAL</h3>
    <p style="margin: 5px 0 0 0; font-size: 9pt;">
      <?php if (!empty($tgl_awal) && !empty($tgl_akhir)) : ?>
        Periode: <?= date('d F Y', strtotime($tgl_awal)) ?> s/d <?= date('d F Y', strtotime($tgl_akhir)) ?>
      <?php else : ?>
        Semua Periode Transaksi
      <?php endif; ?>
    </p>
  </div>

  <table class="data-table" cellpadding="5">
    <tbody>
      <tr>
        <td width="70%"><b>Modal Awal Pemilik</b></td>
        <td width="30%" class="text-right"><b>Rp <?= number_format($data_pm['modal_awal'], 0, ',', '.') ?></b></td>
      </tr>
      <tr>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;Laba Bersih Periode Berjalan</td>
        <td class="text-right">Rp <?= number_format($data_pm['laba_bersih'], 0, ',', '.') ?></td>
      </tr>
      <tr>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;Pengambilan Pribadi (Prive)</td>
        <td class="text-right">(Rp <?= number_format($data_pm['prive'], 0, ',', '.') ?>)</td>
      </tr>
      <tr style="background-color: #f9f9f9;">
        <td><b>Penambahan / (Pengurangan) Modal</b></td>
        <td class="text-right"><b>Rp <?= number_format($data_pm['penambahan_modal'], 0, ',', '.') ?></b></td>
      </tr>
      <tr style="background-color: #d4edda;">
        <td><b>MODAL AKHIR PEMILIK</b></td>
        <td class="text-right"><b>Rp <?= number_format($data_pm['modal_akhir'], 0, ',', '.') ?></b></td>
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
