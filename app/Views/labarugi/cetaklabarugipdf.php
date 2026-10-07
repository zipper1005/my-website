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
    <h3 style="margin: 5px 0 0 0; padding: 0;">LAPORAN LABA RUGI</h3>
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
      <!-- PENDAPATAN -->
      <tr class="header-section">
        <td colspan="2" width="75%"><b>PENDAPATAN USAHA</b></td>
        <td width="25%" class="text-right"><b>Nominal (Rp)</b></td>
      </tr>
      <?php if (!empty($data_lr['pendapatan'])) : ?>
        <?php foreach ($data_lr['pendapatan'] as $p) : ?>
          <tr>
            <td width="15%" class="text-center"><?= esc($p->kode_akun3) ?></td>
            <td width="60%"><?= esc($p->nama_akun3) ?></td>
            <td width="25%" class="text-right"><?= number_format($p->nominal, 0, ',', '.') ?></td>
          </tr>
        <?php endforeach; ?>
      <?php else : ?>
        <tr>
          <td colspan="3" class="text-center">Tidak ada data pendapatan</td>
        </tr>
      <?php endif; ?>
      <tr style="background-color: #f9f9f9;">
        <td colspan="2" class="text-right"><b>Total Pendapatan</b></td>
        <td class="text-right"><b>Rp <?= number_format($data_lr['total_pendapatan'], 0, ',', '.') ?></b></td>
      </tr>

      <!-- BEBAN -->
      <tr class="header-section">
        <td colspan="2"><b>BEBAN OPERASIONAL</b></td>
        <td class="text-right"><b>Nominal (Rp)</b></td>
      </tr>
      <?php if (!empty($data_lr['beban'])) : ?>
        <?php foreach ($data_lr['beban'] as $b) : ?>
          <tr>
            <td class="text-center"><?= esc($b->kode_akun3) ?></td>
            <td><?= esc($b->nama_akun3) ?></td>
            <td class="text-right"><?= number_format($b->nominal, 0, ',', '.') ?></td>
          </tr>
        <?php endforeach; ?>
      <?php else : ?>
        <tr>
          <td colspan="3" class="text-center">Tidak ada data beban</td>
        </tr>
      <?php endif; ?>
      <tr style="background-color: #f9f9f9;">
        <td colspan="2" class="text-right"><b>Total Beban</b></td>
        <td class="text-right"><b>Rp <?= number_format($data_lr['total_beban'], 0, ',', '.') ?></b></td>
      </tr>

      <!-- HASIL LABA / RUGI -->
      <?php $isLaba = ($data_lr['laba_rugi_bersih'] >= 0); ?>
      <tr style="background-color: <?= $isLaba ? '#d4edda' : '#f8d7da' ?>;">
        <td colspan="2" class="text-right"><b><?= $isLaba ? 'LABA BERSIH' : 'RUGI BERSIH' ?></b></td>
        <td class="text-right"><b>Rp <?= number_format($data_lr['laba_rugi_bersih'], 0, ',', '.') ?></b></td>
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
