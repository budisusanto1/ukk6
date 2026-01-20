<?php

namespace App\Controllers;

use App\Models\M_rombel;
use App\Models\M_kelas;
use App\Models\M_jurusan;
use App\Models\M_guru;


class Rombel extends BaseController
{
    public function __construct()
    {
        $this->model = new M_rombel();
        $this->mkelas = new M_kelas();
        $this->mjurusan = new M_jurusan();
        $this->mguru = new M_guru();

    }

    public function input()
    {
        $data = [
            'nama_rombel' => $this->request->getPost('nama_rombel'),
            'id_kelas' => $this->request->getPost('id_kelas'),
            'id_jurusan' => $this->request->getPost('id_jurusan'),
            'id_guru' => $this->request->getPost('id_guru'),
        ];
        $this->model->insert($data);
        return redirect()->back()->with('success', 'Rombel berhasil ditambahkan.');
    }

    public function editview($id)
    {
        $parent['rombel'] = $this->model->find($id);
        $parent['kelas'] = $this->mkelas->findAll();
        $parent['jurusan'] = $this->mjurusan->findAll();
        $parent['guru'] = $this->mguru->findAll();


        echo view('header');
        echo view('erombel', $parent);
        echo view('footer');
    }

    public function simpan()
    {
        $id_rombel = $this->request->getPost('id_rombel');

        $this->model->update($id_rombel, [
            'nama_rombel' => $this->request->getPost('nama_rombel'),
            'id_kelas' => $this->request->getPost('id_kelas'),
            'id_jurusan' => $this->request->getPost('id_jurusan'),
            'id_guru' => $this->request->getPost('id_guru'),
        ]);
        return redirect()->to('/tampildata')
            ->with('success', 'Berhasil edit data.');
    }

    public function hapus($id)
    {
        $this->model->delete($id);
        return redirect()->to('/tampildata')->with('success', 'Rombel has been deleted.');
    }
}
