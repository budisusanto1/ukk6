<?php

namespace App\Controllers;

use App\Models\M_kelas;

class Kelas extends BaseController
{
    public function __construct()
    {
        $this->model = new M_kelas();
    }

    public function input()
    {
        $data = [
            'nama_kelas' => $this->request->getPost('nama_kelas'),
        ];
        $this->model->insert($data);
        return redirect()->back()->with('success', 'Kelas berhasil ditambahkan.');
    }

    public function editview($id)
    {
        $parent['kelas'] = $this->model->find($id);

        echo view('header');
        echo view('ekelas', $parent);
        echo view('footer');
    }

    public function simpan()
    {
        $id_kelas = $this->request->getPost('id_kelas');

        $this->model->update($id_kelas, [
            'nama_kelas' => $this->request->getPost('nama_kelas'),
        ]);
        return redirect()->to('/tampildata')
            ->with('success', 'Berhasil edit data.');
    }

    public function hapus($id)
    {
        $this->model->delete($id);
        return redirect()->to('/tampildata')->with('success', 'Kelas has been deleted.');
    }
}
