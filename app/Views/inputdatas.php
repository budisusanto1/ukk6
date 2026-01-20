<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Input Data</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body {
            background-color: #E0DBD8;
            padding-top: 100px;
            padding-bottom: 50px;
        }
        
        .form-container {
            background-color: #FAF5F1;
            padding: 2rem;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            color: #292F36;
        }
        
        /* Tabs matching tampildata */
        .nav-tabs {
            border: none;
            margin-bottom: 30px;
            background: #E0DBD8;
            padding: 10px;
            border-radius: 10px;
        }
        
        .nav-tabs .nav-link {
            border: none;
            color: #292F36;
            font-weight: 600;
            padding: 12px 20px;
            border-radius: 8px;
            margin: 0 5px;
            transition: all 0.3s;
        }
        
        .nav-tabs .nav-link:hover {
            background: rgba(164, 31, 19, 0.1);
            color: #A41F13;
        }
        
        .nav-tabs .nav-link.active {
            background: #A41F13;
            color: white;
        }
        
        /* Form styling */
        h3 {
            font-weight: bold;
            margin-bottom: 1.5rem;
            color: #292F36;
        }
        
        h5 {
            color: #A41F13;
            font-weight: 600;
            margin-top: 1.5rem;
            margin-bottom: 1rem;
        }
        
        .form-label {
            font-weight: 600;
            color: #292F36;
            margin-bottom: 0.5rem;
        }
        
        .form-control,
        .form-select {
            border: 2px solid #e9ecef;
            border-radius: 8px;
            padding: 10px 15px;
            transition: all 0.3s;
        }
        
        .form-control:focus,
        .form-select:focus {
            border-color: #A41F13;
            box-shadow: 0 0 0 0.2rem rgba(164, 31, 19, 0.25);
            outline: none;
        }
        
        /* Button styling matching theme */
        .btn-submit {
            background-color: #A41F13;
            border: none;
            color: white;
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s;
            margin-top: 1rem;
        }
        
        .btn-submit:hover {
            background-color: #8a1a0f;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(164, 31, 19, 0.4);
            color: white;
        }
        
        hr {
            border-color: #A41F13;
            opacity: 0.3;
            margin: 1.5rem 0;
        }
        
        /* File input styling */
        .form-control[type="file"] {
            padding: 8px;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .form-container {
                padding: 1.5rem;
            }
            
            .nav-tabs {
                padding: 8px;
            }
            
            .nav-tabs .nav-link {
                padding: 10px 15px;
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>

<section class="d-flex align-items-center justify-content-center pb-5">
    <div class="container">
        <div class="col-lg-12 col-12 mt-5 mb-4">
            <div class="form-container">

                <!-- Nav Tabs -->
                <ul class="nav nav-tabs" id="inputTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="user-tab" data-bs-toggle="tab" data-bs-target="#user-form" type="button" role="tab">Tambah User</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="level-tab" data-bs-toggle="tab" data-bs-target="#level-form" type="button" role="tab">Tambah Level</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="siswa-tab" data-bs-toggle="tab" data-bs-target="#siswa-form" type="button" role="tab">Tambah Siswa</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="kelas-tab" data-bs-toggle="tab" data-bs-target="#kelas-form" type="button" role="tab">Tambah Kelas</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="jurusan-tab" data-bs-toggle="tab" data-bs-target="#jurusan-form" type="button" role="tab">Tambah Jurusan</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="rombel-tab" data-bs-toggle="tab" data-bs-target="#rombel-form" type="button" role="tab">Tambah Rombel</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="guru-tab" data-bs-toggle="tab" data-bs-target="#guru-form" type="button" role="tab">Tambah Guru</button>
                    </li>
                   
                </ul>

                <!-- Tab Content -->
                <div class="tab-content" id="inputTabsContent">

                    <!-- User Form -->
                    <div class="tab-pane fade show active" id="user-form" role="tabpanel">
                        <h3>Tambah User</h3>
                        <form action="<?= base_url('/inputuser') ?>" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="contoh@email.com" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Minimal 6 karakter" required>
                            </div>
                            <div class="mb-3">
                                <label for="level" class="form-label">Level</label>
                                <select class="form-select" name="level" required>
                                    <option value="">--Pilih Level</option>
                                    <?php foreach ($level as $l): ?>
                                        <option value="<?= $l->id_level ?>"><?= $l->nama_level ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="foto" class="form-label">Foto</label>
                                <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
                                <small class="text-muted">Format: JPG, PNG, GIF (Max 2MB)</small>
                            </div>
                            <button type="submit" class="btn btn-submit">Simpan</button>
                        </form>
                    </div>

                    <!-- Level Form -->
                    <div class="tab-pane fade" id="level-form" role="tabpanel">
                        <h3>Tambah Level</h3>
                        <form action="<?= base_url('/inputlevel') ?>" method="POST">
                            <div class="mb-3">
                                <label for="nama_level" class="form-label">Nama Level</label>
                                <input type="text" class="form-control" id="nama_level" name="nama_level" placeholder="Contoh: Admin, Guru, Siswa" required>
                            </div>
                            <button type="submit" class="btn btn-submit">Simpan</button>
                        </form>
                    </div>

                    <!-- Siswa Form -->
              <div class="tab-pane fade" id="siswa-form" role="tabpanel">
             <h3>Tambah Siswa</h3>
                <form action="<?= base_url('/inputsiswa') ?>" method="POST">
                <div class="mb-3">
            <label class="form-label">NIS</label>
            <input type="text" class="form-control" name="nis" placeholder="Nomor Induk Siswa" required>
                 </div>
                <div class="mb-3">
            <label class="form-label">Nama Siswa</label>
            <input type="text" class="form-control" name="nama_siswa" placeholder="Nama lengkap siswa" required>
            </div>

            <!-- Tempat Lahir -->
          <div class="mb-3">
            <label class="form-label">Tempat Lahir</label>
            <input type="text" class="form-control" name="tempat_lahir" placeholder="Tempat lahir siswa" required>
        </div>

        <!-- Tanggal Lahir -->
        <div class="mb-3">
            <label class="form-label">Tanggal Lahir</label>
            <input type="date" class="form-control" name="tanggal_lahir" required>
        </div>

        <!-- Jenis Kelamin -->
        <div class="mb-3">
            <label class="form-label">Jenis Kelamin</label>
            <select class="form-select" name="jenis_kelamin" required>
                <option value="">--Pilih jenis kelamin--</option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
        </div>

        <!-- Alamat -->
        <div class="mb-3">
            <label class="form-label">Alamat</label>
            <textarea class="form-control" name="alamat" placeholder="Alamat lengkap siswa" rows="3" required></textarea>
        </div>

        <!-- No HP -->
        <div class="mb-3">
            <label class="form-label">No. HP</label>
            <input type="text" class="form-control" name="no_hp" placeholder="Nomor HP siswa" required>
        </div>

        <!-- Rombel -->
        <div class="mb-3">
            <label class="form-label">Rombel</label>
            <select class="form-select" name="id_rombel" required>
                <option value="">--Pilih Rombel--</option>
                <?php foreach ($rombel as $r): ?>
                    <option value="<?= $r->id_rombel ?>"><?= $r->nama_rombel ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <hr>

        <h5>Data User</h5>

        <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" class="form-control" name="username" placeholder="Username untuk login" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" name="email" placeholder="Email siswa" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" class="form-control" name="password" placeholder="Password untuk login" required>
        </div>

        <button type="submit" class="btn btn-submit">Simpan</button>
    </form>
</div>


                    <!-- Kelas Form -->
                    <div class="tab-pane fade" id="kelas-form" role="tabpanel">
                        <h3>Tambah Kelas</h3>
                        <form action="<?= base_url('/inputkelas') ?>" method="POST">
                            <div class="mb-3">
                                <label for="nama_kelas" class="form-label">Nama Kelas</label>
                                <input type="text" class="form-control" id="nama_kelas" name="nama_kelas" placeholder="Contoh: X, XI, XII" required>
                            </div>
                            <button type="submit" class="btn btn-submit">Simpan</button>
                        </form>
                    </div>

                    <!-- Jurusan Form -->
                    <div class="tab-pane fade" id="jurusan-form" role="tabpanel">
                        <h3>Tambah Jurusan</h3>
                        <form action="<?= base_url('/inputjurusan') ?>" method="POST">
                            <div class="mb-3">
                                <label for="nama_jurusan" class="form-label">Nama Jurusan</label>
                                <input type="text" class="form-control" id="nama_jurusan" name="nama_jurusan" placeholder="Contoh: IPA, IPS, TKJ" required>
                            </div>
                            <button type="submit" class="btn btn-submit">Simpan</button>
                        </form>
                    </div>

                    <!-- Rombel Form -->
                    <div class="tab-pane fade" id="rombel-form" role="tabpanel">
                        <h3>Tambah Rombel</h3>
                        <form action="<?= base_url('/inputrombel') ?>" method="POST">
                            <div class="mb-3">
                                <label for="nama_rombel" class="form-label">Nama Rombel</label>
                                <input type="text" class="form-control" id="nama_rombel" name="nama_rombel" placeholder="Contoh: X-TKJ-1" required>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="id_kelas" class="form-label">Kelas</label>
                                    <select class="form-select" name="id_kelas" required>
                                        <option value="">--Pilih Kelas</option>
                                        <?php foreach ($kelas as $k): ?>
                                            <option value="<?= $k->id_kelas ?>"><?= $k->nama_kelas ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="id_jurusan" class="form-label">Jurusan</label>
                                    <select class="form-select" name="id_jurusan" required>
                                        <option value="">--Pilih Jurusan</option>
                                        <?php foreach ($jurusan as $j): ?>
                                            <option value="<?= $j->id_jurusan ?>"><?= $j->nama_jurusan ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="id_guru" class="form-label">Wali Kelas</label>
                                <select class="form-select" name="id_guru" required>
                                    <option value="">--Pilih Guru</option>
                                    <?php foreach ($guru as $g): ?>
                                        <option value="<?= $g->id_guru ?>"><?= $g->nama_guru ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-submit">Simpan</button>
                        </form>
                    </div>

                    <!-- Guru Form -->
                  <div class="tab-pane fade" id="guru-form" role="tabpanel">
    <h3>Tambah Guru</h3>
    <form action="<?= base_url('/inputguru') ?>" method="POST">
        <!-- NIP -->
        <div class="mb-3">
            <label class="form-label">NIP</label>
            <input type="text" class="form-control" name="nip" placeholder="Nomor Induk Pegawai" required>
        </div>

        <!-- Nama Guru -->
        <div class="mb-3">
            <label class="form-label">Nama Guru</label>
            <input type="text" class="form-control" name="nama_guru" placeholder="Nama lengkap guru" required>
        </div>

        <!-- Tempat Lahir -->
        <div class="mb-3">
            <label class="form-label">Tempat Lahir</label>
            <input type="text" class="form-control" name="tempat_lahir" placeholder="Tempat lahir guru" required>
        </div>

        <!-- Tanggal Lahir -->
        <div class="mb-3">
            <label class="form-label">Tanggal Lahir</label>
            <input type="date" class="form-control" name="tanggal_lahir" required>
        </div>

        <!-- Jenis Kelamin -->
        <div class="mb-3">
            <label class="form-label">Jenis Kelamin</label>
            <select class="form-select" name="jenis_kelamin" required>
                <option value="">--Pilih jenis kelamin--</option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
        </div>
<!-- Jabatan -->
<div class="mb-3">
    <label class="form-label">Jabatan</label>
    <select class="form-select" name="jabatan" required>
        <option value="">-- Pilih Jabatan --</option>
        <option value="Guru BK">Guru biasa</option>
        <option value="Wali Kelas">Wali Kelas</option>
        <option value="Guru Mata Pelajaran">Guru Bk</option>
     
    </select>
</div>

        <!-- Alamat -->
        <div class="mb-3">
            <label class="form-label">Alamat</label>
            <textarea class="form-control" name="alamat" placeholder="Alamat lengkap guru" rows="3" required></textarea>
        </div>

        <!-- No HP -->
        <div class="mb-3">
            <label class="form-label">No. HP</label>
            <input type="text" class="form-control" name="no_hp" placeholder="Nomor HP guru" required>
        </div>

        <hr>

        <h5>Data User</h5>

        <!-- Username -->
        <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" class="form-control" name="username" placeholder="Username untuk login" required>
        </div>

        <!-- Email -->
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" name="email" placeholder="Email guru" required>
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" class="form-control" name="password" placeholder="Password untuk login" required>
        </div>

        <button type="submit" class="btn btn-submit">Simpan</button>
    </form>
</div>           
         </div>

            </div>
        </div>
    </div>
</section>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>