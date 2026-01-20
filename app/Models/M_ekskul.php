<?php

namespace App\Models;

use CodeIgniter\Model;

class M_ekskul extends Model
{
    protected $table = 'ekskul';
    protected $primaryKey = 'id_ekskul';
    protected $allowedFields = [
        'nama_ekskul',
        'id_instruktur',
        'kuota',
    ];

    protected $returnType = 'object';

    public function EkskulData()
    {
        return $this->db->table('ekskul')
            ->select('
                ekskul.*,
                guru.nama_guru
            ')
            ->join('guru', 'guru.id_guru = ekskul.id_instruktur')
            ->get()
            ->getResult();
    }

}
