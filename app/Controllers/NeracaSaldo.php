<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelTransaksi;
use TCPDF;

class NeracaSaldo extends BaseController
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

        $dttransaksi = $this->objTransaksi->get_neraca_saldo($tgl_awal, $tgl_akhir);

        $data = [
            'dttransaksi' => $dttransaksi,
            'tgl_awal'    => $tgl_awal,
            'tgl_akhir'   => $tgl_akhir,
        ];

        return view('neracasaldo/index', $data);
    }

    public function cetakneracasaldopdf()
    {
        $tgl_awal  = $this->request->getVar('tgl_awal');
        $tgl_akhir = $this->request->getVar('tgl_akhir');

        $dttransaksi = $this->objTransaksi->get_neraca_saldo($tgl_awal, $tgl_akhir);

        $data = [
            'dttransaksi' => $dttransaksi,
            'tgl_awal'    => $tgl_awal,
            'tgl_akhir'   => $tgl_akhir,
        ];

        $html = view('neracasaldo/cetakneracasaldopdf', $data);

        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('AABW');
        $pdf->SetTitle('Laporan Neraca Saldo');
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetMargins(15, 15, 15);
        $pdf->SetAutoPageBreak(true, 15);
        $pdf->AddPage();
        $pdf->writeHTML($html, true, false, true, false, '');
        $this->response->setContentType('application/pdf');
        $pdf->Output('laporan_neraca_saldo.pdf', 'I');
    }
}
