<?php

namespace App\Controllers;

use App\Models\M_login;
use App\Models\M_level;

class User extends BaseController
{
    public function __construct()
    {
        $this->model  = new M_login();
        $this->mlevel = new M_level();
    }

    public function input()
    {
        $foto = $this->request->getFile('foto');
        $fotoName = null;

        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            $fotoName = $foto->getRandomName();
            $foto->move('uploads/', $fotoName);
        }

        $data = [
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
            'password' => MD5($this->request->getPost('password')),
            'level'    => $this->request->getPost('level'),
            'foto'     => $fotoName,
        ];

        $this->model->insert($data);
        return redirect()->to('/tampildata')->with('success', 'User berhasil ditambahkan.');
    }

    public function editview($id)
    {
        $parent['level'] = $this->mlevel->findAll();
        $parent['user']  = $this->model->find($id);

        echo view('header');
        echo view('euser', $parent);
        echo view('footer');
    }

    public function simpan()
    {
        $id = $this->request->getPost('id');

        $data = [
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
            'level'    => $this->request->getPost('level'),
        ];

        $password = $this->request->getPost('password');
        if (!empty($password)) {
            $data['password'] = MD5($password);
        }

        $this->model->update($id, $data);

        return redirect()->to('/tampildata')
            ->with('success', 'Berhasil edit data.');
    }

    public function hapus($id)
    {
        $this->model->delete($id);
        return redirect()->to('/tampildata')->with('success', 'User berhasil dihapus.');
    }
}
