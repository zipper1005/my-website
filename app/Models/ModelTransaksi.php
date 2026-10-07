<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelTransaksi extends Model
{
    protected $table            = 'tbl_transaksi';
    protected $primaryKey       = 'id_transaksi';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['kwitansi', 'tanggal', 'deskripsi', 'ketjurnal'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function get_jurnal_umum($tgl_awal = null, $tgl_akhir = null)
    {
        $builder = $this->db->table('tbl_nilai');
        $builder->select('tbl_nilai.*, tbl_transaksi.tanggal, tbl_transaksi.kwitansi, tbl_transaksi.deskripsi, tbl_transaksi.ketjurnal, akun3s.nama_akun3');
        $builder->join('tbl_transaksi', 'tbl_transaksi.id_transaksi = tbl_nilai.id_transaksi');
        $builder->join('akun3s', 'akun3s.kode_akun3 = tbl_nilai.kode_akun3');
        if (!empty($tgl_awal) && !empty($tgl_akhir)) {
            $builder->where('tbl_transaksi.tanggal >=', $tgl_awal);
            $builder->where('tbl_transaksi.tanggal <=', $tgl_akhir);
        }
        $builder->orderBy('tbl_transaksi.tanggal', 'ASC');
        $builder->orderBy('tbl_transaksi.id_transaksi', 'ASC');
        $builder->orderBy('tbl_nilai.id_nilai', 'ASC');
        return $builder->get()->getResult();
    }

    public function get_posting($tgl_awal = null, $tgl_akhir = null, $kode_akun3 = null)
    {
        $builder = $this->db->table('tbl_nilai');
        $builder->select('tbl_nilai.*, tbl_transaksi.tanggal, tbl_transaksi.kwitansi, tbl_transaksi.deskripsi, tbl_transaksi.ketjurnal, akun3s.nama_akun3');
        $builder->join('tbl_transaksi', 'tbl_transaksi.id_transaksi = tbl_nilai.id_transaksi');
        $builder->join('akun3s', 'akun3s.kode_akun3 = tbl_nilai.kode_akun3');
        if (!empty($tgl_awal) && !empty($tgl_akhir)) {
            $builder->where('tbl_transaksi.tanggal >=', $tgl_awal);
            $builder->where('tbl_transaksi.tanggal <=', $tgl_akhir);
        }
        if (!empty($kode_akun3)) {
            $builder->where('tbl_nilai.kode_akun3', $kode_akun3);
        }
        $builder->orderBy('tbl_transaksi.tanggal', 'ASC');
        $builder->orderBy('tbl_transaksi.id_transaksi', 'ASC');
        $builder->orderBy('tbl_nilai.id_nilai', 'ASC');
        return $builder->get()->getResult();
    }

    public function get_penyesuaian($tgl_awal = null, $tgl_akhir = null)
    {
        $builder = $this->db->table('tbl_nilai_penyesuaian');
        $builder->select('tbl_nilai_penyesuaian.kode_akun3, akun3s.nama_akun3, tbl_penyesuaian.tanggal, tbl_penyesuaian.deskripsi, SUM(tbl_nilai_penyesuaian.debit) as jumdebit, SUM(tbl_nilai_penyesuaian.kredit) as jumkredit');
        $builder->join('tbl_penyesuaian', 'tbl_penyesuaian.id_penyesuaian = tbl_nilai_penyesuaian.id_penyesuaian');
        $builder->join('akun3s', 'akun3s.kode_akun3 = tbl_nilai_penyesuaian.kode_akun3');
        if (!empty($tgl_awal) && !empty($tgl_akhir)) {
            $builder->where('tbl_penyesuaian.tanggal >=', $tgl_awal);
            $builder->where('tbl_penyesuaian.tanggal <=', $tgl_akhir);
        }
        $builder->groupBy('tbl_nilai_penyesuaian.kode_akun3, akun3s.nama_akun3, tbl_penyesuaian.tanggal, tbl_penyesuaian.deskripsi');
        $builder->orderBy('tbl_nilai_penyesuaian.kode_akun3', 'ASC');
        return $builder->get()->getResult();
    }

    public function get_neraca_saldo($tgl_awal = null, $tgl_akhir = null)
    {
        $builder = $this->db->table('tbl_nilai');
        $builder->select('tbl_nilai.kode_akun3, akun3s.nama_akun3, SUM(tbl_nilai.debit) as debit, SUM(tbl_nilai.kredit) as kredit');
        $builder->join('tbl_transaksi', 'tbl_transaksi.id_transaksi = tbl_nilai.id_transaksi');
        $builder->join('akun3s', 'akun3s.kode_akun3 = tbl_nilai.kode_akun3');
        if (!empty($tgl_awal) && !empty($tgl_akhir)) {
            $builder->where('tbl_transaksi.tanggal >=', $tgl_awal);
            $builder->where('tbl_transaksi.tanggal <=', $tgl_akhir);
        }
        $builder->groupBy('tbl_nilai.kode_akun3, akun3s.nama_akun3');
        $builder->orderBy('tbl_nilai.kode_akun3', 'ASC');
        return $builder->get()->getResult();
    }

    public function get_neraca_lajur($tgl_awal = null, $tgl_akhir = null)
    {
        $whereJu = '';
        $whereJp = '';
        if (!empty($tgl_awal) && !empty($tgl_akhir)) {
            $tgl_awal_esc = $this->db->escapeString($tgl_awal);
            $tgl_akhir_esc = $this->db->escapeString($tgl_akhir);
            $whereJu = "WHERE tbl_transaksi.tanggal >= '$tgl_awal_esc' AND tbl_transaksi.tanggal <= '$tgl_akhir_esc'";
            $whereJp = "WHERE tbl_penyesuaian.tanggal >= '$tgl_awal_esc' AND tbl_penyesuaian.tanggal <= '$tgl_akhir_esc'";
        }

        $sql = "SELECT 
                    akun.kode_akun3, 
                    akun.nama_akun3, 
                    COALESCE(ju.debit, 0) as jumdebit, 
                    COALESCE(ju.kredit, 0) as jumkredit, 
                    COALESCE(jp.debit, 0) as jumdebits, 
                    COALESCE(jp.kredit, 0) as jumkredits 
                FROM akun3s akun 
                LEFT JOIN (
                    SELECT 
                        tbl_nilai.kode_akun3, 
                        SUM(tbl_nilai.debit) as debit, 
                        SUM(tbl_nilai.kredit) as kredit 
                    FROM tbl_nilai 
                    JOIN tbl_transaksi ON tbl_transaksi.id_transaksi = tbl_nilai.id_transaksi 
                    $whereJu
                    GROUP BY tbl_nilai.kode_akun3
                ) ju ON ju.kode_akun3 = akun.kode_akun3 
                LEFT JOIN (
                    SELECT 
                        tbl_nilai_penyesuaian.kode_akun3, 
                        SUM(tbl_nilai_penyesuaian.debit) as debit, 
                        SUM(tbl_nilai_penyesuaian.kredit) as kredit 
                    FROM tbl_nilai_penyesuaian 
                    JOIN tbl_penyesuaian ON tbl_penyesuaian.id_penyesuaian = tbl_nilai_penyesuaian.id_penyesuaian 
                    $whereJp
                    GROUP BY tbl_nilai_penyesuaian.kode_akun3
                ) jp ON jp.kode_akun3 = akun.kode_akun3 
                WHERE (ju.kode_akun3 IS NOT NULL OR jp.kode_akun3 IS NOT NULL)
                ORDER BY akun.kode_akun3 ASC";

        return $this->db->query($sql)->getResult();
    }

    public function get_laba_rugi($tgl_awal = null, $tgl_akhir = null)
    {
        $dtlajur = $this->get_neraca_lajur($tgl_awal, $tgl_akhir);
        $pendapatan = [];
        $beban = [];
        $total_pendapatan = 0;
        $total_beban = 0;

        foreach ($dtlajur as $val) {
            $ns = (float)$val->jumdebit - (float)$val->jumkredit;
            $ajp = (float)$val->jumdebits - (float)$val->jumkredits;
            $nsd = $ns + $ajp;

            $first_char = substr((string)$val->kode_akun3, 0, 1);
            if ($first_char === '4') {
                $saldo = $nsd < 0 ? abs($nsd) : -$nsd;
                $pendapatan[] = (object)[
                    'kode_akun3' => $val->kode_akun3,
                    'nama_akun3' => $val->nama_akun3,
                    'nominal'    => $saldo,
                ];
                $total_pendapatan += $saldo;
            } elseif ($first_char === '5') {
                $saldo = $nsd > 0 ? $nsd : 0;
                $beban[] = (object)[
                    'kode_akun3' => $val->kode_akun3,
                    'nama_akun3' => $val->nama_akun3,
                    'nominal'    => $saldo,
                ];
                $total_beban += $saldo;
            }
        }

        $laba_rugi_bersih = $total_pendapatan - $total_beban;

        return [
            'pendapatan'       => $pendapatan,
            'total_pendapatan' => $total_pendapatan,
            'beban'            => $beban,
            'total_beban'      => $total_beban,
            'laba_rugi_bersih' => $laba_rugi_bersih,
        ];
    }

    public function get_perubahan_modal($tgl_awal = null, $tgl_akhir = null)
    {
        $dtlajur = $this->get_neraca_lajur($tgl_awal, $tgl_akhir);
        $modal_awal = 0;
        $prive = 0;

        foreach ($dtlajur as $val) {
            $ns = (float)$val->jumdebit - (float)$val->jumkredit;
            $ajp = (float)$val->jumdebits - (float)$val->jumkredits;
            $nsd = $ns + $ajp;

            if ($val->kode_akun3 == '3101') {
                $modal_awal += ($nsd < 0 ? abs($nsd) : -$nsd);
            } elseif ($val->kode_akun3 == '3201') {
                $prive += ($nsd > 0 ? $nsd : 0);
            }
        }

        $labarugi = $this->get_laba_rugi($tgl_awal, $tgl_akhir);
        $laba_bersih = $labarugi['laba_rugi_bersih'];
        $penambahan_modal = $laba_bersih - $prive;
        $modal_akhir = $modal_awal + $penambahan_modal;

        return [
            'modal_awal'       => $modal_awal,
            'laba_bersih'      => $laba_bersih,
            'prive'            => $prive,
            'penambahan_modal' => $penambahan_modal,
            'modal_akhir'      => $modal_akhir,
        ];
    }

    public function get_neraca($tgl_awal = null, $tgl_akhir = null)
    {
        $dtlajur = $this->get_neraca_lajur($tgl_awal, $tgl_akhir);
        $aktiva_lancar = [];
        $aktiva_tetap  = [];
        $kewajiban_pendek = [];
        $kewajiban_panjang = [];
        $total_aktiva_lancar = 0;
        $total_aktiva_tetap  = 0;
        $total_kewajiban_pendek = 0;
        $total_kewajiban_panjang = 0;

        foreach ($dtlajur as $val) {
            $ns = (float)$val->jumdebit - (float)$val->jumkredit;
            $ajp = (float)$val->jumdebits - (float)$val->jumkredits;
            $nsd = $ns + $ajp;

            $prefix2 = substr((string)$val->kode_akun3, 0, 2);

            if ($prefix2 === '11') {
                $nominal = $nsd > 0 ? $nsd : 0;
                $aktiva_lancar[] = (object)[
                    'kode_akun3' => $val->kode_akun3,
                    'nama_akun3' => $val->nama_akun3,
                    'nominal'    => $nominal,
                ];
                $total_aktiva_lancar += $nominal;
            } elseif ($prefix2 === '12') {
                $nominal = $nsd;
                $aktiva_tetap[] = (object)[
                    'kode_akun3' => $val->kode_akun3,
                    'nama_akun3' => $val->nama_akun3,
                    'nominal'    => $nominal,
                ];
                $total_aktiva_tetap += $nominal;
            } elseif ($prefix2 === '21') {
                $nominal = $nsd < 0 ? abs($nsd) : 0;
                $kewajiban_pendek[] = (object)[
                    'kode_akun3' => $val->kode_akun3,
                    'nama_akun3' => $val->nama_akun3,
                    'nominal'    => $nominal,
                ];
                $total_kewajiban_pendek += $nominal;
            } elseif ($prefix2 === '22') {
                $nominal = $nsd < 0 ? abs($nsd) : 0;
                $kewajiban_panjang[] = (object)[
                    'kode_akun3' => $val->kode_akun3,
                    'nama_akun3' => $val->nama_akun3,
                    'nominal'    => $nominal,
                ];
                $total_kewajiban_panjang += $nominal;
            }
        }

        $perubahan_modal = $this->get_perubahan_modal($tgl_awal, $tgl_akhir);
        $modal_akhir = $perubahan_modal['modal_akhir'];

        $total_aktiva = $total_aktiva_lancar + $total_aktiva_tetap;
        $total_kewajiban = $total_kewajiban_pendek + $total_kewajiban_panjang;
        $total_pasiva = $total_kewajiban + $modal_akhir;

        return [
            'aktiva_lancar'           => $aktiva_lancar,
            'total_aktiva_lancar'     => $total_aktiva_lancar,
            'aktiva_tetap'            => $aktiva_tetap,
            'total_aktiva_tetap'      => $total_aktiva_tetap,
            'total_aktiva'            => $total_aktiva,
            'kewajiban_pendek'        => $kewajiban_pendek,
            'total_kewajiban_pendek'  => $total_kewajiban_pendek,
            'kewajiban_panjang'       => $kewajiban_panjang,
            'total_kewajiban_panjang' => $total_kewajiban_panjang,
            'total_kewajiban'         => $total_kewajiban,
            'modal_akhir'             => $modal_akhir,
            'total_pasiva'            => $total_pasiva,
        ];
    }

    public function get_arus_kas($tgl_awal = null, $tgl_akhir = null)
    {
        $builder = $this->db->table('tbl_nilai');
        $builder->select('tbl_transaksi.tanggal, tbl_transaksi.kwitansi, tbl_transaksi.deskripsi, tbl_transaksi.ketjurnal, tbl_nilai.debit, tbl_nilai.kredit, tbl_status.status');
        $builder->join('tbl_transaksi', 'tbl_transaksi.id_transaksi = tbl_nilai.id_transaksi');
        $builder->join('tbl_status', 'tbl_status.id_status = tbl_nilai.id_status', 'left');
        $builder->where('tbl_nilai.kode_akun3', '1101');
        if (!empty($tgl_awal) && !empty($tgl_akhir)) {
            $builder->where('tbl_transaksi.tanggal >=', $tgl_awal);
            $builder->where('tbl_transaksi.tanggal <=', $tgl_akhir);
        }
        $builder->orderBy('tbl_transaksi.tanggal', 'ASC');
        $builder->orderBy('tbl_transaksi.id_transaksi', 'ASC');
        $rows = $builder->get()->getResult();

        $kas_masuk = [];
        $kas_keluar = [];
        $total_kas_masuk = 0;
        $total_kas_keluar = 0;

        foreach ($rows as $r) {
            if ($r->debit > 0) {
                $kas_masuk[] = $r;
                $total_kas_masuk += (float)$r->debit;
            }
            if ($r->kredit > 0) {
                $kas_keluar[] = $r;
                $total_kas_keluar += (float)$r->kredit;
            }
        }

        $kenaikan_bersih = $total_kas_masuk - $total_kas_keluar;
        $saldo_akhir = $kenaikan_bersih;

        return [
            'mutasi'           => $rows,
            'kas_masuk'        => $kas_masuk,
            'total_kas_masuk'  => $total_kas_masuk,
            'kas_keluar'       => $kas_keluar,
            'total_kas_keluar' => $total_kas_keluar,
            'kenaikan_bersih'  => $kenaikan_bersih,
            'saldo_akhir'      => $saldo_akhir,
        ];
    }
}

