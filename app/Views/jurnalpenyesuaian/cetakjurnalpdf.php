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
      text-align: center;
    }
  </style>
</head>
<body>

  <div class="text-center" style="margin-bottom: 20px;">
    <h2 style="margin: 0; padding: 0;">SIA AKN SV-IPB</h2>
    <h3 style="margin: 5px 0 0 0; padding: 0;">LAPORAN JURNAL PENYESUAIAN</h3>
    <p style="margin: 5px 0 0 0; font-size: 9pt;">
      <?php if (!empty($tgl_awal) && !empty($tgl_akhir)) : ?>
        Periode: <?= date('d F Y', strtotime($tgl_awal)) ?> s/d <?= date('d F Y', strtotime($tgl_akhir)) ?>
      <?php else : ?>
        Semua Periode Transaksi
      <?php endif; ?>
    </p>
  </div>

  <table class="data-table" cellpadding="4">
    <thead>
      <tr>
        <th width="8%">No</th>
        <th width="15%">Tanggal</th>
        <th width="12%">Kode Akun</th>
        <th width="27%">Nama Akun</th>
        <th width="19%" class="text-right">Debit</th>
        <th width="19%" class="text-right">Kredit</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $totalDebit  = 0;
      $totalKredit = 0;
      ?>
      <?php if (!empty($dtpenyesuaian)) : ?>
        <?php foreach ($dtpenyesuaian as $key => $value) : ?>
          <?php
          $totalDebit  += (float)$value->jumdebit;
          $totalKredit += (float)$value->jumkredit;
          ?>
          <tr>
            <td width="8%" class="text-center"><?= $key + 1 ?></td>
            <td width="15%" class="text-center"><?= date('d/m/Y', strtotime($value->tanggal)) ?></td>
            <td width="12%" class="text-center"><?= esc($value->kode_akun3) ?></td>
            <td width="27%">
              <?php if ($value->jumdebit > 0) : ?>
                <?= esc($value->nama_akun3) ?>
              <?php else : ?>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= esc($value->nama_akun3) ?>
              <?php endif; ?>
            </td>
            <td width="19%" class="text-right"><?= $value->jumdebit > 0 ? 'Rp ' . number_format((float)$value->jumdebit, 0, ',', '.') : '-' ?></td>
            <td width="19%" class="text-right"><?= $value->jumkredit > 0 ? 'Rp ' . number_format((float)$value->jumkredit, 0, ',', '.') : '-' ?></td>
          </tr>
        <?php endforeach; ?>
      <?php else : ?>
        <tr>
          <td colspan="6" class="text-center">Data tidak ditemukan.</td>
        </tr>
      <?php endif; ?>
    </tbody>
    <tfoot>
      <tr style="background-color: #f9f9f9; font-weight: bold;">
        <td colspan="4" class="text-right">Total:</td>
        <td class="text-right">Rp <?= number_format($totalDebit, 0, ',', '.') ?></td>
        <td class="text-right">Rp <?= number_format($totalKredit, 0, ',', '.') ?></td>
      </tr>
    </tfoot>
  </table>

  <br><br>
  <table style="width: 100%; border: none;">
    <tr>
      <td width="60%"></td>
      <td width="40%" class="text-center">
        Bogor, <?= date('d F Y') ?><br>
        Mengetahui,<br><br><br><br>
        <strong>( Pimpinan / Manajer Keuangan )</strong>
      </td>
    </tr>
  </table>

</body>
</html>
