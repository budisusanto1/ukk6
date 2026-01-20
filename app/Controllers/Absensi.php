<?php

namespace App\Controllers;

use App\Models\M_daftar;
use App\Models\M_absensi;

class Absensi extends BaseController
{
    public function __construct()
    {
        $this->mdaftar = new M_daftar();
        $this->mabsensi = new M_absensi();
    }

    public function index()
{
    $level   = session()->get('level');
    $id_user = session()->get('id_user');

    if (!in_array($level, [1, 2, 3])) {
        return redirect()->to('/');
    }

    // 🔥 DEFAULT MODE
    $mode = $this->request->getGet('mode') ?? 'ekskul';

    // GURU
    if ($level == 2) {
        $db = \Config\Database::connect();

        $guru = $db->table('guru')
            ->where('id_user', $id_user)
            ->get()
            ->getRow();

        if ($guru) {
            $wali = $db->table('rombel')
                ->where('id_guru', $guru->id_guru)
                ->get()
                ->getRow();

            // kalau wali kelas & belum pilih mode manual
            if ($wali && !$this->request->getGet('mode')) {
                $mode = 'rombel';
            }
        }
    }

    // 🔥 ambil data sesuai role + mode
    $daftar = $this->mdaftar->DaftarDataByRole($level, $id_user, $mode);

    // Filter hanya yang disetujui
    $approved = array_filter($daftar, function ($item) {
        return $item->status === 'disetujui';
    });

    $today = date('Y-m-d');

    foreach ($approved as &$item) {
        $item->keterangan = null;
        $item->tanggal_absen = $today;
        $item->id_absen = null;

        $absensi = $this->mabsensi
            ->where('id_daftar', $item->id_daftar)
            ->orderBy('tanggal', 'DESC')
            ->first();

        if ($absensi) {
            $item->tanggal_absen = $absensi->tanggal;

            if ($absensi->tanggal === $today) {
                $item->keterangan = $absensi->keterangan;
                $item->id_absen = $absensi->id_absen;
            }
        }
    }

    $data = [
        'daftar' => array_values($approved),
        'mode'   => $mode
    ];

    echo view('header');
    echo view('menu');
    echo view('absensi', $data);
}


//     public function index()
//     {
//         $level = session()->get('level');
//         $id_user = session()->get('id_user');

//         if (!in_array($level, [1, 2, 3])) {
//             return redirect()->to('/');
//         }

//         // Get approved registrations based on role
//         $daftar = $this->mdaftar->DaftarDataByRole($level, $id_user);

//         // Filter only 'disetujui' status
//         $approved = array_filter($daftar, function ($item) {
//             return $item->status === 'disetujui';
//         });

//         // Get today's date
//        $today = date('Y-m-d');

// foreach ($approved as &$item) {

//     // default
//     $item->keterangan = null;
//     $item->tanggal_absen = $today;
//     $item->id_absen = null;

//     $absensi = $this->mabsensi
//         ->where('id_daftar', $item->id_daftar)
//         ->orderBy('tanggal', 'DESC')
//         ->first();

//     if ($absensi) {
//         $item->tanggal_absen = $absensi->tanggal;

//         // HANYA tampilkan keterangan kalau tanggal = hari ini
//         if ($absensi->tanggal === $today) {
//             $item->keterangan = $absensi->keterangan;
//             $item->id_absen = $absensi->id_absen;
//         }
//     }
// }




//         $data['daftar'] = array_values($approved);


//         echo view('header');
//         echo view('menu');
//         echo view('absensi', $data);
//     }

    public function update()
    {
        $id_daftar = $this->request->getPost('id_daftar');
        $keterangan = $this->request->getPost('keterangan');
        $today = date('Y-m-d');

        // Check if already absent today
        $existing = $this->mabsensi->where('id_daftar', $id_daftar)
            ->where('tanggal', $today)
            ->first();

        if ($existing) {
            // Update existing
            $this->mabsensi->update($existing->id_absen, ['keterangan' => $keterangan]);
        } else {
            // Insert new
            $this->mabsensi->insert([
                'id_daftar' => $id_daftar,
                'tanggal' => $today,
                'keterangan' => $keterangan
            ]);
        }

        return $this->response->setJSON(['success' => true]);
    }
}
