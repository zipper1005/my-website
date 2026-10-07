<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\ModelAkun3;
use App\Models\ModelAkun2;

class Akun3 extends ResourceController
{
    protected $objAkun3;
    protected $objAkun2;
    protected $db;

    public function __construct()
    {
        $this->objAkun3 = new ModelAkun3();
        $this->objAkun2 = new ModelAkun2();
        $this->db = \Config\Database::connect();
    }

    /**
     * Return an array of resource objects, themselves in array format.
     */
    public function index()
    {
        $data['dtakun3'] = $this->objAkun3->ambil_relasi();
        return view('akun3/index', $data);
    }

    /**
     * Return the properties of a resource object.
     */
    public function show($id = null)
    {
        //
    }

    /**
     * Return a new resource object, with default properties.
     */
    public function new()
    {
        $builder = $this->db->table('akun1s');
        $query = $builder->get();
        $data['dtakun1'] = $query->getResult();
        $data['dtakun2'] = $this->objAkun2->findAll();
        return view('akun3/new', $data);
    }

    /**
     * Create a new resource object, from "posted" parameters.
     */
    public function create()
    {
        $data = [
            'kode_akun3' => $this->request->getVar('kode_akun3'),
            'nama_akun3' => $this->request->getVar('nama_akun3'),
            'kode_akun1' => $this->request->getVar('kode_akun1'),
            'kode_akun2' => $this->request->getVar('kode_akun2'),
        ];
        $this->db->table('akun3s')->insert($data);
        return redirect()->to(site_url('akun3'))->with('success', 'Data Berhasil Disimpan');
    }

    /**
     * Return the editable properties of a resource object.
     */
    public function edit($id = null)
    {
        $akun3 = $this->objAkun3->find($id);
        if (is_object($akun3)) {
            $data['dtakun3'] = $akun3;
            $query = $this->db->table('akun1s')->get();
            $data['dtakun1'] = $query->getResult();
            $data['dtakun2'] = $this->objAkun2->findAll();
            return view('akun3/edit', $data);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    /**
     * Add or update a model resource, from "posted" properties.
     */
    public function update($id = null)
    {
        $data = [
            'kode_akun3' => $this->request->getVar('kode_akun3'),
            'nama_akun3' => $this->request->getVar('nama_akun3'),
            'kode_akun1' => $this->request->getVar('kode_akun1'),
            'kode_akun2' => $this->request->getVar('kode_akun2'),
        ];
        $this->db->table('akun3s')->where(['id_akun3' => $id])->update($data);
        return redirect()->to(site_url('akun3'))->with('success', 'Data Berhasil di Update');
    }

    /**
     * Delete the designated resource object from the model.
     */
    public function delete($id = null)
    {
        $this->db->table('akun3s')->where(['id_akun3' => $id])->delete();
        return redirect()->to(site_url('akun3'))->with('success', 'Data Berhasil di Hapus');
    }
}
