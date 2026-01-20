<?php

namespace App\Models;

use CodeIgniter\Model;

class M_jadwal extends Model
{
    protected $table = 'jadwal_ekskul';
    protected $primaryKey = 'id_jadwal';
    protected $allowedFields = [
        'id_ekskul',
        'hari',
        'jam_mulai',
        'jam_selesai',
    ];

    protected $returnType = 'object';

    public function JadwalData()
    {
        return $this->db->table('jadwal_ekskul')
            ->select('
                jadwal_ekskul.*,
                ekskul.nama_ekskul
            ')
            ->join('ekskul', 'ekskul.id_ekskul = jadwal_ekskul.id_ekskul')
            ->get()
            ->getResult();
    }

}
