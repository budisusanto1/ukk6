<?php

namespace App\Models;

use CodeIgniter\Model;

class M_jenis extends Model
{
    protected $table = 'jenis_bullying';
    protected $primaryKey = 'id_jenis';
    protected $allowedFields = ['nama_jenis'];
    protected $returnType = 'object';

    public function jenisdata()
    {
        return $this->findAll();
    }
}
