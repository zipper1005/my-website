<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelTransaksi;
use TCPDF;

class ArusKas extends BaseController
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

        $data_ak = $this->objTransaksi->get_arus_kas($tgl_awal, $tgl_akhir);

        $data = [
            'title'     => 'Laporan Arus Kas',
            'data_ak'   => $data_ak,
            'tgl_awal'  => $tgl_awal,
            'tgl_akhir' => $tgl_akhir,
        ];

        return view('aruskas/index', $data);
    }

    public function cetakaruskaspdf()
    {
        $tgl_awal  = $this->request->getVar('tgl_awal');
        $tgl_akhir = $this->request->getVar('tgl_akhir');

        $data_ak = $this->objTransaksi->get_arus_kas($tgl_awal, $tgl_akhir);

        $data = [
            'data_ak'   => $data_ak,
            'tgl_awal'  => $tgl_awal,
            'tgl_akhir' => $tgl_akhir,
        ];

        $html = view('aruskas/cetakaruskaspdf', $data);

        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('AABW');
        $pdf->SetTitle('Laporan Arus Kas (Cash Flow)');
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetMargins(15, 15, 15);
        $pdf->SetAutoPageBreak(true, 15);
        $pdf->AddPage();
        $pdf->writeHTML($html, true, false, true, false, '');
        $this->response->setContentType('application/pdf');
        $pdf->Output('laporan_arus_kas.pdf', 'I');
    }
}
