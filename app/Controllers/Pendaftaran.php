<?php

namespace App\Controllers;

use App\Models\M_daftar;
use App\Models\M_ekskul;
use App\Models\M_siswa;
use Config\Database;


class Pendaftaran extends BaseController
{
    public function __construct()
    {
        $this->db = Database::connect();
        $this->model = new M_daftar();
        $this->mekskul = new M_ekskul();
        $this->msiswa = new M_siswa();
    }

    // public function index()
    // {
    //     $level   = session()->get('level');
    //     $id_user = session()->get('id_user');

    //     if (!in_array($level, [1, 2, 3])) {
    //         return redirect()->to('/');
    //     }

    //     $parent['daftar'] = $this->model->DaftarDataByRole($level, $id_user);

    //     echo view('header');
    //     echo view('menu');
    //     echo view('pendaftaran', $parent);
    // }

    // public function index()
    // {
    //     $level   = session()->get('level');
    //     $id_user = session()->get('id_user');

    //     if (!in_array($level, [1, 2, 3])) {
    //         return redirect()->to('/');
    //     }

    //     // 🔥 DEFAULT MODE
    //     $mode = 'ekskul';

    //     if ($level == 2) {
    //         // cek apakah wali kelas
    //         $guru = $this->db->table('guru')->where('id_user', $id_user)->get()->getRow();
    //         if ($guru) {
    //             $wali = $this->db->table('rombel')->where('id_guru', $guru->id_guru)->get()->getRow();
    //             if ($wali) {
    //                 $mode = 'rombel'; // ⬅️ INI KUNCINYA
    //             }
    //         }
    //     }

    //     $parent['daftar'] = $this->model->DaftarDataByRole($level, $id_user, $mode);

    //     echo view('header');
    //     echo view('menu');
    //     echo view('pendaftaran', $parent);
    // }

   public function index()
{
    $level   = session()->get('level');
    $id_user = session()->get('id_user');

    if (!in_array($level, [1, 2, 3])) {
        return redirect()->to('/');
    }

    // default mode
    $mode = $this->request->getGet('mode') ?? 'ekskul';

    // ==========================
    // MODE KHUSUS GURU (LEVEL 2)
    // ==========================
    if ($level == 2) {
        $guru = $this->db->table('guru')
            ->where('id_user', $id_user)
            ->get()
            ->getRow();

        if ($guru) {
            $wali = $this->db->table('rombel')
                ->where('id_guru', $guru->id_guru)
                ->get()
                ->getRow();

            // kalau wali kelas & belum pilih manual
            if ($wali && !$this->request->getGet('mode')) {
                $mode = 'rombel';
            }
        }
    }

    // ==========================
    // DATA TABEL
    // ==========================
    $parent['mode']   = $mode;
    $parent['daftar'] = $this->model->DaftarDataByRole($level, $id_user, $mode);

    // ==========================
    // 🔥 TAMBAHAN PENTING
    // HITUNG JUMLAH EKSKUL SISWA
    // ==========================
    $jumlahEkskul = 0;

    if ($level == 3) { // KHUSUS SISWA
        $siswa = $this->msiswa->getByUserId($id_user);
        if ($siswa) {
            $jumlahEkskul = $this->model->countBySiswa($siswa->id_siswa);
        }
    }

    $parent['jumlahEkskul'] = $jumlahEkskul;

    // ==========================
    // LOAD VIEW
    // ==========================
    echo view('header');
    echo view('menu');
    echo view('pendaftaran', $parent);
}


    public function formdaftar()
    {
        if (session()->get('level') == 1 || session()->get('level') == 2 || session()->get('level') == 3) {
            $parent['siswa'] = $this->msiswa->SiswaData();
            $parent['ekskul'] = $this->mekskul->EkskulData();
            echo view('header');
            echo view('menu');
            echo view('inputdaftar', $parent);
            echo view('footer');
        } else if (session()->get('level') > 0) {
            return redirect()->to('/error');
        } else {
            return redirect()->to('/');
        }
    }


    public function input()
    {
        $role = session()->get('level');

        // Ambil id_siswa
        if ($role === '3') { // siswa
            $id_user = session()->get('id_user');
            $siswa = $this->msiswa->getByUserId($id_user);

            if (!$siswa) {
                return redirect()->back()->with('error', 'Data siswa tidak ditemukan');
            }

            $id_siswa = $siswa->id_siswa;
        } else {
            $id_siswa = $this->request->getPost('siswa');
        }

        $id_ekskul = $this->request->getPost('ekskul');

        // 🔒 CEK MAKSIMAL 4 EKSKUL
        $jumlahDaftar = $this->model->countBySiswa($id_siswa);
        if ($jumlahDaftar >= 4) {
            return redirect()->back()
                ->with('error', 'Maksimal pendaftaran ekskul adalah 4');
        }

        // 🔒 CEK DUPLIKAT EKSKUL (fallback manual)
        if ($this->model->existsBySiswaEkskul($id_siswa, $id_ekskul)) {
            return redirect()->back()
                ->with('error', 'Siswa sudah terdaftar pada ekskul tersebut');
        }

        // 🔒 INSERT + fallback UNIQUE DB
        try {
            $this->model->insert([
                'id_siswa'  => $id_siswa,
                'id_ekskul' => $id_ekskul,
                'status'    => 'pending'
            ]);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Pendaftaran gagal: data sudah ada');
        }
        return redirect()->to('/daftar')
            ->with('success', 'Data berhasil disimpan');
    }


    // Terima
    public function terima($id)
    {
        $this->model->update($id, ['status' => 'disetujui']);
        return redirect()->back();
    }

    // Tolak
    public function tolak($id)
    {
        $this->model->update($id, ['status' => 'ditolak']);
        return redirect()->back();
    }

    public function hapus($id)
    {
        $this->model->delete($id);
        return redirect()->to('/jadwal')->with('success', 'Product has been soft deleted.');
    }
}
