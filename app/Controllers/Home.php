<?php

namespace App\Controllers;

use App\Models\M_guru;
use App\Models\M_kelas;
use App\Models\M_level;
use App\Models\M_login;
use App\Models\M_siswa;
use App\Models\M_ekskul;
use App\Models\M_rombel;
use App\Models\M_jurusan;
use App\Models\M_jenis;







class Home extends BaseController
{
    public function __construct()
    {
        $this->model = new M_login();
        $this->mlevel = new M_level();
        $this->msiswa = new M_siswa();
        $this->mkelas = new M_kelas();
        $this->mjurusan = new M_jurusan();
        $this->mrombel = new M_rombel();
        $this->mguru = new M_guru();
        $this->mekskul = new M_ekskul();
        $this->M_jenis = new M_jenis();


    }

    public function index()
    {
        if (session()->get('level') > 0) {
            echo view('header');
            echo view('menu');
            echo view('index');
            echo view('footer');
        } else {
            return redirect()->to('/');
        }
    }

    public function tampildata()
    {
        if (in_array(session()->get('level'), [1, 2, 3, 4, 6])) {
            $parent['user'] = $this->model->findAll();
            $parent['level'] = $this->mlevel->findAll();
            $parent['kelas'] = $this->mkelas->findAll();
            $parent['jurusan'] = $this->mjurusan->findAll();
            $parent['siswa'] = $this->msiswa->SiswaData();
            $parent['rombel'] = $this->mrombel->RombelData();
            $parent['guru'] = $this->mguru->GuruData();
   $parent['jenis_bullying'] = $this->M_jenis->jenisdata();

            echo view('header');
            echo view('tampildata', $parent);
            echo view('footer');
        } else {
            return redirect()->to('/');
        }
    }

    public function formdatas()
    {
        if (session()->get('level') == 1 || session()->get('level') == 2 || session()->get('level') == 3 || session()->get('level') == 4 || session()->get('level') == 6){
            $parent['rombel'] = $this->mrombel->RombelData();
            $parent['level'] = $this->mlevel->findAll();
            $parent['kelas'] = $this->mkelas->findAll();
            $parent['jurusan'] = $this->mjurusan->findAll();
            $parent['guru'] = $this->mguru->GuruData();
            $parent['user'] = $this->model->findAll();
            echo view('header');
            echo view ('menu');
            echo view ('inputdatas', $parent);
            echo view ('footer');
        }else if (session()->get('level')>0){
            return redirect()->to('/error');
        }else{
            return redirect()->to('/');
        }
    }



    // public function selesai($id)
    // {
    //     $this->model->update($id, ['status' => 'selesai']);
    //     return redirect()->back()->with('success', 'Tugas selesai.');
    // }

    // public function inputview()
    // {
    //     echo view('header');
    //     echo view('input');
    //     echo view('footer');
    // }

    // public function input()
    // {
    //     $nama_tugas = $this->request->getPost('nama_tugas');
    //     $tanggal = $this->request->getPost('tanggal');
    //     $prioritas = $this->request->getPost('prioritas');
    //     $this->model->insert([
    //         'nama_tugas' => $nama_tugas,
    //         'tanggal' => $tanggal,
    //         'prioritas' => $prioritas,
    //         'status' => "belum selesai"
    //     ]);
    //     return redirect()->to('');
    // }


    // public function editview($id)
    // {
    //     $parent['tugas'] = $this->model->find($id);

    //     echo view('header');
    //     echo view('edit', $parent);
    //     echo view('footer');
    // }

    // public function simpan()
    // {
    //     $id = $this->request->getPost('id');

    //     $this->model->update($id, [
    //         'nama_tugas' => $this->request->getPost('nama_tugas'),
    //         'prioritas'  => $this->request->getPost('prioritas'),
    //         'tanggal'    => $this->request->getPost('tanggal'),
    //     ]);
    //     return redirect()->to('')->with('success', 'Berhasil edit data.');
    // }


    // public function hapus($id)
    // {
    //     $this->model->delete($id);s
    //     return redirect()->to('')->with('success', 'Product has been soft deleted.');
    // }
}
