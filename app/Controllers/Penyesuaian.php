<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\ModelPenyesuaian;
use App\Models\ModelNilaiPenyesuaian;
use App\Models\ModelAkun3;
use App\Models\ModelStatus;

class Penyesuaian extends ResourceController
{
    protected $objPenyesuaian;
    protected $objNilaiPenyesuaian;
    protected $objAkun3;
    protected $objStatus;
    protected $db;

    public function __construct()
    {
        $this->objPenyesuaian       = new ModelPenyesuaian();
        $this->objNilaiPenyesuaian  = new ModelNilaiPenyesuaian();
        $this->objAkun3             = new ModelAkun3();
        $this->objStatus            = new ModelStatus();
        $this->db                   = \Config\Database::connect();
    }

    /**
     * Return an array of resource objects, themselves in array format.
     */
    public function index()
    {
        $data['dtpenyesuaian'] = $this->objPenyesuaian->findAll();
        return view('penyesuaian/index', $data);
    }

    /**
     * Return a new resource object, with default properties.
     */
    public function new()
    {
        return view('penyesuaian/new');
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
        // 1. Simpan ke tabel penyesuaian
        $data1 = [
            'tanggal'   => $this->request->getVar('tanggal'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'nilai'     => $this->request->getVar('nilai'),
            'waktu'     => $this->request->getVar('waktu'),
            'jumlah'    => $this->request->getVar('jumlah'),
        ];
        $this->objPenyesuaian->insert($data1);

        // 2. Ambil ID penyesuaian yang baru diinsert
        $id_penyesuaian = $this->objPenyesuaian->getInsertID();

        // 3. Ambil data nilai penyesuaian dari form dinamis
        $kode_akun3 = $this->request->getVar('kode_akun3');
        $debit      = $this->request->getVar('debit');
        $kredit     = $this->request->getVar('kredit');
        $id_status  = $this->request->getVar('id_status');

        // 4. Simpan ke tabel nilai penyesuaian secara batch
        $data2 = [];
        if (!empty($kode_akun3)) {
            for ($i = 0; $i < count($kode_akun3); $i++) {
                $data2[] = [
                    'id_penyesuaian' => $id_penyesuaian,
                    'kode_akun3'     => $kode_akun3[$i],
                    'debit'          => $debit[$i] !== '' ? $debit[$i] : 0,
                    'kredit'         => $kredit[$i] !== '' ? $kredit[$i] : 0,
                    'id_status'      => $id_status[$i],
                ];
            }
            $this->objNilaiPenyesuaian->insertBatch($data2);
        }

        return redirect()->to(site_url('penyesuaian'))->with('success', 'Data Penyesuaian Berhasil Disimpan');
    }

    /**
     * Return the properties of a resource object (Detail Penyesuaian).
     */
    public function show($id = null)
    {
        $penyesuaian = $this->objPenyesuaian->find($id);
        if (!$penyesuaian) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $builder = $this->db->table('tbl_nilai_penyesuaian');
        $builder->select('tbl_nilai_penyesuaian.*, akun3s.nama_akun3, tbl_status.status');
        $builder->join('akun3s', 'akun3s.kode_akun3 = tbl_nilai_penyesuaian.kode_akun3');
        $builder->join('tbl_status', 'tbl_status.id_status = tbl_nilai_penyesuaian.id_status');
        $builder->where('id_penyesuaian', $id);
        $nilai = $builder->get()->getResult();

        $data = [
            'dtpenyesuaian'      => $penyesuaian,
            'dtnilai_penyesuaian' => $nilai,
        ];
        return view('penyesuaian/show', $data);
    }

    /**
     * Return the editable properties of a resource object (Edit Penyesuaian).
     */
    public function edit($id = null)
    {
        $penyesuaian = $this->objPenyesuaian->find($id);
        if (!$penyesuaian) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $nilai  = $this->objNilaiPenyesuaian->where('id_penyesuaian', $id)->findAll();
        $akun3  = $this->objAkun3->findAll();
        $status = $this->objStatus->findAll();

        $data = [
            'dtpenyesuaian'       => $penyesuaian,
            'dtnilai_penyesuaian' => $nilai,
            'dtakun3'             => $akun3,
            'dtstatus'            => $status,
        ];
        return view('penyesuaian/edit', $data);
    }

    /**
     * Add or update a model resource, from "posted" properties.
     */
    public function update($id = null)
    {
        // 1. Update tabel master penyesuaian
        $data1 = [
            'tanggal'   => $this->request->getVar('tanggal'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'nilai'     => $this->request->getVar('nilai'),
            'waktu'     => $this->request->getVar('waktu'),
            'jumlah'    => $this->request->getVar('jumlah'),
        ];
        $this->objPenyesuaian->update($id, $data1);

        // 2. Hapus baris detail lama untuk id_penyesuaian ini
        $this->objNilaiPenyesuaian->where('id_penyesuaian', $id)->delete();

        // 3. Masukkan baris detail baru secara batch
        $kode_akun3 = $this->request->getVar('kode_akun3');
        $debit      = $this->request->getVar('debit');
        $kredit     = $this->request->getVar('kredit');
        $id_status  = $this->request->getVar('id_status');

        $data2 = [];
        if (!empty($kode_akun3)) {
            for ($i = 0; $i < count($kode_akun3); $i++) {
                $data2[] = [
                    'id_penyesuaian' => $id,
                    'kode_akun3'     => $kode_akun3[$i],
                    'debit'          => $debit[$i] !== '' ? $debit[$i] : 0,
                    'kredit'         => $kredit[$i] !== '' ? $kredit[$i] : 0,
                    'id_status'      => $id_status[$i],
                ];
            }
            $this->objNilaiPenyesuaian->insertBatch($data2);
        }

        return redirect()->to(site_url('penyesuaian'))->with('success', 'Data Penyesuaian Berhasil Diupdate');
    }

    /**
     * Delete the designated resource object from the model.
     */
    public function delete($id = null)
    {
        $this->objPenyesuaian->where(['id_penyesuaian' => $id])->delete();
        return redirect()->to(site_url('penyesuaian'))->with('success', 'Data Penyesuaian Berhasil di Hapus');
    }
}
