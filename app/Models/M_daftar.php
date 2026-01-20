<?php

namespace App\Models;

use CodeIgniter\Model;

class M_daftar extends Model
{
    protected $table = 'pendaftaran_ekskul';
    protected $primaryKey = 'id_daftar';
    protected $allowedFields = [
        'id_siswa',
        'id_ekskul',
        'tanggal_daftar',
        'status',
    ];

    protected $returnType = 'object';

    public function DaftarData()
    {
        return $this->db->table('pendaftaran_ekskul')
            ->select('
                pendaftaran_ekskul.*,
                ekskul.nama_ekskul,
                siswa.nama_siswa,
            ')
            ->join('ekskul', 'ekskul.id_ekskul = pendaftaran_ekskul.id_ekskul')
            ->join('siswa', 'siswa.id_siswa = pendaftaran_ekskul.id_siswa')
            ->get()
            ->getResult();
    }

    // public function DaftarDataByRole($level, $id_user)
    // {
    //     $builder = $this->db->table('pendaftaran_ekskul')
    //         ->select('
    //         pendaftaran_ekskul.*,
    //         ekskul.nama_ekskul,
    //         siswa.nama_siswa
    //     ')
    //         ->join('ekskul', 'ekskul.id_ekskul = pendaftaran_ekskul.id_ekskul')
    //         ->join('siswa', 'siswa.id_siswa = pendaftaran_ekskul.id_siswa');
    //     if ($level == 3) {
    //         $builder->where('siswa.id_user', $id_user);
    //     }

    //     if ($level == 2) {
    //         $builder->join('guru', 'guru.id_guru = ekskul.id_instruktur');
    //         $builder->where('guru.id_user', $id_user);
    //     }


    //     return $builder->get()->getResult();
    // }

    public function DaftarDataByRole($level, $id_user, $mode = 'ekskul')
    {
        $builder = $this->db->table('pendaftaran_ekskul pe')
            ->select('
            pe.*,
            siswa.nama_siswa,
            ekskul.nama_ekskul
        ')
            ->join('siswa', 'siswa.id_siswa = pe.id_siswa')
            ->join('ekskul', 'ekskul.id_ekskul = pe.id_ekskul');

        // ================= ADMIN =================
        if ($level == 1) {
            return $builder->get()->getResult();
        }

        // ================= SISWA =================
        if ($level == 3) {
            $builder->where('siswa.id_user', $id_user);
            return $builder->get()->getResult();
        }

        // ================= GURU =================
        if ($level == 2) {

            // 1️⃣ ambil id_guru dari id_user
            $guru = $this->db->table('guru')
                ->where('id_user', $id_user)
                ->get()
                ->getRow();

            // kalau user level guru tapi tidak ada di tabel guru (aman)
            if (!$guru) {
                return [];
            }

            // 2️⃣ cek wali kelas (rombel)
            $wali = $this->db->table('rombel')
                ->where('id_guru', $guru->id_guru)
                ->get()
                ->getRow();

            if ($wali && $mode === 'rombel') {
                // 🔥 wali kelas → semua murid rombel
                $builder->where('siswa.id_rombel', $wali->id_rombel);
            } else {
                // ekskul yang diajar
                $builder->where('ekskul.id_instruktur', $guru->id_guru);
            }

            return $builder->get()->getResult();
        }

        return [];
    }



    public function countBySiswa($id_siswa)
    {
        return $this->where('id_siswa', $id_siswa)
            ->whereIn('status', ['pending', 'disetujui'])
            ->countAllResults();
    }

    public function existsBySiswaEkskul($id_siswa, $id_ekskul)
    {
        return $this->where('id_siswa', $id_siswa)
            ->where('id_ekskul', $id_ekskul)
            ->countAllResults() > 0;
    }
}
