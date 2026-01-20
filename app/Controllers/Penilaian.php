<?php

namespace App\Controllers;

use App\Models\M_daftar;
use App\Models\M_nilai;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Penilaian extends BaseController
{
    public function __construct()
    {
        $this->mdaftar = new M_daftar();
        $this->mnilai = new M_nilai();
    }

    // public function index()
    // {

    //     $current_month = $this->request->getGet('bulan') ?? date('Y-m');
    //     $is_locked = ($current_month < date('Y-m'));

    //     $level = session()->get('level');
    //     $id_user = session()->get('id_user');

    //     if (!in_array($level, [1, 2, 3])) {
    //         return redirect()->to('/');
    //     }

    //     // 🔹 BULAN DIPILIH

    //     $daftar = $this->mdaftar->DaftarDataByRole($level, $id_user);

    //     $approved = array_filter($daftar, function ($item) {
    //         return $item->status === 'disetujui';
    //     });

    //     foreach ($approved as &$item) {
    //         $nilai = $this->mnilai
    //             ->where('id_daftar', $item->id_daftar)
    //             ->where('bulan', $current_month)
    //             ->first();

    //         $item->nilai    = $nilai->nilai ?? null;
    //         $item->predikat = $nilai->predikat ?? null;
    //         $item->catatan  = $nilai->catatan ?? null;
    //     }

    //     $data = [
    //         'daftar'        => $approved,
    //         'current_month' => $current_month,
    //         'is_locked'     => $is_locked
    //     ];


    //     echo view('header');
    //     echo view('menu');
    //     echo view('penilaian', $data);
    // }

    public function index()
{
    $current_month = $this->request->getGet('bulan') ?? date('Y-m');
    $is_locked = ($current_month < date('Y-m'));

    $level   = session()->get('level');
    $id_user = session()->get('id_user');

    if (!in_array($level, [1, 2, 3])) {
        return redirect()->to('/');
    }

    // 🔥 MODE (toggle)
    $mode = $this->request->getGet('mode') ?? 'ekskul';

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

            // default wali kelas → rombel
            if ($wali && !$this->request->getGet('mode')) {
                $mode = 'rombel';
            }
        }
    }

    // 🔥 ambil data pakai mode
    $daftar = $this->mdaftar->DaftarDataByRole($level, $id_user, $mode);

    // hanya yang disetujui
    $approved = array_filter($daftar, function ($item) {
        return $item->status === 'disetujui';
    });

    foreach ($approved as &$item) {
        $nilai = $this->mnilai
            ->where('id_daftar', $item->id_daftar)
            ->where('bulan', $current_month)
            ->first();

        $item->nilai    = $nilai->nilai ?? null;
        $item->predikat = $nilai->predikat ?? null;
        $item->catatan  = $nilai->catatan ?? null;
    }

    $data = [
        'daftar'        => $approved,
        'current_month' => $current_month,
        'is_locked'     => $is_locked,
        'mode'          => $mode
    ];

    echo view('header');
    echo view('menu');
    echo view('penilaian', $data);
}


    public function update()
    {
        $bulan = $this->request->getPost('bulan');
        $id_daftar = $this->request->getPost('id_daftar');

        if ($bulan < date('Y-m')) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Nilai bulan ini sudah dikunci'
            ]);
        }

        $nilai    = $this->request->getPost('nilai');
        $predikat = $this->request->getPost('predikat');
        $catatan  = $this->request->getPost('catatan');

        if ($nilai && ($nilai < 1 || $nilai > 100)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Nilai harus 1-100'
            ]);
        }

        $existing = $this->mnilai
            ->where('id_daftar', $id_daftar)
            ->where('bulan', $bulan)
            ->first();

        $data = [
            'nilai'    => $nilai,
            'predikat' => $predikat,
            'catatan'  => $catatan,
            'bulan'    => $bulan
        ];

        if ($existing) {
            $this->mnilai->update($existing->id_nilai, $data);
        } else {
            $data['id_daftar'] = $id_daftar;
            $this->mnilai->insert($data);
        }

        return $this->response->setJSON(['success' => true]);
    }


    public function export()
    {
        $bulan = $this->request->getGet('bulan') ?? date('Y-m');

        $level   = session()->get('level');
        $id_user = session()->get('id_user');

        if (!in_array($level, [1, 2, 3])) {
            return redirect()->to('/');
        }

        // Ambil data sama seperti tabel
        $daftar = $this->mdaftar->DaftarDataByRole($level, $id_user);

        // Filter hanya yang disetujui
        $approved = array_filter($daftar, function ($item) {
            return $item->status === 'disetujui';
        });

        $rows = [];

        foreach ($approved as $item) {
            $nilai = $this->mnilai
                ->where('id_daftar', $item->id_daftar)
                ->where('bulan', $bulan)
                ->first();

            // kalau belum ada nilai, tetap ikut export (opsional)
            $rows[] = [
                'nama_siswa'  => $item->nama_siswa ?? '-',
                'nama_ekskul' => $item->nama_ekskul,
                'nilai'       => $nilai->nilai ?? '',
                'predikat'    => $nilai->predikat ?? '',
                'catatan'     => $nilai->catatan ?? ''
            ];
        }

        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=nilai-ekskul-$bulan.xls");

        echo "Nama Siswa\tEkskul\tNilai\tPredikat\tCatatan\n";
        foreach ($rows as $row) {
            echo "{$row['nama_siswa']}\t{$row['nama_ekskul']}\t{$row['nilai']}\t{$row['predikat']}\t{$row['catatan']}\n";
        }
        exit;
    }
}
