<?php

namespace App\Controllers;

use App\Models\M_jadwal;
use App\Models\M_ekskul;







class Jadwal extends BaseController
{
    public function __construct()
    {
        $this->model = new M_jadwal();
        $this->mekskul = new M_ekskul();


    }

    public function index()
    {
        if (in_array(session()->get('level'), [1, 2, 3, 4, 6])) {
            $parent['jadwal'] = $this->model->JadwalData();

            echo view('header');
            echo view('menu');
            echo view('jadwal', $parent);
        } else {
            return redirect()->to('/');
        }
    }

    public function formjadwal()
    {
        if (session()->get('level') == 1 || session()->get('level') == 2 || session()->get('level') == 3 || session()->get('level') == 4 || session()->get('level') == 6){
            $parent['ekskul'] = $this->mekskul->EkskulData();
            echo view('header');
            echo view ('menu');
            echo view ('inputjadwal', $parent);
            echo view ('footer');
        }else if (session()->get('level')>0){
            return redirect()->to('/error');
        }else{
            return redirect()->to('/');
        }
    }


    public function input()
    {
        $this->model->insert([
            'id_ekskul' => $this->request->getPost('ekskul'),
            'hari' => $this->request->getPost('hari'),
            'jam_mulai' => $this->request->getPost('jam_mulai'),
            'jam_selesai' => $this->request->getPost('jam_selesai')
        ]);
        return redirect()->to('/jadwal');
    }


    public function editview($id)
    {
        $parent['jadwal'] = $this->model->find($id);
        $parent['ekskul'] = $this->mekskul->EkskulData();

        echo view('header');
        echo view('ejadwal', $parent);
        echo view('footer');
    }

    public function simpan()
    {
        $id = $this->request->getPost('id');

        $this->model->update($id, [
            'hari' => $this->request->getPost('hari'),
            'id_ekskul'  => $this->request->getPost('id_ekskul'),
            'jam_mulai'    => $this->request->getPost('jam_mulai'),
            'jam_selesai'    => $this->request->getPost('jam_selesai'),
        ]);
        return redirect()->to('/jadwal')->with('success', 'Berhasil edit data.');
    }


    public function hapus($id)
    {
        $this->model->delete($id);
        return redirect()->to('/jadwal')->with('success', 'Product has been soft deleted.');
    }
}
