<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\ModelAkun2;

class Akun2 extends ResourceController
{
    protected $objAkun2;
    protected $db;

    public function __construct()
    {
        $this->objAkun2 = new ModelAkun2();
        $this->db = \Config\Database::connect();
    }

    /**
     * Return an array of resource objects, themselves in array format.
     */
    public function index()
    {
        $data['dtakun2'] = $this->objAkun2->ambil_relasi();
        return view('akun2/index', $data);
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
        return view('akun2/new', $data);
    }

    /**
     * Create a new resource object, from "posted" parameters.
     */
    public function create()
    {
        $data = [
            'kode_akun2' => $this->request->getVar('kode_akun2'),
            'nama_akun2' => $this->request->getVar('nama_akun2'),
            'kode_akun1' => $this->request->getVar('kode_akun1'),
        ];
        $this->db->table('akun2s')->insert($data);
        return redirect()->to(site_url('akun2'))->with('success', 'Data Berhasil Disimpan');
    }

    /**
     * Return the editable properties of a resource object.
     */
    public function edit($id = null)
    {
        $akun2 = $this->objAkun2->find($id);
        if (is_object($akun2)) {
            $data['dtakun2'] = $akun2;
            $query = $this->db->table('akun1s')->get();
            $data['dtakun1'] = $query->getResult();
            return view('akun2/edit', $data);
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
            'kode_akun2' => $this->request->getVar('kode_akun2'),
            'nama_akun2' => $this->request->getVar('nama_akun2'),
            'kode_akun1' => $this->request->getVar('kode_akun1'),
        ];
        $this->db->table('akun2s')->where(['id_akun2' => $id])->update($data);
        return redirect()->to(site_url('akun2'))->with('success', 'Data Berhasil di Update');
    }

    /**
     * Delete the designated resource object from the model.
     */
    public function delete($id = null)
    {
        $this->db->table('akun2s')->where(['id_akun2' => $id])->delete();
        return redirect()->to(site_url('akun2'))->with('success', 'Data Berhasil di Hapus');
    }
}
