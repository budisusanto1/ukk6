<?php

namespace App\Models;

use CodeIgniter\Model;

class M_rombel extends Model
{
    protected $table = 'rombel';
    protected $primaryKey = 'id_rombel';
    protected $allowedFields = [
        'nama_rombel',
        'id_kelas',
        'id_jurusan',
        'id_guru',
    ];

    protected $returnType = 'object';

    public function RombelData()
    {
        return $this->db->table('rombel')
            ->select('
                rombel.*,
                kelas.nama_kelas,
                jurusan.nama_jurusan,
                guru.nama_guru
            ')
            ->join('guru', 'guru.id_guru = rombel.id_guru')
            ->join('kelas', 'kelas.id_kelas = rombel.id_kelas')
            ->join('jurusan', 'jurusan.id_jurusan = rombel.id_jurusan')
            ->get()
            ->getResult();
    }
}
