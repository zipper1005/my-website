<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelAkun2 extends Model
{
    protected $table            = 'akun2s';
    protected $primaryKey       = 'id_akun2';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['kode_akun2', 'nama_akun2', 'kode_akun1'];

    public function ambil_relasi()
    {
        $builder = $this->db->table('akun2s');
        $builder->join('akun1s', 'akun1s.id_akun1 = akun2s.kode_akun1');
        $query = $builder->get();
        return $query->getResult();
    }
}
