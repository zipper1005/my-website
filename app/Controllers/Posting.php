<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelTransaksi;
use App\Models\ModelAkun3;
use TCPDF;

class Posting extends BaseController
{
    protected $objTransaksi;
    protected $objAkun3;
    protected $db;

    public function __construct()
    {
        $this->objTransaksi = new ModelTransaksi();
        $this->objAkun3     = new ModelAkun3();
        $this->db           = \Config\Database::connect();
    }

    public function index()
    {
        $tgl_awal   = $this->request->getVar('tgl_awal');
        $tgl_akhir  = $this->request->getVar('tgl_akhir');
        $kode_akun3 = $this->request->getVar('kode_akun3');

        $dtposting = $this->objTransaksi->get_posting($tgl_awal, $tgl_akhir, $kode_akun3);
        $dtakun3   = $this->objAkun3->findAll();

        $data = [
            'dtposting'  => $dtposting,
            'dtakun3'    => $dtakun3,
            'tgl_awal'   => $tgl_awal,
            'tgl_akhir'  => $tgl_akhir,
            'kode_akun3' => $kode_akun3,
        ];

        return view('posting/index', $data);
    }

    public function cetakpostingpdf()
    {
        $tgl_awal   = $this->request->getVar('tgl_awal');
        $tgl_akhir  = $this->request->getVar('tgl_akhir');
        $kode_akun3 = $this->request->getVar('kode_akun3');

        $dtposting = $this->objTransaksi->get_posting($tgl_awal, $tgl_akhir, $kode_akun3);
        $dtakun3   = $this->objAkun3->findAll();

        $data = [
            'dtposting'  => $dtposting,
            'dtakun3'    => $dtakun3,
            'tgl_awal'   => $tgl_awal,
            'tgl_akhir'  => $tgl_akhir,
            'kode_akun3' => $kode_akun3,
        ];

        $html = view('posting/cetakpostingpdf', $data);

        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('AABW');
        $pdf->SetTitle('Laporan Posting Buku Besar');
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetMargins(15, 15, 15);
        $pdf->SetAutoPageBreak(true, 15);
        $pdf->AddPage();
        $pdf->writeHTML($html, true, false, true, false, '');
        $this->response->setContentType('application/pdf');
        $pdf->Output('laporan_posting.pdf', 'I');
    }
}
