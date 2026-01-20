<?php

namespace App\Controllers;

use App\Models\M_login;

class Login extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new M_login();
    }

    public function login()
    {
        $angka1 = rand(1, 10);
        $angka2 = rand(1, 10);

        session()->set('captcha_jawaban', $angka1 + $angka2);

        return view('login', [
            'soal_captcha' => "$angka1 + $angka2"
        ]);
    }

    public function aksi_login()
    {
        $isOnline = $this->request->getPost('is_online');

        /* ================= CAPTCHA ================= */
        if ($isOnline == "1") {
            $recaptcha_secret  = "6LeZQekqAAAAAIk1nT3Xbz4KcKFyZ4Uk51w8m1b4";
            $recaptcha_response = $this->request->getPost('g-recaptcha-response');

            $verify_url = "https://www.google.com/recaptcha/api/siteverify";
            $response = file_get_contents($verify_url . "?secret={$recaptcha_secret}&response={$recaptcha_response}");
            $result = json_decode($response, true);

            if (empty($result['success'])) {
                return redirect()->back()->with('error', 'reCAPTCHA verification failed.');
            }
        } else {
            $jawabanUser   = $this->request->getPost('captcha_jawaban');
            $jawabanBenar  = session()->get('captcha_jawaban');

            if ((int)$jawabanUser !== (int)$jawabanBenar) {
                return redirect()->back()->with('error', 'Jawaban captcha salah!');
            }
        }

        /* ================= LOGIN ================= */
        $username = $this->request->getPost('user');
        $password = md5($this->request->getPost('pass'));

        $user = $this->model
            ->where('username', $username)
            ->where('password', $password)
            ->first(); // CI4.6 standard

        if (!$user) {
            return redirect()->to('/')->with('error', 'Invalid login credentials');
        }

        /* ================= SESSION ================= */
        session()->set([
            'id_user'  => $user->id_user,
            'email'    => $user->email,
            'username' => $user->username,
            'level'    => $user->level,
            'foto'     => $user->foto,
            'logged_in' => true
        ]);


        /* ================= REDIRECT ================= */
        if ($user->level == 3) {
            return redirect()->to('/daftar');
        } 
        return redirect()->to('/home');
    }

    public function signin()
    {
        return view('signin');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/')->with('success', 'You have been logged out.');
    }
}
