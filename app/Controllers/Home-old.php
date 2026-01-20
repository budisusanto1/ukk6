<?php

namespace App\Controllers;
use App\Models\M_belajar;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Html;

use TCPDF;


class Home extends BaseController
{
    public function __construct()
    {
        $this->model = new M_belajar(); // Initialize the model once
    }

    public function index()
    {
        if (session()->get('level') > 0) {
            echo view ('header');
            echo view ('menu');
            echo view('index');
            echo view ('footer');
        } else {
            return redirect()->to('/home/login');
        }
    }


    public function login()
    {
        // date_default_timezone_set('Asia/Jakarta');
        // $yesterday = [
        //     'created_at >=' => date('Y-m-d 00:00:00', strtotime('-1 day')),
        //     'created_at <=' => date('Y-m-d 23:59:59', strtotime('-1 day')),
        //     'level' => 5
        // ];
        // $this->model->hapus('user',$yesterday);

        $angka1 = rand(1, 10);
        $angka2 = rand(1, 10);
        $soal = "$angka1 + $angka2";
        session()->set('captcha_jawaban', $angka1 + $angka2);

        echo view('login',['webDetail' => $this->webDetail,
                            'soal_captcha' => $soal]);
    }

    public function welcome($nomeja)
    {
        echo view('loginguest',['webDetail' => $this->webDetail,
                                'nomeja' => $nomeja]);
    }


   public function aksi_login()
{
    $isOnline = $this->request->getPost('is_online');
    
        if ($isOnline == "1") {
    $recaptcha_secret = "6LeZQekqAAAAAIk1nT3Xbz4KcKFyZ4Uk51w8m1b4"; // Replace with your actual secret key
    $recaptcha_response = $_POST['g-recaptcha-response'];

    // Verify with Google
    $verify_url = "https://www.google.com/recaptcha/api/siteverify";
    $response = file_get_contents($verify_url . "?secret=" . $recaptcha_secret . "&response=" . $recaptcha_response);
    $response_keys = json_decode($response, true);

    if (!$response_keys["success"]) {
        echo "reCAPTCHA verification failed. Please try again.";
        exit();
    }
    } else {
            $jawabanUser = $this->request->getPost('captcha_jawaban');
            $jawabanBenar = session()->get('captcha_jawaban');
            if ((int)$jawabanUser !== (int)$jawabanBenar) {
                return redirect()->back()->with('error', 'Jawaban captcha salah!');
            }
        }


    //login biasa


    $data = array(
            'username'=> $this->request->getPost('user'),
            'password'=> MD5($this->request->getPost('pass')),
        );
        $cek = $this->model->getWhere('user',$data);   
           
        if ($cek != null) {

    // if ($cek && password_verify($password, $cek->password)) {
    session()->set('id_user', $cek->id_user);
    session()->set('email', $cek->email);
    session()->set('username', $cek->username);
    session()->set('level', $cek->level);
    session()->set('foto', $cek->foto);

        $this->model->log_activity(session()->get('id_user'), "User logged in");
         if ($cek->level == 6) {
            return redirect()->to('/home/tampiltransaksi');
        } elseif ($cek->level == 3 || $cek->level == 4) {
            return redirect()->to('/home/tampildata');
        } else {
            return redirect()->to('/home/index');
        }

    } else {
        return redirect()->to('/home/login')->with('error', 'Invalid login credentials');
    }
}

public function logout()
{
    $id = session()->get('id_user');
    $this->model->log_activity($id, "User logged out");
    session()->destroy();
    return redirect()->to('/home/login')->with('success', 'You have been logged out.');
}

public function aksi_register()
{

    $username = $this->request->getPost('username');
    $nomeja = $this->request->getPost('nomeja');
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
    $password = MD5(substr( str_shuffle( $chars ), 0, 8 ));
    $data = [
        'username' => $username,
        'level' => 5, // Default level is 2
        'no_meja' => $nomeja,
        'password' => $password,
    ];

    $this->model->input('user', $data);
    $cek = $this->model->getWhere('user',$data);
     session()->set('id_user', $cek->id_user);
    session()->set('username', $cek->username);
    session()->set('level', $cek->level);
    session()->set('no_meja', $cek->nomeja);

    $this->model->edit('user',['created_by'=>session()->get('id_user')],['id_user'=>session()->get('id_user')]);

    return redirect()->to('/home')->with('success', 'Registration successful! Please login.');
}
































public function forgorpass()
    {
        echo view ('header',['webDetail' => $this->webDetail]);
        echo view('forgorpass');
        echo view ('footer');
    }



public function forgot_password()
{
    $email = $this->request->getPost('email');

    // Check if the email exists in the database
    $user = $this->model->getWhere('user', ['email' => $email]);

    if (!$user || !is_object($user)) {
        return redirect()->to('/home/forgot_password')->with('error', 'No user found with this email.');
    }

    // Set the correct timezone before generating expiry
    date_default_timezone_set('Asia/Jakarta');
    $token = bin2hex(random_bytes(16));
    $token_hash = hash("sha256", $token);
    $expiry = date("Y-m-d H:i:s", strtotime("+20 minutes"));

    // Save token to the database
    $this->model->edit('user', [
        'token' => $token_hash,
        'expiry' => $expiry
    ], ['email' => $email]);

    // Reset link
    $resetLink = base_url("/home/reset_password?token=$token");

    // Create email content
    $subject = "Password Reset Request";
    $message = "
    <html>
    <head>
        <title>Password Reset Request</title>
    </head>
    <body>
        <p>Hello,</p>
        <p>You requested to reset your password. Click the link below to proceed:</p>
        <p><a href='$resetLink' style='color: blue;'>Reset Password</a></p>
        <p>If you did not request this, please ignore this email.</p>
        <p>Thank you.</p>
    </body>
    </html>
    ";

    // Send the email using PHPMailer
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';   // Your SMTP server
        $mail->SMTPAuth   = true;
        $mail->Username   = 'ryukusune@gmail.com';  // Your email
        $mail->Password   = 'wfsa qhmt mvrg tvwu';    // App password (NOT your real email password)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; 
        $mail->Port       = 587; 

        $mail->setFrom('ryukusune@gmail.com', 'Chibi-Tee Exam Website');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $message;

        $mail->send();
        return redirect()->to('/home/login')->with('success', 'A password reset link has been sent to your email.');
    } catch (Exception $e) {
        return redirect()->to('/home/forgot_password')->with('error', "Failed to send email. Error: {$mail->ErrorInfo}");
    }
}

public function reset_password()
{
    $token = $_GET['token'] ?? '';
    $token_hash = hash('sha256', $token); // Hash the token from the URL

    // Ensure correct timezone for token validation
    date_default_timezone_set('Asia/Jakarta');

    // Validate the token
    $reset = $this->model->getWhere('user', ['token' => $token_hash]);

    if (!$reset || !is_object($reset) || strtotime($reset->expiry) < time()) {
        $data['message'] = "Invalid or expired token.";
        return view('error_view', $data); // Render an error view
    }

    // Pass token to the view for the form
    $data['token'] = $token;
    echo view ('header',['webDetail' => $this->webDetail]);
    echo view('reset_password_view', $data); // Render the reset password view
    echo view ('footer');
}

public function update_password()
{
    $token = $_GET['token'] ?? '';
    $token_hash = hash('sha256', $token);
    // $password = 1111;
    $password = $this->request->getPost('pass');
    $confirmPassword = $this->request->getPost('confirm_password');

    if ($password !== $confirmPassword) {
        $data['message'] = "Passwords do not match.";
        $data['type'] = "error";
        return view('status_view', $data);
    }

    date_default_timezone_set('Asia/Jakarta');

    $reset = $this->model->getWhere('user', ['token' => $token_hash]);

    if (!$reset || !is_object($reset) || strtotime($reset->expiry) < time()) {
        $data['message'] = "Invalid or expired token.";
        $data['type'] = "error";
        echo view ('header',['webDetail' => $this->webDetail]);
        echo view('status_view', $data);
        echo view ('footer');
    }

    $this->model->edit('user', ['password' => null], ['email' => $reset->email]);

    // $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    $hashedPassword = md5($password);

    $data = [
        'token' => null,
        'expiry' => null,
        'password' => $hashedPassword,
    ];

    $this->model->edit('user', $data,  ['email' => $reset->email]);

    $data['message'] = "Your password has been updated successfully.";
    $data['type'] = "success";
    echo view ('header',['webDetail' => $this->webDetail]);
    echo view('status_view', $data);
    echo view ('footer');
}






















public function tampildata()
{
    if (in_array(session()->get('level'), [1, 2, 3, 4, 6])) {
        $where = ['deleted_at' => null];

        $parent['metode'] = $this->model->tampilnormal('metode_pembayaran', 'id_metode');
        $parent['produk'] = $this->model->joinwc('produk', 'kategori', 'produk.id_kategori=kategori.id_kategori', 'id_produk');
        $parent['kategori'] = $this->model->getWhereOpt('kategori', $where, false, 'id_kategori');
        $rows = $this->model->joinwc23t('paket_detail','paket','produk','paket_detail.id_paket=paket.id_paket','paket_detail.id_produk=produk.id_produk', '                            paket.id_paket');
        $paketList = [];
        foreach ($rows as $row) {
            $id = $row->id_paket;
            if (!isset($paketList[$id])) {
                $paketList[$id] = [
                    'id_paket' => $row->id_paket,
                    'nama_paket' => $row->nama_paket,
                    'deskripsi' => $row->deskripsi,
                    'harga_paket' => $row->harga_paket,
                    'produk' => [],
                ];
            }
            $paketList[$id]['produk'][] = $row->nama_produk . ' (' . $row->qty . 'x)';
        }

        $parent['paket'] = $paketList;

        echo view('header', ['webDetail' => $this->webDetail]);
        echo view('menu');
        echo view('tampildata', $parent);
    } else {
        return redirect()->to('/home/login');
    }
}

public function tampiltransaksi()
{
    if (in_array(session()->get('level'), [1, 2, 3, 4, 6])) {
        $parent['notaGrouped'] = [];

        $notaUtama = $this->model->getNotaUtama();

        foreach ($notaUtama as $nota) {
            $detail = $this->model->getDetailPesananByNota($nota['id_nota']);
            $groupedDetail = [];

            foreach ($detail as $row) {
                if ($row['produk_langsung']) {
                    // Produk langsung (bukan paket)
                    $groupedDetail[] = [
                        'type' => 'produk',
                        'nama' => $row['produk_langsung'],
                        'jumlah' => $row['jumlah_paket'],
                        'pesan' => $row['pesan'] ?? ''
                    ];

                } elseif ($row['nama_paket']) {
                    // Produk dalam paket
                    $key = $row['id_nota'] . '-' . $row['nama_paket'];
                    if (!isset($groupedDetail[$key])) {
                        $groupedDetail[$key] = [
                            'type' => 'paket',
                            'nama_paket' => $row['nama_paket'],
                            'jumlah_paket' => $row['jumlah'],
                            'pesan' => $row['pesan'] ?? '',
                            'isi' => []
                        ];
                    }

                    // Kalikan isi paket dengan jumlah paket dipesan
                    $groupedDetail[$key]['isi'][$row['produk_dalam_paket']] = [
                        'nama' => $row['produk_dalam_paket'],
                        'jumlah' => $row['total_produk_dalam_paket'],

                    ];

                }
            }

            $nota['detail'] = array_values($groupedDetail);
            $parent['notaGrouped'][] = $nota;
        }

        $parent['nota2'] = $this->model->join3(
            'nota',
            'metode_pembayaran',
            'user',
            'nota.id_metode=metode_pembayaran.id_metode',
            'nota.created_by=user.id_user',
            'id_nota'
        );

        echo view('header', ['webDetail' => $this->webDetail]);
        echo view('menu');
        echo view('tampiltransaksi', $parent);
    } else {
        return redirect()->to('/home/login');
    }
}

public function pesananSaya()
{
    $userId = session()->get('id_user');
    $tanggalHariIni = date('Y-m-d');

    // Ambil semua nota terbaru user hari ini
    $notaTerbaru = $this->model->HistoriPesanan([
        'nota.created_by' => $userId,
        'DATE(nota.created_at)' => $tanggalHariIni
    ]);

    $parent['notaGrouped'] = [];

    foreach ($notaTerbaru as $nota) {
        $detail = $this->model->getDetailPesananByNota($nota['id_nota']);
        $groupedDetail = [];

        foreach ($detail as $row) {
            // Produk langsung
            if (!empty($row['produk_langsung'])) {
                $groupedDetail[] = [
                    'type' => 'produk',
                    'nama' => $row['produk_langsung'],
                    'jumlah' => $row['jumlah_paket'],
                    'pesan' => $row['pesan'] ?? ''
                ];
            }
            // Paket
            elseif (!empty($row['nama_paket'])) {
                $key = $row['nama_paket']; // Cukup pakai nama_paket saja untuk grouping
                if (!isset($groupedDetail[$key])) {
                    $groupedDetail[$key] = [
                        'type' => 'paket',
                        'nama_paket' => $row['nama_paket'],
                        'jumlah_paket' => $row['jumlah'],
                        'pesan' => $row['pesan'] ?? '',
                        'isi' => []
                    ];
                }

                // Tambahkan isi paket
                $groupedDetail[$key]['isi'][] = [
                    'nama' => $row['produk_dalam_paket'],
                    'jumlah' => $row['total_produk_dalam_paket']
                ];
            }
        }

        // Reset key agar bisa di-foreach di view
        $nota['detail'] = array_values($groupedDetail);
        $parent['notaGrouped'][] = $nota;
    }

    // Opsional, untuk keperluan lain
    $parent['nota2'] = $this->model->join3w(
        'nota',
        'metode_pembayaran',
        'user',
        'nota.id_metode=metode_pembayaran.id_metode',
        'nota.created_by=user.id_user',
        'id_nota',
        [
            'nota.created_by' => $userId,
            'DATE(nota.created_at)' => $tanggalHariIni
        ]
    );

    echo view('header', ['webDetail' => $this->webDetail]);
    echo view ('menu');
    echo view('pesanan_saya', $parent);
}
















    public function formdatas()
    {
        if (session()->get('level') == 1 || session()->get('level') == 2 || session()->get('level') == 3 || session()->get('level') == 4 || session()->get('level') == 6){
            $parent['kategori']=$this->model->tampilexist('kategori','id_kategori');
            $parent['produk'] = $this->model->tampilexist('produk','id_produk');
            echo view('header',['webDetail' => $this->webDetail]);
            echo view ('menu');
            echo view ('inputdatas',$parent);
            echo view ('footer');
        }else if (session()->get('level')>0){
            return redirect()->to('/error');
        }else{
            return redirect()->to('/home/login');
        }
    }














public function input_produk()
{
    $nama_produk = $this->request->getPost('nama_produk');
    $temperatur = $this->request->getPost('temperatur');
    $deskripsi = $this->request->getPost('deskripsi');
    $kategori = $this->request->getPost('kategori');
    $status = $this->request->getPost('status');
    $harga = $this->request->getPost('harga');
    $harga_modal = $this->request->getPost('harga_modal');
    $foto = $this->request->getPost('foto_produk');

    $data = array(
        'nama_produk' => $nama_produk . ' '. $temperatur,
        'id_kategori' => $kategori,
        'status' => $status,
        'harga' => $harga,
        'harga_modal' => $harga_modal,
        'description' => $deskripsi,
        'created_by' => session()->get('id_user'),
        'foto' => $newFileName
    );
     $file = $_FILES["foto_produk"];
         $validExtensions = ["jpg", "png", "jpeg"];
         $extension = pathinfo($file["name"], PATHINFO_EXTENSION);
         $timestamp = time(); 
         $newFileName = $timestamp . "_" . $file["name"]; 
         move_uploaded_file($file["tmp_name"], "images/" . $newFileName);
         $data['foto'] = $newFileName; 

    $this->model->input('produk',$data);
    return redirect()->to('home/');
}


public function input_kategori()
{
    $foto = $this->request->getPost('icon_kategori');
    $nama_kategori = $this->request->getPost('nama_kategori');

    $data = array(
        'nama_kategori'=> $nama_kategori,
        'icon' => $newFileName,
        'created_by' => session()->get('id_user'),
    );

     $file = $_FILES["icon_kategori"];
         $validExtensions = ["jpg", "png", "jpeg"];
         $extension = pathinfo($file["name"], PATHINFO_EXTENSION);
         $timestamp = time(); 
         $newFileName = $timestamp . "_" . $file["name"]; 
         move_uploaded_file($file["tmp_name"], "images/" . $newFileName);
         $data['icon'] = $newFileName; 


    $this->model->input('kategori', $data);
    return redirect()->to('home/tampildata');
}

public function inputpemesanan()
{
    date_default_timezone_set('Asia/Jakarta');
    $cartData = $this->request->getPost('cart_data');
    $paymentMethod = $this->request->getPost('payment_method');
    $status = $this->request->getPost('status');
    $cart = json_decode($cartData, true);

    $userId = session()->get('id_user'); 
    $total = array_sum(array_column($cart, 'total'));
    $datanota = [
        'total' => $total,
        'id_metode' => $paymentMethod,
        'status' => $status,
        'due' => date('Y-m-d H:i:s'),
        'created_at' => date('Y-m-d H:i:s'),
        'created_by' =>  $userId,
    ];
    $this->model->input('nota', $datanota);
     $catch = $this->model->getWhere('nota', $datanota);
    $id_nota = $catch->id_nota;

   foreach ($cart as $item) {
        if ($item['tipe'] == 'produk') {
            // Pemesanan produk
            $this->model->input('pesanan', [
                'id_user' => $userId,
                'id_produk' => $item['id'],  // ID produk
                'jumlah' => $item['qty'],
                'pesan' => $item['note'],
                'tanggal_pesan' => date('Y-m-d H:i:s'),
                'id_nota' => $id_nota,
                'created_by' => session()->get('id_user'),
            ]);
        } elseif ($item['tipe'] == 'paket') {
            // Pemesanan paket
            $this->model->input('pesanan', [
                'id_user' => $userId,
                'id_paket' => $item['id'],  // ID paket
                'jumlah' => $item['qty'],
                'pesan' => $item['note'],
                'tanggal_pesan' => date('Y-m-d H:i:s'),
                'id_nota' => $id_nota,
                'created_by' => session()->get('id_user'),
            ]);
        }
    }


    // Redirect sesuai dengan level user
    if (session()->get('level') == 1 || session()->get('level') == 2 || session()->get('level') == 6) {
        return redirect()->to('/home/tampiltransaksi');
    } else if (session()->get('level') == 5) {
        return redirect()->to('/home/terimakasih');
    } else {
        return redirect()->to('/home/login');
    }
}




public function input_paket()
{
    $uuid = $this->model->generateUUIDBase36();
    $id_user = session()->get('id_user');
    $paketData = [
        'uuid' => $uuid,
        'nama_paket' => $this->request->getPost('nama_paket'),
        'deskripsi' => $this->request->getPost('deskripsi'),
        'harga_paket' => $this->request->getPost('harga_paket'),
        'created_by' => $id_user,

    ];

    $this->model->input('paket', $paketData);
    $catch = $this->model->getWhere('paket',['uuid' => $uuid]);
    $id_paket = $catch->id_paket;

    $produk_ids = $this->request->getPost('produk_ids');
    $jumlah = $this->request->getPost('jumlah');
    foreach ($produk_ids as $i => $id_produk) {
        if (!empty($id_produk) && !empty($jumlah[$i])) {
            $this->model->input('paket_detail', [
                'id_paket' => $id_paket,
                'id_produk' => $id_produk,
                'qty' => $jumlah[$i],
            ]);
        }
    }

    return redirect()->to('home/tampildata')->with('success', 'Paket berhasil disimpan!');
}

public function input_metode()
{
$id_user = session()->get('id_user');
$nama_metode = $this->request->getPost('nama_metode');
$kode = $this->request->getPost('kode_tujuan');
$data = array(
    'nama_metode' => $nama_metode,
    'kode' => $kode,
    'created_by' => $id_user,
    );
$this->model->input('metode_pembayaran', $data);
return redirect()->to('home/tampildata');
}




















 public function edit_produk($id)
    {
        if (session()->get('level') == 1 || session()->get('level') == 2 || session()->get('level') == 3 || session()->get('level') == 4){
        $where= array('id_produk' =>$id);
        $parent['child']=$this->model->getWhere('produk',$where);
        $parent['kategori']=$this->model->tampilexist('kategori','id_kategori');
        echo view('header',['webDetail' => $this->webDetail]);
        echo view ('menu');
        echo view('eproduk', $parent);
        echo view('footer');      
        }else{
            return redirect()->to('/home/login');
        }    
    } 

public function simpan_produk()
{
    if (session()->get('level') == 1 || session()->get('level') == 2 || session()->get('level') == 3 || session()->get('level') == 4) {
        $idProduk = $this->request->getPost('id');
        if (!$idProduk) {
            return redirect()->back()->with('error', 'ID Produk tidak valid.');
        }

        date_default_timezone_set('Asia/Jakarta');
        $now = date('Y-m-d H:i:s');

        $data = [
            'nama_produk' => $this->request->getPost('nama_produk'),
            'id_kategori' => $this->request->getPost('kategori'),
            'status' => $this->request->getPost('status'),
            'harga' => $this->request->getPost('harga'),
            'updated_by' => session()->get('id_user'),
            'updated_at' => $now
        ];

        // Handle file upload
        $file = $this->request->getFile('foto');

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $validExtensions = ['jpg', 'jpeg', 'png'];
            $extension = $file->getClientExtension();

            if (in_array(strtolower($extension), $validExtensions)) {
                $newFileName = time() . '_' . $file->getRandomName();
                $uploadPath = 'images/';

                if ($file->move($uploadPath, $newFileName)) {
                    // Delete old file if exists
                    $currentData = $this->model->getWhere('produk', ['id_produk' => $idProduk]);
                    if ($currentData && isset($currentData->foto)) {
                        $oldFilePath = $uploadPath . $currentData->foto;
                        if (file_exists($oldFilePath)) {
                            unlink($oldFilePath);
                        }
                    }

                    $data['foto'] = $newFileName;
                } else {
                    return redirect()->back()->with('error', 'Gagal memindahkan file.');
                }
            } else {
                return redirect()->back()->with('error', 'Format gambar tidak valid. Gunakan jpg, jpeg, atau png.');
            }
        }

        // Update database
        $this->model->edit('produk', $data, ['id_produk' => $idProduk]);
        return redirect()->to('home/tampildata')->with('success', 'Berhasil edit data.');
    } else {
        return redirect()->to('/home/login');
    }
}
public function edit_kategori($id)
    {
        if (session()->get('level') == 1 || session()->get('level') == 2 || session()->get('level') == 3 || session()->get('level') == 4){
        $where= array('id_kategori' =>$id);
        $parent['child']=$this->model->getWhere('kategori',$where);
        echo view('header',['webDetail' => $this->webDetail]);
        echo view ('menu');
        echo view('ekategori', $parent);
        echo view('footer');      
        }else{
            return redirect()->to('/home/login');
        }    
    } 

public function simpan_kategori()
{
    if (session()->get('level') == 1 || session()->get('level') == 2 || session()->get('level') == 3 || session()->get('level') == 4) {
        $idKategori = $this->request->getPost('id');
        if (!$idKategori) {
            return redirect()->back()->with('error', 'ID Kategori tidak valid.');
        }
        date_default_timezone_set('Asia/Jakarta');
        $now = date('Y-m-d H:i:s');

        $data = [
            'nama_kategori' => $this->request->getPost('nama_kategori'),
            'updated_by' => session()->get('id_user'),
            'updated_at' => $now
        ];

        // Handle file upload
        $file = $this->request->getFile('foto');

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $validExtensions = ['jpg', 'jpeg', 'png'];
            $extension = $file->getClientExtension();

            if (in_array(strtolower($extension), $validExtensions)) {
                $newFileName = time() . '_' . $file->getRandomName();
                $uploadPath = 'images/';

                if ($file->move($uploadPath, $newFileName)) {
                    // Delete old file if exists
                    $currentData = $this->model->getWhere('kategori', ['id_kategori' => $idKategori]);
                    if ($currentData && isset($currentData->foto)) {
                        $oldFilePath = $uploadPath . $currentData->foto;
                        if (file_exists($oldFilePath)) {
                            unlink($oldFilePath);
                        }
                    }

                    $data['icon'] = $newFileName;
                } else {
                    return redirect()->back()->with('error', 'Gagal memindahkan file.');
                }
            } else {
                return redirect()->back()->with('error', 'Format gambar tidak valid. Gunakan jpg, jpeg, atau png.');
            }
        }

        // Update database
        $this->model->edit('kategori', $data, ['id_kategori' => $idKategori]);
        return redirect()->to('home/tampildata')->with('success', 'Berhasil edit data.');
    } else {
        return redirect()->to('/home/login');
    }
}

public function edit_paket($id_paket)
{
    if (in_array(session()->get('level'), [1, 2, 3, 4])) {
        $where = ['deleted_at' => null];
        
        // Mengambil data paket yang akan diedit
        $paket = $this->model->getPaketById($id_paket); // Pastikan method ini ada di model
        
        // Mengambil data produk dan kategori untuk dropdown
        $parent['produkList'] = $this->model->tampilexist('produk', 'id_produk');
        $parent['kategori'] = $this->model->tampilexist('kategori', 'id_kategori');
        
        // Kirim data paket ke view
        $parent['paket'] = $paket;

        echo view('header', ['webDetail' => $this->webDetail]);
        echo view('menu');
        echo view('epaket', $parent); // View baru untuk edit paket
        echo view('footer');
    } else {
        return redirect()->to('/home/login');
    }
}


public function simpan_paket()
{
    if (in_array(session()->get('level'), [1, 2, 3, 4])) {
        // Ambil data dari form
        date_default_timezone_set('Asia/Jakarta');
        $now = date('Y-m-d H:i:s');
        $id_paket = $this->request->getPost('id_paket');
        $nama_paket = $this->request->getPost('nama_paket');
        $deskripsi = $this->request->getPost('deskripsi');
        $harga_paket = $this->request->getPost('harga_paket');
        $produk_ids = $this->request->getPost('produk_ids');
        $jumlah = $this->request->getPost('jumlah');
        
        // Update paket
        $data = [
            'nama_paket' => $nama_paket,
            'deskripsi' => $deskripsi,
            'harga_paket' => $harga_paket,
            'updated_at' => $now,
            'updated_by' => session()->get('id_user'),
        ];
        $this->model->edit('paket',$data, ['id_paket'=>$id_paket]);
        // print_r($data);

        // Update produk dalam paket
        // Pertama, hapus semua produk yang terhubung dengan paket ini
        $this->model->hapus('paket_detail', ['id_paket' => $id_paket]);

    //     // Kemudian, insert produk baru
        foreach ($produk_ids as $index => $id_produk) {
            $this->model->input('paket_detail', [
                'id_paket' => $id_paket,
                'id_produk' => $id_produk,
                'qty' => $jumlah[$index]
            ]);
        }

    //     // Redirect ke halaman paket setelah update
        return redirect()->to('/home/tampildata');
    } else {
        return redirect()->to(base_url('home/tampildata'))->with('success', 'Paket berhasil diperbarui!');
    }
}

public function edit_metode($id)
{
    if (session()->get('level') == 1 || session()->get('level') == 2 || session()->get('level')  == 6) {
        $where = array('id_metode' =>$id);
        $parent['child'] = $this->model->getWhere('metode_pembayaran',$where);
        echo view ('header',['webDetail' => $this->webDetail]);
        echo view ('menu');
        echo view ('emetode',$parent);
        echo view ('footer');
    } else {
        return redirect()->to('home/login');
    }
}

public function simpan_metode()
{
date_default_timezone_set('Asia/Jakarta');
$now = date('Y-m-d H:i:s');
$id_user = session()->get('id_user');
$id = $this->request->getPost('id');
$nama_metode = $this->request->getPost('nama_metode');
$kode = $this->request->getPost('kode');
$data = array(
    'nama_metode' => $nama_metode,
    'kode' => $kode,
    'updated_at' => $now,
    'updated_by' => $id_user
    );
// print_r($id);
$this->model->edit('metode_pembayaran',$data,['id_metode'=>$id]);
return redirect()->to('home/tampildata');
}


public function formbayar($id)
{
    if (session()->get('level')== 1 || session()->get('level') == 2 || session()->get('level') == 6) {
        $where= array('id_nota'=>$id);
        $parent['child'] = $this->model->getWhere('nota',$where);
        echo view ('header',['webDetail' => $this->webDetail]);
        echo view ('menu');
        echo view ('transaksi',$parent);
        echo view ('footer');
    } else {
        return redirect()->to('home/login');
    }
}

public function simpan_bayar()
{
date_default_timezone_set('Asia/Jakarta');
$now = date('Y-m-d H:i:s');
$id_user = session()->get('id_user');
$id = $this->request->getPost('id');
$bayar = $this->request->getPost('bayar');
$kembalian = $this->request->getPost('kembalian');
$data = array(
    'bayar' => $bayar,
    'kembalian' => $kembalian,
    'status' => "selesai",
    'updated_at' => $now,
    'updated_by' => $id_user
    );
$this->model->edit('nota',$data,['id_nota'=>$id]);
return redirect()->to('home/tampiltransaksi');
}

public function simpan_konfirmasi()
{
date_default_timezone_set('Asia/Jakarta');
$now = date('Y-m-d H:i:s');
$id_user = session()->get('id_user');
$id = $this->request->getPost('id');
$total = $this->request->getPost('total');
$data = array(
    'bayar' => $total,
    'kembalian' => 0,
    'status' => "selesai",
    'updated_at' => $now,
    'updated_by' => $id_user
    );
$this->model->edit('nota',$data,['id_nota'=>$id]);
return redirect()->to('home/tampiltransaksi');
}

public function tolak_konfirmasi()
{
date_default_timezone_set('Asia/Jakarta');
$now = date('Y-m-d H:i:s');
$id_user = session()->get('id_user');
$id = $this->request->getPost('id');
$data = array(
    'bayar' => 0,
    'kembalian' => 0,
    'status' => "gagal",
    'updated_at' => $now,
    'updated_by' => $id_user
    );
$this->model->edit('nota',$data,['id_nota'=>$id]);
return redirect()->to('home/tampiltransaksi');
}

public function simpan_bukti()
{
    $id_nota = $this->request->getPost('id_nota');
    $bukti = $this->request->getFile('bukti');

    if ($bukti->isValid() && !$bukti->hasMoved()) {
        $newName = $bukti->getRandomName();
        $bukti->move('images/bukti/', $newName);

        // Simpan ke database (misalnya di kolom 'bukti_pembayaran')
        $this->model->edit('nota', ['bukti_pembayaran' => $newName, 'status' => 'konfirmasi'], ['id_nota' => $id_nota]);

        return redirect()->to('home/pesananSaya')->with('success', 'Bukti berhasil diunggah!');
    }

    return redirect()->to('home/pesananSaya')->with('error', 'Gagal mengunggah bukti!');
}























public function terimakasih($id = null)
{
    $userId = session()->get('id_user');
    $parent['notaGrouped'] = [];

    if ($id) {
        // Ambil 1 nota berdasarkan ID, untuk histori
        $nota = $this->model->getNotaTerbaruJoinMetode([
            'nota.id_nota' => $id,
            'nota.created_by' => $userId
        ]);

        if ($nota) {
            $nota = $nota[0]; // Karena hasilnya array dari query
            $detail = $this->model->getDetailPesananByNota($nota['id_nota']);
            $groupedDetail = [];

            foreach ($detail as $row) {
                if (!empty($row['produk_langsung'])) {
                    $groupedDetail[] = [
                        'type' => 'produk',
                        'nama' => $row['produk_langsung'],
                        'jumlah' => $row['jumlah_paket'],
                        'pesan' => $row['pesan'] ?? ''
                    ];
                } elseif (!empty($row['nama_paket'])) {
                    $key = $row['nama_paket'];
                    if (!isset($groupedDetail[$key])) {
                        $groupedDetail[$key] = [
                            'type' => 'paket',
                            'nama_paket' => $row['nama_paket'],
                            'jumlah_paket' => $row['jumlah'],
                            'pesan' => $row['pesan'] ?? '',
                            'isi' => []
                        ];
                    }
                    $groupedDetail[$key]['isi'][] = [
                        'nama' => $row['produk_dalam_paket'],
                        'jumlah' => $row['total_produk_dalam_paket']
                    ];
                }
            }

            $nota['detail'] = array_values($groupedDetail);
            $parent['notaGrouped'][] = $nota;
        }

    } else {
        // Default: tampilkan semua nota hari ini
        $tanggalHariIni = date('Y-m-d');

        if ($id !== null) {
    $notaTerbaru = $this->model->getNotaTerbaruJoinMetode([
        'nota.created_by' => $userId,
        'nota.id_nota' => $id
    ]);
} else {
    $notaTerbaru = $this->model->getNotaTerbaruJoinMetode([
        'nota.created_by' => $userId,
        'DATE(nota.created_at)' => $tanggalHariIni
    ]);
}


        foreach ($notaTerbaru as $nota) {
            $detail = $this->model->getDetailPesananByNota($nota['id_nota']);
            $groupedDetail = [];

            foreach ($detail as $row) {
                if (!empty($row['produk_langsung'])) {
                    $groupedDetail[] = [
                        'type' => 'produk',
                        'nama' => $row['produk_langsung'],
                        'jumlah' => $row['jumlah_paket'],
                        'pesan' => $row['pesan'] ?? ''
                    ];
                } elseif (!empty($row['nama_paket'])) {
                    $key = $row['nama_paket'];
                    if (!isset($groupedDetail[$key])) {
                        $groupedDetail[$key] = [
                            'type' => 'paket',
                            'nama_paket' => $row['nama_paket'],
                            'jumlah_paket' => $row['jumlah'],
                            'pesan' => $row['pesan'] ?? '',
                            'isi' => []
                        ];
                    }
                    $groupedDetail[$key]['isi'][] = [
                        'nama' => $row['produk_dalam_paket'],
                        'jumlah' => $row['total_produk_dalam_paket']
                    ];
                }
            }

            $nota['detail'] = array_values($groupedDetail);
            $parent['notaGrouped'][] = $nota;
        }
    }

    echo view('header', ['webDetail' => $this->webDetail]);
    echo view('terimakasih', $parent);
}






























public function hapus_produk($id)
{
    if (in_array(session()->get('level'), [1, 2, 3, 4])) {
        date_default_timezone_set('Asia/Jakarta'); // Set zona waktu
        $now = date('Y-m-d H:i:s'); // Ambil waktu sekarang

        // Soft delete user dengan mengupdate kolom deleted_at
        $this->model->edit('produk', ['deleted_at' => $now, 'deleted_by' => session()->get('id_user')], ['id_produk' => $id]);

        return redirect()->to('home/tampildata')->with('success', 'Product has been soft deleted.');
    } else {
        return redirect()->to('/home/login');
    }
}
public function hapus_kategori($id)
{
    if (in_array(session()->get('level'), [1, 2, 3, 4])) {
        date_default_timezone_set('Asia/Jakarta'); // Set zona waktu
        $now = date('Y-m-d H:i:s'); // Ambil waktu sekarang

        // Soft delete user dengan mengupdate kolom deleted_at
        $this->model->edit('kategori', ['deleted_at' => $now, 'deleted_by' => session()->get('id_user')], ['id_kategori' => $id]);

        return redirect()->to('home/tampildata')->with('success', 'Category has been soft deleted.');
    } else {
        return redirect()->to('/home/login');
    }
}
public function hapus_paket($id_paket)
{
    if (in_array(session()->get('level'), [1, 2, 3, 4])) {
        date_default_timezone_set('Asia/Jakarta');
        $now = date('Y-m-d H:i:s');
                // Soft delete: hanya tandai paket sebagai dihapus
        $this->model->edit('paket', [
            'deleted_at' => $now,
            'deleted_by' => session()->get('id_user'),
        ],
        ['id_paket' => $id_paket], );

        return redirect()->to('/home/tampildata')->with('success', 'Paket berhasil dihapus (soft delete)!');
    } else {
        return redirect()->to('/home/login');
    }
}











public function printnota($id_nota)
    {
        if (in_array(session()->get('level'), [1, 2, 6])) {
            // Fetch nota data using the new model
            $id_nota = array('id_nota' =>$id_nota);
            $notaData = $this->model->getNotaData($id_nota);
            // Prepare the data for the view
            $data = [
                'nota' => $notaData['nota'],
                'payment_method' => $notaData['payment_method']
            ];

            // Render the view
            echo view('printnota', $data);
        } else {
            return redirect()->to('/home/login');
        }
    }


public function exportLaporanKeuangan()
{
    $awal = $this->request->getPost('tanggal_awal');
    $akhir = $this->request->getPost('tanggal_akhir');
    $parent['laporan'] = $this->model->getLaporanKeuangan($awal, $akhir);
    $parent['tanggal_awal'] = $awal;
    $parent['tanggal_akhir'] = $akhir;
    
    // Add total row to the data
    $laporan = $parent['laporan'];
    $total_jumlah_terjual = 0;
    $total_total_pendapatan = 0;
    $total_modal = 0;
    $total_laba = 0;

    foreach ($laporan as $row) {
        $total_jumlah_terjual += $row['jumlah_terjual'];
        $total_total_pendapatan += $row['total_pendapatan'];
        $total_modal += $row['modal'];
        $total_laba += $row['laba'];
    }

    $parent['totals'] = [
        'jumlah_terjual' => $total_jumlah_terjual,
        'total_pendapatan' => $total_total_pendapatan,
        'modal' => $total_modal,
        'laba' => $total_laba
    ];

    echo view('excellaporkeuangan', $parent);
}


















    
    public function about()
    {
        if (session()->get('level')>0){
        $this->model->log_activity($id_user, "User opened about page");
        echo view ('header',['webDetail' => $this->webDetail]);
        echo view ('menu');
        echo view('about');
        echo view ('footer');
        }else{
            return redirect()->to('/home/login');
        }
    }

public function profile()
    {
        if (session()->get('level')>0){
        $this->model->log_activity($id_user, "User accessed profile");
        echo view ('header',['webDetail' => $this->webDetail]);
        echo view('profile');
        echo view ('footer');
        }else{
            return redirect()->to('/home/login');
        }
    }


// fitur profile


public function update_profile()
{
    $userId = session()->get('id_user');

    if ($userId !== null) { 
        $where = ['id_user' => $userId];
        $nameColumn = 'username';
        $table = 'user';
    } else {
        return redirect()->to('/error')->with('error', 'Invalid user level.');
    }

    $newName = $this->request->getPost('fullName');
    if (!$newName) {
        return redirect()->back()->with('error', 'Full Name is required.');
    }
    $data = [$nameColumn => $newName];
    $this->model->edit($table, $data, $where);
    session()->set('username', $newName);

    $file = $this->request->getFile('profile_image');
    if ($file && $file->isValid() && !$file->hasMoved()) {
        $uploadPath = 'images/';
        $newFileName = $userId . '_' . $file->getRandomName();
        if ($file->move($uploadPath, $newFileName)) {
            $currentData = $this->model->getWhere('user', ['id_user' => $userId]);
             $oldFileName = $currentData->foto ?? null;
            $this->model->edit('user', ['foto' => $newFileName], ['id_user' => $userId]);
            session()->set('foto', $newFileName);
            if ($oldFileName && file_exists($uploadPath . $oldFileName)) {
                unlink($uploadPath . $oldFileName);
            }
        } else {
            return redirect()->back()->with('error', 'Failed to upload the profile image.');
        }
    }

     $this->model->log_activity($userId, "User updated profile");
    return redirect()->to('/home/profile')->with('successprofil', 'Profile updated successfully.');
}
public function delete_profile_picture()
{
    $userId = session()->get('id_user');

    $currentData = $this->model->getWhere('user', ['id_user' => $userId]);
    $oldFileName = $currentData->foto ?? null;

    if ($oldFileName) {
        $filePath = 'images/' . $oldFileName;

        if (file_exists($filePath)) {
            unlink($filePath);
        }
        $this->model->edit('user', ['foto' => null], ['id_user' => $userId]);
        session()->set('foto', null);
    }
     $this->model->log_activity($userId, "User deleted profile picture");
    return redirect()->to('/home/profile')->with('successprofil', 'Profile picture removed successfully.');
}

public function reset_pass ($id)
    {
        $where= array('id_user' => session()->get('id_user'));
        $data = array(
            
            "password"=> '$2y$10$06lHaz6.m7r5x3drFKem8e3EbEOUlDX2CqW7TjrRY8.w0.s0EVq4K',   
        );
        $this->model->edit('user',$data,$where);
         $id_user = session()->get('id_user');
         $this->model->log_activity($id_user, "User resetted password");
        return redirect()->to('home/profile');
    }
    public function change_pass()
    {
            $where= array('id_user' => session()->get('id_user'));
        $data = array(
            'password'=> MD5($this->request->getPost('newpassword')),
        );
        $this->model->edit('user',$data,$where);

       
        return redirect()->to('/home/profile')->with('success','Password berhasil diganti');
    }






    // end fitur profile



















public function user_log_activity()
{
    // Check if the user is logged in
    if (session()->has('id_user')) {
        $id_user = session()->get('id_user');

        // Get log activity for the logged-in user
        $where = ['log_activity.id_user' => $id_user];
        $data['child'] = $this->model->joinwall('log_activity', 'user', 'log_activity.id_user = user.id_user', ['log_activity.id_user' => $id_user], 'id_log');


        // Load views
         $this->model->log_activity($id_user, "User accessed log activity");
        echo view('header',['webDetail' => $this->webDetail]);
        echo view('menu');
        echo view('user_log_activity', $data); // Updated to a 'user' folder
    } else {
        return redirect()->to('/home/login');
    }
}





}








