<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelTransaksi;
use TCPDF;

class PerubahanModal extends BaseController
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

        $data_pm = $this->objTransaksi->get_perubahan_modal($tgl_awal, $tgl_akhir);

        $data = [
            'title'     => 'Laporan Perubahan Modal',
            'data_pm'   => $data_pm,
            'tgl_awal'  => $tgl_awal,
            'tgl_akhir' => $tgl_akhir,
        ];

        return view('perubahanmodal/index', $data);
    }

    public function cetakperubahanmodalpdf()
    {
        $tgl_awal  = $this->request->getVar('tgl_awal');
        $tgl_akhir = $this->request->getVar('tgl_akhir');

        $data_pm = $this->objTransaksi->get_perubahan_modal($tgl_awal, $tgl_akhir);

        $data = [
            'data_pm'   => $data_pm,
            'tgl_awal'  => $tgl_awal,
            'tgl_akhir' => $tgl_akhir,
        ];

        $html = view('perubahanmodal/cetakperubahanmodalpdf', $data);

        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('AABW');
        $pdf->SetTitle('Laporan Perubahan Modal');
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetMargins(15, 15, 15);
        $pdf->SetAutoPageBreak(true, 15);
        $pdf->AddPage();
        $pdf->writeHTML($html, true, false, true, false, '');
        $this->response->setContentType('application/pdf');
        $pdf->Output('laporan_perubahan_modal.pdf', 'I');
    }
}
