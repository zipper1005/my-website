<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelTransaksi;
use TCPDF;

class JurnalPenyesuaian extends BaseController
{
    protected $objTransaksi;
    protected $db;

    public function __construct()
    {
        $this->objTransaksi = new ModelTransaksi();
        $this->db           = \Config\Database::connect();
    }

    public function index()
    {
        $tgl_awal  = $this->request->getVar('tgl_awal');
        $tgl_akhir = $this->request->getVar('tgl_akhir');

        $dtpenyesuaian = $this->objTransaksi->get_penyesuaian($tgl_awal, $tgl_akhir);

        $data = [
            'dtpenyesuaian' => $dtpenyesuaian,
            'tgl_awal'      => $tgl_awal,
            'tgl_akhir'     => $tgl_akhir,
        ];

        return view('jurnalpenyesuaian/index', $data);
    }

    public function cetakjurnalpdf()
    {
        $tgl_awal  = $this->request->getVar('tgl_awal');
        $tgl_akhir = $this->request->getVar('tgl_akhir');

        $dtpenyesuaian = $this->objTransaksi->get_penyesuaian($tgl_awal, $tgl_akhir);

        $data = [
            'dtpenyesuaian' => $dtpenyesuaian,
            'tgl_awal'      => $tgl_awal,
            'tgl_akhir'     => $tgl_akhir,
        ];

        $html = view('jurnalpenyesuaian/cetakjurnalpdf', $data);

        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('AABW');
        $pdf->SetTitle('Laporan Jurnal Penyesuaian');
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetMargins(15, 15, 15);
        $pdf->SetAutoPageBreak(true, 15);
        $pdf->AddPage();
        $pdf->writeHTML($html, true, false, true, false, '');
        $this->response->setContentType('application/pdf');
        $pdf->Output('laporan_jurnal_penyesuaian.pdf', 'I');
    }
}
