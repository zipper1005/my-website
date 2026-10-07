<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\ModelTransaksi;
use App\Models\ModelNilai;
use App\Models\ModelAkun3;
use App\Models\ModelStatus;

class Transaksi extends ResourceController
{
    protected $objTransaksi;
    protected $objNilai;
    protected $objAkun3;
    protected $objStatus;
    protected $db;

    public function __construct()
    {
        $this->objTransaksi = new ModelTransaksi();
        $this->objNilai     = new ModelNilai();
        $this->objAkun3     = new ModelAkun3();
        $this->objStatus    = new ModelStatus();
        $this->db           = \Config\Database::connect();
    }

    /**
     * Return an array of resource objects, themselves in array format.
     */
    public function index()
    {
        $data['dttransaksi'] = $this->objTransaksi->findAll();
        return view('transaksi/index', $data);
    }

    /**
     * Return a new resource object, with default properties.
     */
    public function new()
    {
        return view('transaksi/new');
    }

    /**
     * Return list of akun3 as JSON for dynamic select options in jQuery.
     */
    public function akun3()
    {
        $akun3 = $this->objAkun3->findAll();
        return $this->response->setJSON($akun3);
    }

    /**
     * Return list of status as JSON for dynamic select options in jQuery.
     */
    public function status()
    {
        $status = $this->objStatus->findAll();
        return $this->response->setJSON($status);
    }

    /**
     * Create a new resource object, from "posted" parameters.
     */
    public function create()
    {
        // 1. Simpan ke tabel transaksi
        $data1 = [
            'kwitansi'  => $this->request->getVar('kwitansi'),
            'tanggal'   => $this->request->getVar('tanggal'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'ketjurnal' => $this->request->getVar('ketjurnal'),
        ];
        $this->objTransaksi->insert($data1);

        // 2. Ambil ID transaksi yang baru diinsert
        $id_transaksi = $this->objTransaksi->getInsertID();

        // 3. Ambil data nilai transaksi dari form dinamis
        $kode_akun3 = $this->request->getVar('kode_akun3');
        $debit      = $this->request->getVar('debit');
        $kredit     = $this->request->getVar('kredit');
        $id_status  = $this->request->getVar('id_status');

        // 4. Simpan ke tabel nilai secara batch
        $data2 = [];
        if (!empty($kode_akun3)) {
            for ($i = 0; $i < count($kode_akun3); $i++) {
                $data2[] = [
                    'id_transaksi' => $id_transaksi,
                    'kode_akun3'   => $kode_akun3[$i],
                    'debit'        => $debit[$i] !== '' ? $debit[$i] : 0,
                    'kredit'       => $kredit[$i] !== '' ? $kredit[$i] : 0,
                    'id_status'    => $id_status[$i],
                ];
            }
            $this->objNilai->insertBatch($data2);
        }

        return redirect()->to(site_url('transaksi'))->with('success', 'Data Berhasil Disimpan');
    }

    /**
     * Return the properties of a resource object (Detail Transaksi).
     */
    public function show($id = null)
    {
        $transaksi = $this->objTransaksi->find($id);
        if (!$transaksi) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $builder = $this->db->table('tbl_nilai');
        $builder->select('tbl_nilai.*, akun3s.nama_akun3, tbl_status.status');
        $builder->join('akun3s', 'akun3s.kode_akun3 = tbl_nilai.kode_akun3');
        $builder->join('tbl_status', 'tbl_status.id_status = tbl_nilai.id_status');
        $builder->where('id_transaksi', $id);
        $nilai = $builder->get()->getResult();

        $data = [
            'dttransaksi' => $transaksi,
            'dtnilai'     => $nilai,
        ];
        return view('transaksi/show', $data);
    }

    /**
     * Return the editable properties of a resource object (Edit Transaksi).
     */
    public function edit($id = null)
    {
        $transaksi = $this->objTransaksi->find($id);
        if (!$transaksi) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $nilai  = $this->objNilai->where('id_transaksi', $id)->findAll();
        $akun3  = $this->objAkun3->findAll();
        $status = $this->objStatus->findAll();

        $data = [
            'dttransaksi' => $transaksi,
            'dtnilai'     => $nilai,
            'dtakun3'     => $akun3,
            'dtstatus'    => $status,
        ];
        return view('transaksi/edit', $data);
    }

    /**
     * Add or update a model resource, from "posted" properties.
     */
    public function update($id = null)
    {
        // 1. Update data master transaksi
        $data1 = [
            'kwitansi'  => $this->request->getVar('kwitansi'),
            'tanggal'   => $this->request->getVar('tanggal'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'ketjurnal' => $this->request->getVar('ketjurnal'),
        ];
        $this->objTransaksi->update($id, $data1);

        // 2. Hapus baris nilai transaksi lama untuk id_transaksi ini
        $this->objNilai->where('id_transaksi', $id)->delete();

        // 3. Masukkan baris nilai transaksi baru secara batch
        $kode_akun3 = $this->request->getVar('kode_akun3');
        $debit      = $this->request->getVar('debit');
        $kredit     = $this->request->getVar('kredit');
        $id_status  = $this->request->getVar('id_status');

        $data2 = [];
        if (!empty($kode_akun3)) {
            for ($i = 0; $i < count($kode_akun3); $i++) {
                $data2[] = [
                    'id_transaksi' => $id,
                    'kode_akun3'   => $kode_akun3[$i],
                    'debit'        => $debit[$i] !== '' ? $debit[$i] : 0,
                    'kredit'       => $kredit[$i] !== '' ? $kredit[$i] : 0,
                    'id_status'    => $id_status[$i],
                ];
            }
            $this->objNilai->insertBatch($data2);
        }

        return redirect()->to(site_url('transaksi'))->with('success', 'Data Berhasil Diupdate');
    }

    /**
     * Delete the designated resource object from the model.
     */
    public function delete($id = null)
    {
        $this->objTransaksi->where(['id_transaksi' => $id])->delete();
        return redirect()->to(site_url('transaksi'))->with('success', 'Data Berhasil di Hapus');
    }
}
