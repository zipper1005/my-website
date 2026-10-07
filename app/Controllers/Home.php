<?php

namespace App\Controllers;

use App\Models\ModelTransaksi;

class Home extends BaseController
{
    public function index()
    {
        if (!logged_in()) {
            return redirect()->to('login');
        }

        $db = \Config\Database::connect();
        $modelTransaksi = new ModelTransaksi();

        $countAkun      = $db->table('akun3s')->countAllResults();
        $countTransaksi = $db->table('tbl_transaksi')->countAllResults();
        $countUsers     = $db->table('users')->where('deleted_at', null)->countAllResults();

        // Data Laporan Keuangan
        $labaRugiData   = $modelTransaksi->get_laba_rugi();
        $totalPendapatan = (float)($labaRugiData['total_pendapatan'] ?? 0);
        $totalBeban      = (float)($labaRugiData['total_beban'] ?? 0);
        $labaBersih      = (float)($labaRugiData['laba_rugi_bersih'] ?? 0);

        $neracaData     = $modelTransaksi->get_neraca();
        $totalAktiva    = (float)($neracaData['total_aktiva'] ?? 0);
        $totalPasiva    = (float)($neracaData['total_pasiva'] ?? 0);
        $aktivaLancar   = (float)($neracaData['total_aktiva_lancar'] ?? 0);
        $aktivaTetap    = (float)($neracaData['total_aktiva_tetap'] ?? 0);
        $totalKewajiban = (float)($neracaData['total_kewajiban'] ?? 0);
        $modalAkhir     = (float)($neracaData['modal_akhir'] ?? 0);

        $arusKasData    = $modelTransaksi->get_arus_kas();
        $saldoKas       = (float)($arusKasData['saldo_akhir'] ?? 0);
        $kasMasuk       = (float)($arusKasData['total_kas_masuk'] ?? 0);
        $kasKeluar      = (float)($arusKasData['total_kas_keluar'] ?? 0);

        // Beban breakdown untuk Chart Donut
        $bebanLabels = [];
        $bebanValues = [];
        if (!empty($labaRugiData['beban'])) {
            foreach ($labaRugiData['beban'] as $b) {
                if ($b->nominal > 0) {
                    $bebanLabels[] = $b->nama_akun3;
                    $bebanValues[] = (float)$b->nominal;
                }
            }
        }
        if (empty($bebanValues)) {
            $bebanLabels = ['Tidak ada beban'];
            $bebanValues = [0];
        }

        // Transaksi Terakhir dengan Total Nominal Transaksi & Kategori Akun
        $recentTransaksi = $db->table('tbl_transaksi')
            ->select('tbl_transaksi.*, COALESCE(SUM(tbl_nilai.debit), 0) as total_nominal, COUNT(tbl_nilai.id_nilai) as jumlah_entri, MAX(akun3s.nama_akun3) as nama_akun, MAX(akun3s.kode_akun3) as kode_akun')
            ->join('tbl_nilai', 'tbl_nilai.id_transaksi = tbl_transaksi.id_transaksi', 'left')
            ->join('akun3s', 'akun3s.kode_akun3 = tbl_nilai.kode_akun3', 'left')
            ->groupBy('tbl_transaksi.id_transaksi')
            ->orderBy('tbl_transaksi.tanggal', 'DESC')
            ->orderBy('tbl_transaksi.id_transaksi', 'DESC')
            ->limit(7)
            ->get()
            ->getResult();

        // Timeline Pendapatan & Beban per Tanggal untuk Area/Line Chart
        $timelineRows = $db->table('tbl_transaksi')
            ->select('tbl_transaksi.tanggal, 
                      SUM(CASE WHEN akun3s.kode_akun3 LIKE "4%" THEN tbl_nilai.kredit ELSE 0 END) as nominal_pendapatan,
                      SUM(CASE WHEN akun3s.kode_akun3 LIKE "5%" THEN tbl_nilai.debit ELSE 0 END) as nominal_beban')
            ->join('tbl_nilai', 'tbl_nilai.id_transaksi = tbl_transaksi.id_transaksi')
            ->join('akun3s', 'akun3s.kode_akun3 = tbl_nilai.kode_akun3')
            ->groupBy('tbl_transaksi.tanggal')
            ->orderBy('tbl_transaksi.tanggal', 'ASC')
            ->get()
            ->getResult();

        $timelineDates   = [];
        $timelineRev     = [];
        $timelineExp     = [];
        $runningKas      = [];
        $currentKas      = 0;

        foreach ($timelineRows as $tRow) {
            $formattedDate = date('d M', strtotime($tRow->tanggal));
            $timelineDates[] = $formattedDate;
            $rev = (float)$tRow->nominal_pendapatan;
            $exp = (float)$tRow->nominal_beban;
            $timelineRev[]   = $rev;
            $timelineExp[]   = $exp;
        }

        // Jika timeline kosong, isi data default
        if (empty($timelineDates)) {
            $timelineDates = ['Awal Periode', 'Berjalan'];
            $timelineRev   = [0, $totalPendapatan];
            $timelineExp   = [0, $totalBeban];
        }

        // Rasio & Diagnostik Finansial Profesional
        $rasioLancar       = $totalKewajiban > 0 ? round(($aktivaLancar / $totalKewajiban) * 100, 1) : 100;
        $netProfitMargin   = $totalPendapatan > 0 ? round(($labaBersih / $totalPendapatan) * 100, 1) : 0;
        $debtToAssetRatio  = $totalAktiva > 0 ? round(($totalKewajiban / $totalAktiva) * 100, 1) : 0;
        $isNeracaBalanced  = (abs($totalAktiva - $totalPasiva) < 0.01);
        $statusSehat       = ($labaBersih >= 0 && $saldoKas >= 0 && $isNeracaBalanced);
        $totalEntriJurnal  = $db->table('tbl_nilai')->countAllResults();

        // Audit Total Debit & Kredit Real-Time
        $sumDebitRow       = $db->table('tbl_nilai')->selectSum('debit')->get()->getRow();
        $sumKreditRow      = $db->table('tbl_nilai')->selectSum('kredit')->get()->getRow();
        $totalDebit        = (float)($sumDebitRow->debit ?? 0);
        $totalKredit       = (float)($sumKreditRow->kredit ?? 0);
        $isDebitKreditMatch = (abs($totalDebit - $totalKredit) < 0.01);

        // Klasifikasi COA (Chart of Accounts Breakdown)
        $countAktiva       = $db->table('akun3s')->like('kode_akun3', '1', 'after')->countAllResults();
        $countKewajiban    = $db->table('akun3s')->like('kode_akun3', '2', 'after')->countAllResults();
        $countEkuitas      = $db->table('akun3s')->like('kode_akun3', '3', 'after')->countAllResults();
        $countPendapatan   = $db->table('akun3s')->like('kode_akun3', '4', 'after')->countAllResults();
        $countBeban        = $db->table('akun3s')->like('kode_akun3', '5', 'after')->countAllResults();

        // Net Flow & Saldo Timeline
        $timelineNet   = [];
        $timelineSaldo = [];
        $runningBal    = max(0, $saldoKas - ($kasMasuk - $kasKeluar));
        for ($i = 0; $i < count($timelineRev); $i++) {
            $r = $timelineRev[$i] ?? 0;
            $e = $timelineExp[$i] ?? 0;
            $timelineNet[]   = $r - $e;
            $runningBal     += ($r - $e);
            $timelineSaldo[] = max(0, $runningBal);
        }
        if (empty($timelineSaldo)) {
            $timelineSaldo = [$saldoKas, $saldoKas];
        }

        // Rincian Akun Kas & Bank Aktif
        $kasBankAccounts = $db->table('akun3s')
            ->select('akun3s.kode_akun3, akun3s.nama_akun3, 
                      COALESCE(SUM(tbl_nilai.debit), 0) - COALESCE(SUM(tbl_nilai.kredit), 0) as saldo')
            ->join('tbl_nilai', 'tbl_nilai.kode_akun3 = akun3s.kode_akun3', 'left')
            ->like('akun3s.kode_akun3', '11', 'after')
            ->groupBy('akun3s.kode_akun3')
            ->orderBy('akun3s.kode_akun3', 'ASC')
            ->get()
            ->getResult();

        $data = [
            'count_akun'           => $countAkun,
            'count_transaksi'      => $countTransaksi,
            'count_users'          => $countUsers,
            'total_entri_jurnal'   => $totalEntriJurnal,
            'total_debit'          => $totalDebit,
            'total_kredit'         => $totalKredit,
            'is_debit_kredit_match'=> $isDebitKreditMatch,
            'count_aktiva'         => $countAktiva,
            'count_kewajiban'      => $countKewajiban,
            'count_ekuitas'        => $countEkuitas,
            'count_pendapatan'     => $countPendapatan,
            'count_beban'          => $countBeban,
            'total_pendapatan'     => $totalPendapatan,
            'total_beban'          => $totalBeban,
            'laba_bersih'          => $labaBersih,
            'total_aktiva'         => $totalAktiva,
            'total_pasiva'         => $totalPasiva,
            'aktiva_lancar'        => $aktivaLancar,
            'aktiva_tetap'         => $aktivaTetap,
            'total_kewajiban'      => $totalKewajiban,
            'modal_akhir'          => $modalAkhir,
            'saldo_kas'            => $saldoKas,
            'kas_masuk'            => $kasMasuk,
            'kas_keluar'           => $kasKeluar,
            'kas_bank_accounts'    => $kasBankAccounts,
            'beban_labels'         => json_encode($bebanLabels),
            'beban_values'         => json_encode($bebanValues),
            'timeline_dates'       => json_encode($timelineDates),
            'timeline_rev'         => json_encode($timelineRev),
            'timeline_exp'         => json_encode($timelineExp),
            'timeline_net'         => json_encode($timelineNet),
            'timeline_saldo'       => json_encode($timelineSaldo),
            'rasio_lancar'         => $rasioLancar,
            'net_profit_margin'    => $netProfitMargin,
            'debt_to_asset'        => $debtToAssetRatio,
            'is_neraca_balanced'   => $isNeracaBalanced,
            'status_sehat'         => $statusSehat,
            'recent_transaksi'     => $recentTransaksi,
        ];

        return view('home', $data);
    }

    public function landing(): string
    {
        return view('landing');
    }
}
