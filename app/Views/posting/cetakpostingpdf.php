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
    <h3 style="margin: 5px 0 0 0; padding: 0;">LAPORAN POSTING BUKU BESAR</h3>
    <p style="margin: 5px 0 0 0; font-size: 9pt;">
      <?php if (!empty($tgl_awal) && !empty($tgl_akhir)) : ?>
        Periode: <?= date('d F Y', strtotime($tgl_awal)) ?> s/d <?= date('d F Y', strtotime($tgl_akhir)) ?>
      <?php else : ?>
        Semua Periode Transaksi
      <?php endif; ?>
      <?php if (!empty($kode_akun3)) : ?>
        | Akun: <?= esc($kode_akun3) ?>
      <?php endif; ?>
    </p>
  </div>

  <table class="data-table" cellpadding="4">
    <thead>
      <tr>
        <th rowspan="2" width="12%">Tanggal</th>
        <th rowspan="2" width="30%">Keterangan</th>
        <th rowspan="2" width="10%">Ref</th>
        <th rowspan="2" width="12%" class="text-right">Debit</th>
        <th rowspan="2" width="12%" class="text-right">Kredit</th>
        <th colspan="2" width="24%">Saldo</th>
      </tr>
      <tr>
        <th width="12%" class="text-right">Debit</th>
        <th width="12%" class="text-right">Kredit</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $saldo = 0;
      $totalDebit = 0;
      $totalKredit = 0;
      ?>
      <?php if (!empty($dtposting)) : ?>
        <?php foreach ($dtposting as $key => $value) : ?>
          <?php
          $debit  = (float)$value->debit;
          $kredit = (float)$value->kredit;
          $totalDebit  += $debit;
          $totalKredit += $kredit;

          $saldo += ($debit - $kredit);
          $saldoDebit  = ($saldo >= 0) ? $saldo : 0;
          $saldoKredit = ($saldo < 0) ? abs($saldo) : 0;
          ?>
          <tr>
            <td width="12%" class="text-center"><?= date('d/m/Y', strtotime($value->tanggal)) ?></td>
            <td width="30%"><?= esc($value->deskripsi) ?> (<?= esc($value->nama_akun3) ?>)</td>
            <td width="10%" class="text-center"><?= esc($value->kode_akun3) ?></td>
            <td width="12%" class="text-right"><?= $debit > 0 ? 'Rp ' . number_format($debit, 0, ',', '.') : '-' ?></td>
            <td width="12%" class="text-right"><?= $kredit > 0 ? 'Rp ' . number_format($kredit, 0, ',', '.') : '-' ?></td>
            <td width="12%" class="text-right"><?= $saldoDebit > 0 ? 'Rp ' . number_format($saldoDebit, 0, ',', '.') : '-' ?></td>
            <td width="12%" class="text-right"><?= $saldoKredit > 0 ? 'Rp ' . number_format($saldoKredit, 0, ',', '.') : '-' ?></td>
          </tr>
        <?php endforeach; ?>
      <?php else : ?>
        <tr>
          <td colspan="7" class="text-center">Data Posting tidak ditemukan.</td>
        </tr>
      <?php endif; ?>
    </tbody>
    <tfoot>
      <tr style="background-color: #f9f9f9; font-weight: bold;">
        <td colspan="3" class="text-right">Total Transaksi:</td>
        <td class="text-right">Rp <?= number_format($totalDebit, 0, ',', '.') ?></td>
        <td class="text-right">Rp <?= number_format($totalKredit, 0, ',', '.') ?></td>
        <td class="text-right"><?= $saldo >= 0 ? 'Rp ' . number_format($saldo, 0, ',', '.') : '-' ?></td>
        <td class="text-right"><?= $saldo < 0 ? 'Rp ' . number_format(abs($saldo), 0, ',', '.') : '-' ?></td>
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
