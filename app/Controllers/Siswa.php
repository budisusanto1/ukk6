<?php

namespace App\Controllers;

use App\Models\M_login;
use App\Models\M_siswa;
use App\Models\M_rombel;


class Siswa extends BaseController
{
    public function __construct()
    {
        $this->model = new M_siswa();
        $this->muser = new M_login();
        $this->mrombel = new M_rombel();
    }

    public function input()
    {
        // 1. Insert ke tabel user
        $userData = [
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
            'password' => md5($this->request->getPost('password')), // disesuaikan dengan sistemmu
            'level' => 3
        ];
        $this->muser->insert($userData);
        $id_user = $this->muser->getInsertID();
        $siswaData = [
            'nis'        => $this->request->getPost('nis'),
            'nama_siswa' => $this->request->getPost('nama_siswa'),
            'id_rombel'  => $this->request->getPost('id_rombel'),
            'no_hp'  => $this->request->getPost('no_hp'),
           'alamat'  => $this->request->getPost('alamat'),
           'jenis_kelamin'  => $this->request->getPost('jenis_kelamin'),
            'tempat_lahir'  => $this->request->getPost('tempat_lahir'),
          'tanggal_lahir'  => $this->request->getPost('tanggal_lahir'),
            'id_user'    => $id_user,
        ];

        $this->model->insert($siswaData);

        return redirect()->to('/tampildata')->with('success', 'Siswa dan user berhasil ditambahkan.');
    }

    public function editview($id)
    {
        $siswaData = $this->model->SiswaData();
        $parent['siswa'] = null;
        foreach ($siswaData as $s) {
            if ($s->id_siswa == $id) {
                $parent['siswa'] = $s;
                break;
            }
        }
        $parent['rombel'] = $this->mrombel->RombelData();

        echo view('header');
        echo view('esiswa', $parent);
        echo view('footer');
    }

    public function simpan()
    {
        $id_siswa = $this->request->getPost('id_siswa');
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

        // Update siswa table
        $siswaData = [
            'nis' => $this->request->getPost('nis'),
            'nama_siswa' => $this->request->getPost('nama_siswa'),
              'no_hp'  => $this->request->getPost('no_hp'),
           'alamat'  => $this->request->getPost('alamat'),
           'jenis_kelamin'  => $this->request->getPost('jenis_kelamin'),
            'tempat_lahir'  => $this->request->getPost('tempat_lahir'),
          'tanggal_lahir'  => $this->request->getPost('tanggal_lahir'),
            'id_rombel' => $this->request->getPost('id_rombel'),
        ];
        $this->model->update($id_siswa, $siswaData);

        return redirect()->to('/tampildata')
            ->with('success', 'Berhasil edit data.');
    }

    public function hapus($id)
    {
        // Get siswa data to find id_user
        $siswa = $this->model->find($id);
        if ($siswa) {
            // Delete from siswa table first
            $this->model->delete($id);
            // Then delete from user table
            $this->muser->delete($siswa->id_user);
        }
        return redirect()->to('/tampildata')->with('success', 'Siswa has been deleted.');
    }
}
