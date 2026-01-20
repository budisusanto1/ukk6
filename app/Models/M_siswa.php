<?php

namespace App\Models;

use CodeIgniter\Model;

class M_siswa extends Model
{
    protected $table = 'siswa';
    protected $primaryKey = 'id_siswa';
    protected $allowedFields = [
        'nis',
        'nama_siswa',
        'id_rombel',
        'id_user',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'no_hp',
    ];

    protected $returnType = 'object';

    public function SiswaData()
    {
        return $this->db->table('siswa')
            ->select('
                siswa.*,
                user.username,
                user.email,
                rombel.nama_rombel
            ')
            ->join('user', 'user.id_user = siswa.id_user')
            ->join('rombel', 'rombel.id_rombel = siswa.id_rombel')
            ->get()
            ->getResult();
    }

    public function getByUserId($id_user)
    {
        return $this->where('id_user', $id_user)->first();
    }
}
