<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPenyesuaian extends Model
{
    protected $table            = 'tbl_penyesuaian';
    protected $primaryKey       = 'id_penyesuaian';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['tanggal', 'deskripsi', 'nilai', 'waktu', 'jumlah'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
