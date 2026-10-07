<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelAkun3 extends Model
{
    protected $table            = 'akun3s';
    protected $primaryKey       = 'id_akun3';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['kode_akun3', 'nama_akun3', 'kode_akun1', 'kode_akun2'];

    public function ambil_relasi()
    {
        $builder = $this->db->table('akun3s');
        $builder->join('akun1s', 'akun1s.id_akun1 = akun3s.kode_akun1');
        $builder->join('akun2s', 'akun2s.id_akun2 = akun3s.kode_akun2');
        $query = $builder->get();
        return $query->getResult();
    }
}
