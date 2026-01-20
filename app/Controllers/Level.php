<?php

namespace App\Controllers;

use App\Models\M_level;


class Level extends BaseController
{
    public function __construct()
    {
        $this->model = new M_level();
    }

    public function input()
    {
        $this->model->insert([
            'nama_level' => $this->request->getPost('nama_level'),
        ]);
        return redirect()->to('/tampildata');
    }

    public function editview($id)
    {
        $parent['level'] = $this->model->find($id);

        echo view('header');
        echo view('elevel', $parent);
        echo view('footer');
    }

    public function simpan()
    {
        $id = $this->request->getPost('id');

        $this->model->update($id, [
            'nama_level' => $this->request->getPost('nama_level'),
        ]);
        return redirect()->to('/tampildata')->with('success', 'Berhasil edit data.');
    }

    public function hapus($id)
    {
        $this->model->delete($id);
        return redirect()->to('/tampildata')->with('success', 'Product has been  deleted.');
    }
}
