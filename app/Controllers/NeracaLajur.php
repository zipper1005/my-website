<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelTransaksi;
use TCPDF;

class NeracaLajur extends BaseController
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

        $dttransaksi = $this->objTransaksi->get_neraca_lajur($tgl_awal, $tgl_akhir);

        $data = [
            'dttransaksi' => $dttransaksi,
            'tgl_awal'    => $tgl_awal,
            'tgl_akhir'   => $tgl_akhir,
        ];

        return view('neracalajur/index', $data);
    }

    public function cetaklajurpdf()
    {
        $tgl_awal  = $this->request->getVar('tgl_awal');
        $tgl_akhir = $this->request->getVar('tgl_akhir');

        $dttransaksi = $this->objTransaksi->get_neraca_lajur($tgl_awal, $tgl_akhir);

        $data = [
            'dttransaksi' => $dttransaksi,
            'tgl_awal'    => $tgl_awal,
            'tgl_akhir'   => $tgl_akhir,
        ];

        $html = view('neracalajur/cetaklajurpdf', $data);

        // Neraca Lajur 10 Kolom menggunakan orientasi Landscape ('L')
        $pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('AABW');
        $pdf->SetTitle('Laporan Neraca Lajur (Worksheet)');
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetMargins(10, 10, 10);
        $pdf->SetAutoPageBreak(true, 10);
        $pdf->AddPage();
        $pdf->writeHTML($html, true, false, true, false, '');
        $this->response->setContentType('application/pdf');
        $pdf->Output('laporan_neraca_lajur.pdf', 'I');
    }
}
