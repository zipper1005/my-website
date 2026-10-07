<!DOCTYPE html>
<html>
<head>
  <style>
    body {
      font-family: helvetica, sans-serif;
      font-size: 9pt;
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
      padding: 4px;
    }
    .header-section {
      background-color: #e9ecef;
      font-weight: bold;
    }
  </style>
</head>
<body>

  <div class="text-center" style="margin-bottom: 15px;">
    <h2 style="margin: 0; padding: 0;">SIA AKN SV-IPB</h2>
    <h3 style="margin: 4px 0 0 0; padding: 0;">LAPORAN NERACA (BALANCE SHEET)</h3>
    <p style="margin: 4px 0 0 0; font-size: 8.5pt;">
      Per <?= (!empty($tgl_akhir)) ? date('d F Y', strtotime($tgl_akhir)) : '31 Desember 2023' ?>
    </p>
  </div>

  <table width="100%" cellpadding="0" cellspacing="0">
    <tr>
      <!-- AKTIVA (KIRI) -->
      <td width="49%" valign="top">
        <table class="data-table" cellpadding="4">
          <thead>
            <tr class="header-section">
              <th colspan="2" class="text-center"><b>AKTIVA (ASET)</b></th>
            </tr>
          </thead>
          <tbody>
            <tr style="background-color: #f2f2f2;">
              <td colspan="2"><b>Aktiva Lancar</b></td>
            </tr>
            <?php foreach ($data_neraca['aktiva_lancar'] as $al) : ?>
              <tr>
                <td width="60%"><?= esc($al->nama_akun3) ?></td>
                <td width="40%" class="text-right"><?= number_format($al->nominal, 0, ',', '.') ?></td>
              </tr>
            <?php endforeach; ?>
            <tr>
              <td><b>Total Aktiva Lancar</b></td>
              <td class="text-right"><b>Rp <?= number_format($data_neraca['total_aktiva_lancar'], 0, ',', '.') ?></b></td>
            </tr>

            <tr style="background-color: #f2f2f2;">
              <td colspan="2"><b>Aktiva Tetap</b></td>
            </tr>
            <?php foreach ($data_neraca['aktiva_tetap'] as $at) : ?>
              <tr>
                <td><?= esc($at->nama_akun3) ?></td>
                <td class="text-right"><?= number_format($at->nominal, 0, ',', '.') ?></td>
              </tr>
            <?php endforeach; ?>
            <tr>
              <td><b>Total Aktiva Tetap</b></td>
              <td class="text-right"><b>Rp <?= number_format($data_neraca['total_aktiva_tetap'], 0, ',', '.') ?></b></td>
            </tr>

            <tr style="background-color: #d4edda;">
              <td><b>TOTAL AKTIVA</b></td>
              <td class="text-right"><b>Rp <?= number_format($data_neraca['total_aktiva'], 0, ',', '.') ?></b></td>
            </tr>
          </tbody>
        </table>
      </td>

      <td width="2%"></td>

      <!-- PASIVA (KANAN) -->
      <td width="49%" valign="top">
        <table class="data-table" cellpadding="4">
          <thead>
            <tr class="header-section">
              <th colspan="2" class="text-center"><b>PASIVA (KEWAJIBAN & MODAL)</b></th>
            </tr>
          </thead>
          <tbody>
            <tr style="background-color: #f2f2f2;">
              <td colspan="2"><b>Kewajiban Jangka Pendek</b></td>
            </tr>
            <?php foreach ($data_neraca['kewajiban_pendek'] as $kp) : ?>
              <tr>
                <td width="60%"><?= esc($kp->nama_akun3) ?></td>
                <td width="40%" class="text-right"><?= number_format($kp->nominal, 0, ',', '.') ?></td>
              </tr>
            <?php endforeach; ?>
            <tr>
              <td><b>Total Kewajiban</b></td>
              <td class="text-right"><b>Rp <?= number_format($data_neraca['total_kewajiban'], 0, ',', '.') ?></b></td>
            </tr>

            <tr style="background-color: #f2f2f2;">
              <td colspan="2"><b>Ekuitas / Modal</b></td>
            </tr>
            <tr>
              <td>Modal Akhir Pemilik</td>
              <td class="text-right"><?= number_format($data_neraca['modal_akhir'], 0, ',', '.') ?></td>
            </tr>
            <tr>
              <td><b>Total Ekuitas</b></td>
              <td class="text-right"><b>Rp <?= number_format($data_neraca['modal_akhir'], 0, ',', '.') ?></b></td>
            </tr>

            <tr style="background-color: #d4edda;">
              <td><b>TOTAL PASIVA</b></td>
              <td class="text-right"><b>Rp <?= number_format($data_neraca['total_pasiva'], 0, ',', '.') ?></b></td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>
  </table>

  <br><br>
  <table width="100%" style="font-size: 8.5pt;">
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
