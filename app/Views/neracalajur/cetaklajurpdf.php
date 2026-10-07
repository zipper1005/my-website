<!DOCTYPE html>
<html>
<head>
  <style>
    body {
      font-family: helvetica, sans-serif;
      font-size: 8pt;
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
      border: 0.5px solid #444;
      padding: 3px;
    }
    table.data-table th {
      background-color: #f2f2f2;
      font-weight: bold;
      text-align: center;
      font-size: 7.5pt;
    }
  </style>
</head>
<body>

  <div class="text-center" style="margin-bottom: 12px;">
    <h2 style="margin: 0; padding: 0; font-size: 14pt;">SIA AKN SV-IPB</h2>
    <h3 style="margin: 3px 0 0 0; padding: 0; font-size: 11pt;">KERTAS KERJA / NERACA LAJUR (WORKSHEET 10 KOLOM)</h3>
    <p style="margin: 3px 0 0 0; font-size: 8pt;">
      <?php if (!empty($tgl_awal) && !empty($tgl_akhir)) : ?>
        Periode: <?= date('d F Y', strtotime($tgl_awal)) ?> s/d <?= date('d F Y', strtotime($tgl_akhir)) ?>
      <?php else : ?>
        Semua Periode Transaksi
      <?php endif; ?>
    </p>
  </div>

  <table class="data-table" cellpadding="2">
    <thead>
      <tr>
        <th width="4%" rowspan="2" align="center">No</th>
        <th width="8%" rowspan="2" align="center">Kode</th>
        <th width="18%" rowspan="2" align="center">Nama Akun</th>
        <th width="14%" colspan="2" align="center">Neraca Saldo</th>
        <th width="14%" colspan="2" align="center">Penyesuaian</th>
        <th width="14%" colspan="2" align="center">NS Disesuaikan</th>
        <th width="14%" colspan="2" align="center">Laba / Rugi</th>
        <th width="14%" colspan="2" align="center">Neraca</th>
      </tr>
      <tr>
        <th width="7%" align="center">Debit</th>
        <th width="7%" align="center">Kredit</th>
        <th width="7%" align="center">Debit</th>
        <th width="7%" align="center">Kredit</th>
        <th width="7%" align="center">Debit</th>
        <th width="7%" align="center">Kredit</th>
        <th width="7%" align="center">Debit</th>
        <th width="7%" align="center">Kredit</th>
        <th width="7%" align="center">Debit</th>
        <th width="7%" align="center">Kredit</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $tot_debit_ns   = 0;
      $tot_kredit_ns  = 0;
      $tot_debit_ajp  = 0;
      $tot_kredit_ajp = 0;
      $tot_debit_nsd  = 0;
      $tot_kredit_nsd = 0;
      $tot_debit_lr   = 0;
      $tot_kredit_lr  = 0;
      $tot_debit_nrc  = 0;
      $tot_kredit_nrc = 0;
      ?>
      <?php if (!empty($dttransaksi)) : ?>
        <?php foreach ($dttransaksi as $key => $value) : ?>
          <?php
          // 1. Neraca Saldo
          $d_ns = (float)$value->jumdebit;
          $k_ns = (float)$value->jumkredit;
          $ns = $d_ns - $k_ns;
          if ($ns > 0) {
              $debit_ns = $ns;
              $kredit_ns = 0;
          } else {
              $debit_ns = 0;
              $kredit_ns = abs($ns);
          }
          $tot_debit_ns += $debit_ns;
          $tot_kredit_ns += $kredit_ns;

          // 2. Penyesuaian (AJP)
          $d_ajp = (float)$value->jumdebits;
          $k_ajp = (float)$value->jumkredits;
          $ajp = $d_ajp - $k_ajp;
          if ($ajp > 0) {
              $debit_ajp = $ajp;
              $kredit_ajp = 0;
          } else {
              $debit_ajp = 0;
              $kredit_ajp = abs($ajp);
          }
          $tot_debit_ajp += $debit_ajp;
          $tot_kredit_ajp += $kredit_ajp;

          // 3. Neraca Saldo Disesuaikan (NSD)
          $nsd = ($debit_ns - $kredit_ns) + ($debit_ajp - $kredit_ajp);
          if ($nsd > 0) {
              $debit_nsd = $nsd;
              $kredit_nsd = 0;
          } else {
              $debit_nsd = 0;
              $kredit_nsd = abs($nsd);
          }
          $tot_debit_nsd += $debit_nsd;
          $tot_kredit_nsd += $kredit_nsd;

          // 4. Laba / Rugi vs Neraca
          $first_digit = substr($value->kode_akun3, 0, 1);
          if ($first_digit >= '4') {
              $debit_lr  = $debit_nsd;
              $kredit_lr = $kredit_nsd;
              $debit_nrc = 0;
              $kredit_nrc = 0;
          } else {
              $debit_lr  = 0;
              $kredit_lr = 0;
              $debit_nrc = $debit_nsd;
              $kredit_nrc = $kredit_nsd;
          }
          $tot_debit_lr  += $debit_lr;
          $tot_kredit_lr += $kredit_lr;
          $tot_debit_nrc += $debit_nrc;
          $tot_kredit_nrc += $kredit_nrc;
          ?>
          <tr>
            <td width="4%" align="center"><?= $key + 1 ?></td>
            <td width="8%" align="center"><?= esc($value->kode_akun3) ?></td>
            <td width="18%"><?= esc($value->nama_akun3) ?></td>

            <!-- Neraca Saldo -->
            <td width="7%" align="right"><?= $debit_ns > 0 ? number_format($debit_ns, 0, ',', '.') : '-' ?></td>
            <td width="7%" align="right"><?= $kredit_ns > 0 ? number_format($kredit_ns, 0, ',', '.') : '-' ?></td>

            <!-- Penyesuaian -->
            <td width="7%" align="right"><?= $debit_ajp > 0 ? number_format($debit_ajp, 0, ',', '.') : '-' ?></td>
            <td width="7%" align="right"><?= $kredit_ajp > 0 ? number_format($kredit_ajp, 0, ',', '.') : '-' ?></td>

            <!-- NSD -->
            <td width="7%" align="right"><?= $debit_nsd > 0 ? number_format($debit_nsd, 0, ',', '.') : '-' ?></td>
            <td width="7%" align="right"><?= $kredit_nsd > 0 ? number_format($kredit_nsd, 0, ',', '.') : '-' ?></td>

            <!-- Laba Rugi -->
            <td width="7%" align="right"><?= $debit_lr > 0 ? number_format($debit_lr, 0, ',', '.') : '-' ?></td>
            <td width="7%" align="right"><?= $kredit_lr > 0 ? number_format($kredit_lr, 0, ',', '.') : '-' ?></td>

            <!-- Neraca -->
            <td width="7%" align="right"><?= $debit_nrc > 0 ? number_format($debit_nrc, 0, ',', '.') : '-' ?></td>
            <td width="7%" align="right"><?= $kredit_nrc > 0 ? number_format($kredit_nrc, 0, ',', '.') : '-' ?></td>
          </tr>
        <?php endforeach; ?>
      <?php else : ?>
        <tr>
          <td colspan="13" align="center">Data transaksi tidak ditemukan.</td>
        </tr>
      <?php endif; ?>
    </tbody>
    <tfoot>
      <!-- Total Saldo -->
      <tr style="background-color: #f2f2f2; font-weight: bold;">
        <td colspan="3" align="center">Total</td>
        <td align="right"><?= number_format($tot_debit_ns, 0, ',', '.') ?></td>
        <td align="right"><?= number_format($tot_kredit_ns, 0, ',', '.') ?></td>
        <td align="right"><?= number_format($tot_debit_ajp, 0, ',', '.') ?></td>
        <td align="right"><?= number_format($tot_kredit_ajp, 0, ',', '.') ?></td>
        <td align="right"><?= number_format($tot_debit_nsd, 0, ',', '.') ?></td>
        <td align="right"><?= number_format($tot_kredit_nsd, 0, ',', '.') ?></td>
        <td align="right"><?= number_format($tot_debit_lr, 0, ',', '.') ?></td>
        <td align="right"><?= number_format($tot_kredit_lr, 0, ',', '.') ?></td>
        <td align="right"><?= number_format($tot_debit_nrc, 0, ',', '.') ?></td>
        <td align="right"><?= number_format($tot_kredit_nrc, 0, ',', '.') ?></td>
      </tr>

      <?php
      $laba_bersih = $tot_kredit_lr - $tot_debit_lr;
      $is_laba     = ($laba_bersih >= 0);
      $nominal_lr  = abs($laba_bersih);

      $lr_debit_bal   = $is_laba ? $nominal_lr : 0;
      $lr_kredit_bal  = $is_laba ? 0 : $nominal_lr;
      $nrc_debit_bal  = $is_laba ? 0 : $nominal_lr;
      $nrc_kredit_bal = $is_laba ? $nominal_lr : 0;

      $akhir_debit_lr   = $tot_debit_lr + $lr_debit_bal;
      $akhir_kredit_lr  = $tot_kredit_lr + $lr_kredit_bal;
      $akhir_debit_nrc  = $tot_debit_nrc + $nrc_debit_bal;
      $akhir_kredit_nrc = $tot_kredit_nrc + $nrc_kredit_bal;
      ?>

      <!-- Laba / Rugi Bersih -->
      <tr style="background-color: #fafafa; font-weight: bold;">
        <td colspan="3" align="center"><?= $is_laba ? 'Laba Bersih' : 'Rugi Bersih' ?></td>
        <td align="right">-</td>
        <td align="right">-</td>
        <td align="right">-</td>
        <td align="right">-</td>
        <td align="right">-</td>
        <td align="right">-</td>
        <td align="right"><?= $lr_debit_bal > 0 ? number_format($lr_debit_bal, 0, ',', '.') : '-' ?></td>
        <td align="right"><?= $lr_kredit_bal > 0 ? number_format($lr_kredit_bal, 0, ',', '.') : '-' ?></td>
        <td align="right"><?= $nrc_debit_bal > 0 ? number_format($nrc_debit_bal, 0, ',', '.') : '-' ?></td>
        <td align="right"><?= $nrc_kredit_bal > 0 ? number_format($nrc_kredit_bal, 0, ',', '.') : '-' ?></td>
      </tr>

      <!-- Total Akhir Seimbang -->
      <tr style="background-color: #eaeaea; font-weight: bold;">
        <td colspan="3" align="center">Total Akhir</td>
        <td align="right"><?= number_format($tot_debit_ns, 0, ',', '.') ?></td>
        <td align="right"><?= number_format($tot_kredit_ns, 0, ',', '.') ?></td>
        <td align="right"><?= number_format($tot_debit_ajp, 0, ',', '.') ?></td>
        <td align="right"><?= number_format($tot_kredit_ajp, 0, ',', '.') ?></td>
        <td align="right"><?= number_format($tot_debit_nsd, 0, ',', '.') ?></td>
        <td align="right"><?= number_format($tot_kredit_nsd, 0, ',', '.') ?></td>
        <td align="right"><?= number_format($akhir_debit_lr, 0, ',', '.') ?></td>
        <td align="right"><?= number_format($akhir_kredit_lr, 0, ',', '.') ?></td>
        <td align="right"><?= number_format($akhir_debit_nrc, 0, ',', '.') ?></td>
        <td align="right"><?= number_format($akhir_kredit_nrc, 0, ',', '.') ?></td>
      </tr>
    </tfoot>
  </table>

  <br><br>
  <table style="width: 100%; border: none;">
    <tr>
      <td width="70%"></td>
      <td width="30%" align="center">
        Bogor, <?= date('d F Y') ?><br>
        Mengetahui,<br><br><br><br>
        <strong>( Pimpinan / Manajer Keuangan )</strong>
      </td>
    </tr>
  </table>

</body>
</html>
