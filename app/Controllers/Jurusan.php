<?php

namespace App\Controllers;

use App\Models\M_jurusan;

class Jurusan extends BaseController
{
    public function __construct()
    {
        $this->model = new M_jurusan();
    }

    public function input()
    {
        $data = [
            'nama_jurusan' => $this->request->getPost('nama_jurusan'),
        ];
        $this->model->insert($data);
        return redirect()->back()->with('success', 'Jurusan berhasil ditambahkan.');
    }

    public function editview($id)
    {
        $parent['jurusan'] = $this->model->find($id);

        echo view('header');
        echo view('ejurusan', $parent);
        echo view('footer');
    }

    public function simpan()
    {
        $id_jurusan = $this->request->getPost('id_jurusan');

        $this->model->update($id_jurusan, [
            'nama_jurusan' => $this->request->getPost('nama_jurusan'),
        ]);
        return redirect()->to('/tampildata')
            ->with('success', 'Berhasil edit data.');
    }

    public function hapus($id)
    {
        $this->model->delete($id);
        return redirect()->to('/tampildata')->with('success', 'Jurusan has been deleted.');
    }
}
