<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Login::login');
$routes->get('/signin', 'Login::signin');
$routes->post('/login', 'Login::aksi_login');
$routes->get('/home', 'Home::index');
$routes->get('/tampildata', 'Home::tampildata');
$routes->get('/formdata', 'Home::formdatas');
$routes->post('/inputuser', 'User::input');
$routes->get('/edituser/(:num)', 'User::editview/$1');
$routes->post('/simpanuser', 'User::simpan');
$routes->get('/deleteuser/(:num)', 'User::hapus/$1');

$routes->post('/inputlevel', 'Level::input');
$routes->get('/editlevel/(:num)', 'Level::editview/$1');
$routes->post('/simpanlevel', 'Level::simpan');
$routes->get('/deletelevel/(:num)', 'Level::hapus/$1');

$routes->post('/inputsiswa', 'Siswa::input');
$routes->get('/editsiswa/(:num)', 'Siswa::editview/$1');
$routes->post('/simpansiswa', 'Siswa::simpan');
$routes->get('/deletesiswa/(:num)', 'Siswa::hapus/$1');

$routes->post('/inputkelas', 'Kelas::input');
$routes->get('/editkelas/(:num)', 'Kelas::editview/$1');
$routes->post('/simpankelas', 'Kelas::simpan');
$routes->get('/deletekelas/(:num)', 'Kelas::hapus/$1');

$routes->post('/inputjurusan', 'Jurusan::input');
$routes->get('/editjurusan/(:num)', 'Jurusan::editview/$1');
$routes->post('/simpanjurusan', 'Jurusan::simpan');
$routes->get('/deletejurusan/(:num)', 'Jurusan::hapus/$1');

$routes->post('/inputrombel', 'Rombel::input');
$routes->get('/editrombel/(:num)', 'Rombel::editview/$1');
$routes->post('/simpanrombel', 'Rombel::simpan');
$routes->get('/deleterombel/(:num)', 'Rombel::hapus/$1');

$routes->post('/inputguru', 'Guru::input');
$routes->get('/editguru/(:num)', 'Guru::editview/$1');
$routes->post('/simpanguru', 'Guru::simpan');
$routes->get('/deleteguru/(:num)', 'Guru::hapus/$1');

$routes->post('/inputekskul', 'Ekskul::input');
$routes->get('/editekskul/(:num)', 'Ekskul::editview/$1');
$routes->post('/simpanekskul', 'Ekskul::simpan');
$routes->get('/deleteekskul/(:num)', 'Ekskul::hapus/$1');

$routes->get('/jadwal', 'Jadwal::index');
$routes->get('/inputjadwal', 'Jadwal::formjadwal');
$routes->post('/inputjadwal', 'Jadwal::input');
$routes->get('/editjadwal/(:num)', 'Jadwal::editview/$1');
$routes->post('/simpanjadwal', 'Jadwal::simpan');
$routes->get('/deletejadwal/(:num)', 'Jadwal::hapus/$1');

$routes->get('/daftar', 'Pendaftaran::index');
$routes->get('/inputdaftar', 'Pendaftaran::formdaftar');
$routes->post('/inputdaftar', 'Pendaftaran::input');
$routes->get('/terimadaftar/(:num)', 'Pendaftaran::terima/$1');
$routes->get('/tolakdaftar/(:num)', 'Pendaftaran::tolak/$1');
$routes->get('/deletedaftar/(:num)', 'Pendaftaran::hapus/$1');

$routes->get('/absensi', 'Absensi::index');
$routes->post('/absensi/update', 'Absensi::update');

$routes->get('/penilaian', 'Penilaian::index');
$routes->post('/penilaian/update', 'Penilaian::update');
$routes->get('/penilaian/export', 'Penilaian::export');


$routes->get('logout', 'Login::logout');
