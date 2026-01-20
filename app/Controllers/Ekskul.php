<?php

namespace App\Controllers;

use App\Models\M_ekskul;
use App\Models\M_guru;

class Ekskul extends BaseController
{
    public function __construct()
    {
        $this->model = new M_ekskul();
        $this->mguru = new M_guru();
    }

    public function input()
    {
        $data = [
            'nama_ekskul' => $this->request->getPost('nama_ekskul'),
            'id_instruktur' => $this->request->getPost('id_instruktur'),
            'kuota' => $this->request->getPost('kuota'),
        ];
        $this->model->insert($data);
        return redirect()->back()->with('success', 'Ekskul berhasil ditambahkan.');
    }

    public function editview($id)
    {
        $parent['ekskul'] = $this->model->find($id);
        $parent['guru'] = $this->mguru->findAll();


        echo view('header');
        echo view('eekskul', $parent);
        echo view('footer');
    }

    public function simpan()
    {
        $id_ekskul = $this->request->getPost('id_ekskul');

        $this->model->update($id_ekskul, [
            'nama_ekskul' => $this->request->getPost('nama_ekskul'),
            'id_instruktur' => $this->request->getPost('id_instruktur'),
            'kuota' => $this->request->getPost('kuota'),
        ]);
        return redirect()->to('/tampildata')
            ->with('success', 'Berhasil edit data.');
    }

    public function hapus($id)
    {
        $this->model->delete($id);
        return redirect()->to('/tampildata')->with('success', 'Ekskul has been deleted.');
    }
}
