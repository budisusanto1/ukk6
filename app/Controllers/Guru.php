<?php

namespace App\Controllers;

use App\Models\M_guru;
use App\Models\M_login;

class Guru extends BaseController
{
    public function __construct()
    {
        $this->model = new M_guru();
        $this->muser = new M_login();
    }

    public function input()
    {
        // 1. Insert ke tabel user
        $userData = [
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
            'password' => MD5($this->request->getPost('password')),
            'level'    => '2' // opsional, kalau ada kolom level
        ];

        $this->muser->insert($userData);
        $id_user = $this->muser->getInsertID();

        // 2. Insert ke tabel guru
        $guruData = [
            'nip'       => $this->request->getPost('nip'),
            'nama_guru' => $this->request->getPost('nama_guru'),
             'no_hp'  => $this->request->getPost('no_hp'),
           'alamat'  => $this->request->getPost('alamat'),
           'jenis_kelamin'  => $this->request->getPost('jenis_kelamin'),
            'tempat_lahir'  => $this->request->getPost('tempat_lahir'),
          'tanggal_lahir'  => $this->request->getPost('tanggal_lahir'),
          'jabatan'  => $this->request->getPost('jabatan'),
            'id_user'   => $id_user,
        ];

        $this->model->insert($guruData);

        return redirect()->to('/tampildata')->with('success', 'Guru dan user berhasil ditambahkan.');
    }

    public function editview($id)
    {
        $guruData = $this->model->guruData();
        $parent['guru'] = null;
        foreach ($guruData as $s) {
            if ($s->id_guru == $id) {
                $parent['guru'] = $s;
                break;
            }
        }

        echo view('header');
        echo view('eguru', $parent);
        echo view('footer');
    }


    public function simpan()
    {
        $id_guru = $this->request->getPost('id_guru');
        $id_user = $this->request->getPost('id_user');

        // Update user table
        $userData = [
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
            'level'    => 3
        ];
        $password = $this->request->getPost('password');
        if (!empty($password)) {
            $userData['password'] = MD5($password);
        }
        $this->muser->update($id_user, $userData);

        // Update guru table
        $guruData = [
            'nip' => $this->request->getPost('nip'),
            'nama_guru' => $this->request->getPost('nama_guru'),
             'no_hp'  => $this->request->getPost('no_hp'),
           'alamat'  => $this->request->getPost('alamat'),
           'jenis_kelamin'  => $this->request->getPost('jenis_kelamin'),
            'tempat_lahir'  => $this->request->getPost('tempat_lahir'),
          'tanggal_lahir'  => $this->request->getPost('tanggal_lahir'),
             'jabatan'  => $this->request->getPost('jabatan'),
            'id_rombel' => $this->request->getPost('id_rombel'),
        ];
        $this->model->update($id_guru, $guruData);

        return redirect()->to('/tampildata')
            ->with('success', 'Berhasil edit data.');
    }

    public function hapus($id)
    {
        $guru = $this->model->find($id);
        if ($guru) {
            $this->model->delete($id);
            $this->muser->delete($guru->id_user);
        }

        return redirect()->to('/tampildata')->with('success', 'Guru berhasil dihapus.');
    }
}
