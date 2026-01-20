<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Tables</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body {
            background: linear-gradient(135deg, #2c3e50 0%, #1a252f 100%);
            min-height: 100vh;
            padding-top: 100px;
            padding-bottom: 50px;
        }
        
        .custom-block {
            background-color: #34495e;
            border-radius: 16px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.3);
            padding: 30px;
            margin-bottom: 30px;
        }
        
        .nav-tabs {
            border: none;
            margin-bottom: 30px;
            background: rgba(0,0,0,0.2);
            padding: 10px;
            border-radius: 10px;
            flex-wrap: wrap;
        }
        
        .nav-tabs .nav-link {
            border: none;
            color: rgba(255,255,255,0.7);
            font-weight: 600;
            padding: 12px 20px;
            border-radius: 8px;
            margin: 5px;
            transition: all 0.3s;
        }
        
        .nav-tabs .nav-link:hover {
            background: rgba(164, 31, 19, 0.2);
            color: white;
        }
        
        .nav-tabs .nav-link.active {
            background: #A41F13;
            color: white;
        }
        
        .btn-custom-add {
            background-color: #292F36;
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .btn-custom-add:hover {
            background-color: #1a1f24;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.4);
        }
        
        .table-wrapper {
            background: #2c3e50;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 2px 15px rgba(0,0,0,0.3);
            overflow-x: auto;
        }
        
        table.dataTable {
            color: white;
        }
        
        table.dataTable thead th {
            background-color: #A41F13 !important;
            color: white !important;
            border: none !important;
            padding: 15px !important;
            font-weight: 600;
        }
        
        table.dataTable tbody tr {
            background-color: #34495e;
            transition: all 0.3s;
        }
        
        table.dataTable tbody tr:hover {
            background-color: #3d566e;
        }
        
        table.dataTable tbody td {
            padding: 15px !important;
            vertical-align: middle;
            border-color: #2c3e50 !important;
            color: rgba(255,255,255,0.9);
        }
        
        .btn-warning {
            background-color: #edb047 !important;
            border: none !important;
            color: white !important;
        }
        
        .btn-warning:hover {
            background-color: #d89a35 !important;
            transform: scale(1.1);
        }
        
        .btn-danger {
            background-color: #8F7A6E !important;
            border: none !important;
            color: white !important;
        }
        
        .btn-danger:hover {
            background-color: #7a6860 !important;
            transform: scale(1.1);
        }
        
        .dataTables_wrapper {
            color: white;
        }
        
        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter,
        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_paginate {
            color: white;
        }
        
        .dataTables_wrapper .dataTables_length select,
        .dataTables_wrapper .dataTables_filter input {
            background: #34495e;
            border: 2px solid #2c3e50;
            color: white;
            border-radius: 6px;
            padding: 6px 12px;
        }
        
        .dataTables_wrapper .dataTables_length select:focus,
        .dataTables_wrapper .dataTables_filter input:focus {
            border-color: #A41F13;
            outline: none;
        }
        
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            color: white !important;
        }
        
        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: #A41F13 !important;
            border-color: #A41F13 !important;
            color: white !important;
        }
        
        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: #8a1a0f !important;
            border-color: #8a1a0f !important;
            color: white !important;
        }
        
        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled {
            color: rgba(255,255,255,0.3) !important;
        }
    </style>
</head>
<body>

<section class="pb-5">
    <div class="container">
        <div class="col-lg-12 col-12 mt-5 mb-4">
            <div class="custom-block">
                
                <!-- Nav Tabs -->
                <ul class="nav nav-tabs" id="inputTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="user-tab" data-bs-toggle="tab" data-bs-target="#user-table" type="button" role="tab">Tabel User</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="level-tab" data-bs-toggle="tab" data-bs-target="#level-table" type="button" role="tab">Tabel Level</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="siswa-tab" data-bs-toggle="tab" data-bs-target="#siswa-table" type="button" role="tab">Tabel Siswa</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="kelas-tab" data-bs-toggle="tab" data-bs-target="#kelas-table" type="button" role="tab">Tabel Kelas</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="jurusan-tab" data-bs-toggle="tab" data-bs-target="#jurusan-table" type="button" role="tab">Tabel Jurusan</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="rombel-tab" data-bs-toggle="tab" data-bs-target="#rombel-table" type="button" role="tab">Tabel Rombel</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="guru-tab" data-bs-toggle="tab" data-bs-target="#guru-table" type="button" role="tab">Tabel Guru</button>
                    </li>
                      <li class="nav-item" role="presentation">
                        <button class="nav-link" id="bullyTable-tab" data-bs-toggle="tab" data-bs-target="#bully-table" type="button" role="tab">Tabel jenis bullying</button>
                    </li>
                  
                </ul>

                <!-- Tab Content -->
                <div class="tab-content" id="inputTabsContent">

                    <!-- User Table -->
                    <div class="tab-pane fade show active" id="user-table" role="tabpanel">
                        <a href="<?= base_url('/formdata')?>" class="btn btn-custom-add mb-3">
                            <i class="fa fa-user-plus me-2"></i>Tambah User
                        </a>
                        
                        <div class="table-wrapper">
                            <table id="userTable" class="table table-hover w-100">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Level</th>
                                        <?php if (session()->get('level') == 1 || session()->get('level') == 2 || session()->get('level') == 3 || session()->get('level') == 4) { ?>
                                        <th>Aksi</th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $ms = 1;
                                    foreach ($user as $key => $value) {
                                    ?>
                                    <tr>
                                        <td><?= $ms++ ?></td>
                                        <td><?= $value->username ?></td>
                                        <td><?= $value->email ?></td>
                                        <td>
                                            <?php
                                            if ($value->level == 1) {
                                                echo 'Admin';
                                            } elseif ($value->level == 2) {
                                                echo 'Guru';
                                            } elseif ($value->level == 3) {
                                                echo 'Siswa';
                                            } else {
                                                echo 'Unknown';
                                            }
                                            ?>
                                        </td>
                                        <?php if (session()->get('level') == 1 || session()->get('level') == 2 || session()->get('level') == 3 || session()->get('level') == 4) { ?>
                                        <td>
                                            <a href="<?= base_url('/edituser/' . $value->id_user) ?>" class="btn btn-warning btn-sm">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a class="btn btn-danger btn-sm delete-btn" href="<?= base_url('deleteuser/' . $value->id_user) ?>" onclick="return confirm('Are you sure?');">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                        <?php } ?>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Level Table -->
                    <div class="tab-pane fade" id="level-table" role="tabpanel">
                        <a href="<?= base_url('/formdata') ?>" class="btn btn-custom-add mb-3">
                            <i class="fa fa-plus me-2"></i>Tambah Level
                        </a>
                        
                        <div class="table-wrapper">
                            <table id="levelTable" class="table table-hover w-100">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Level</th>
                                        <?php if (session()->get('level') == 1 || session()->get('level') == 2 || session()->get('level') == 3 || session()->get('level') == 4) { ?>
                                        <th>Aksi</th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $ms = 1;
                                    foreach ($level as $key => $value) {
                                    ?>
                                    <tr>
                                        <td><?= $ms++ ?></td>
                                        <td><?= $value->nama_level ?></td>
                                        <?php if (session()->get('level') == 1 || session()->get('level') == 2 || session()->get('level') == 3 || session()->get('level') == 4) { ?>
                                        <td>
                                            <a href="<?= base_url('/editlevel/' . $value->id_level) ?>" class="btn btn-warning btn-sm">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a class="btn btn-danger btn-sm delete-btn" href="<?= base_url('deletelevel/' . $value->id_level) ?>" onclick="return confirm('Are you sure?');">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                        <?php } ?>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Siswa Table -->
                    <div class="tab-pane fade" id="siswa-table" role="tabpanel">
                        <a href="<?= base_url('/formdata') ?>" class="btn btn-custom-add mb-3">
                            <i class="fa fa-plus me-2"></i>Tambah Siswa
                        </a>
                        
                        <div class="table-wrapper">
                            <table id="siswaTable" class="table table-hover w-100">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nis</th>
                                            <th>Nama Siswa</th>
                                        <th>jenis kelamin</th>
                                        <th>tanggal lahir</th>
                                        <th>Rombel</th>
                                        <?php if (session()->get('level') == 1 || session()->get('level') == 2 || session()->get('level') == 3 || session()->get('level') == 4) { ?>
                                        <th>Aksi</th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $ms = 1;
                                    foreach ($siswa as $key => $value) {
                                    ?>
                                    <tr>
                                        <td><?= $ms++ ?></td>
                                        <td><?= $value->nis ?></td>
                                             <td><?= $value->nama_siswa ?></td>
                                        <td><?= $value->jenis_kelamin ?></td>
                                        <td><?= $value->tanggal_lahir ?></td>
                                        <td><?= $value->nama_rombel ?></td>
                                        <?php if (session()->get('level') == 1 || session()->get('level') == 2 || session()->get('level') == 3 || session()->get('level') == 4) { ?>
                                        <td>
                                            <a href="<?= base_url('/editsiswa/' . $value->id_siswa) ?>" class="btn btn-warning btn-sm">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a class="btn btn-danger btn-sm delete-btn" href="<?= base_url('deletesiswa/' . $value->id_siswa) ?>" onclick="return confirm('Are you sure?');">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                        <?php } ?>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Kelas Table -->
                    <div class="tab-pane fade" id="kelas-table" role="tabpanel">
                        <a href="<?= base_url('/formdata') ?>" class="btn btn-custom-add mb-3">
                            <i class="fa fa-plus me-2"></i>Tambah Kelas
                        </a>
                        
                        <div class="table-wrapper">
                            <table id="kelasTable" class="table table-hover w-100">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Kelas</th>
                                        <?php if (session()->get('level') == 1 || session()->get('level') == 2 || session()->get('level') == 3 || session()->get('level') == 4) { ?>
                                        <th>Aksi</th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $ms = 1;
                                    foreach ($kelas as $key => $value) {
                                    ?>
                                    <tr>
                                        <td><?= $ms++ ?></td>
                                        <td><?= $value->nama_kelas ?></td>
                                        <?php if (session()->get('level') == 1 || session()->get('level') == 2 || session()->get('level') == 3 || session()->get('level') == 4) { ?>
                                        <td>
                                            <a href="<?= base_url('/editkelas/' . $value->id_kelas) ?>" class="btn btn-warning btn-sm">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a class="btn btn-danger btn-sm delete-btn" href="<?= base_url('deletekelas/' . $value->id_kelas) ?>" onclick="return confirm('Are you sure?');">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                        <?php } ?>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Jurusan Table -->
                    <div class="tab-pane fade" id="jurusan-table" role="tabpanel">
                        <a href="<?= base_url('/formdata') ?>" class="btn btn-custom-add mb-3">
                            <i class="fa fa-plus me-2"></i>Tambah Jurusan
                        </a>
                        
                        <div class="table-wrapper">
                            <table id="jurusanTable" class="table table-hover w-100">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Jurusan</th>
                                        <?php if (session()->get('level') == 1 || session()->get('level') == 2 || session()->get('level') == 3 || session()->get('level') == 4) { ?>
                                        <th>Aksi</th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $ms = 1;
                                    foreach ($jurusan as $key => $value) {
                                    ?>
                                    <tr>
                                        <td><?= $ms++ ?></td>
                                        <td><?= $value->nama_jurusan ?></td>
                                        <?php if (session()->get('level') == 1 || session()->get('level') == 2 || session()->get('level') == 3 || session()->get('level') == 4) { ?>
                                        <td>
                                            <a href="<?= base_url('/editjurusan/' . $value->id_jurusan) ?>" class="btn btn-warning btn-sm">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a class="btn btn-danger btn-sm delete-btn" href="<?= base_url('deletejurusan/' . $value->id_jurusan) ?>" onclick="return confirm('Are you sure?');">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                        <?php } ?>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
 <div class="tab-pane fade" id="bully-table" role="tabpanel">
                        <a href="<?= base_url('/formdata') ?>" class="btn btn-custom-add mb-3">
                            <i class="fa fa-plus me-2"></i>Tambah bulyy
                        </a>
                        
                        <div class="table-wrapper">
                            <table id="bullyTable" class="table table-hover w-100">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama jenis pembully</th>
                                        <?php if (session()->get('level') == 1 || session()->get('level') == 2 || session()->get('level') == 3 || session()->get('level') == 4) { ?>
                                        <th>Aksi</th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $ms = 1;
                                    foreach ($jenis_bullying as $key => $value) {
                                    ?>
                                    <tr>
                                        <td><?= $ms++ ?></td>
                                        <td><?= $value->nama_jenis ?></td>
                                        <?php if (session()->get('level') == 1 || session()->get('level') == 2 || session()->get('level') == 3 || session()->get('level') == 4) { ?>
                                        <td>
                                            <a href="<?= base_url('/editbully/' . $value->id_jenis) ?>" class="btn btn-warning btn-sm">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a class="btn btn-danger btn-sm delete-btn" href="<?= base_url('deletebully/' . $value->id_jenis) ?>" onclick="return confirm('Are you sure?');">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                        <?php } ?>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- Rombel Table -->
                    <div class="tab-pane fade" id="rombel-table" role="tabpanel">
                        <a href="<?= base_url('/formdata') ?>" class="btn btn-custom-add mb-3">
                            <i class="fa fa-plus me-2"></i>Tambah Rombel
                        </a>
                        
                        <div class="table-wrapper">
                            <table id="rombelTable" class="table table-hover w-100">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Rombel</th>
                                        <th>Kelas</th>
                                        <th>Jurusan</th>
                                        <th>Guru</th>
                                        <?php if (session()->get('level') == 1 || session()->get('level') == 2 || session()->get('level') == 3 || session()->get('level') == 4) { ?>
                                        <th>Aksi</th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $ms = 1;
                                    foreach ($rombel as $key => $value) {
                                    ?>
                                    <tr>
                                        <td><?= $ms++ ?></td>
                                        <td><?= $value->nama_rombel ?></td>
                                        <td><?= $value->nama_kelas ?></td>
                                        <td><?= $value->nama_jurusan ?></td>
                                        <td><?= $value->nama_guru ?></td>
                                        <?php if (session()->get('level') == 1 || session()->get('level') == 2 || session()->get('level') == 3 || session()->get('level') == 4) { ?>
                                        <td>
                                            <a href="<?= base_url('/editrombel/' . $value->id_rombel) ?>" class="btn btn-warning btn-sm">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a class="btn btn-danger btn-sm delete-btn" href="<?= base_url('deleterombel/' . $value->id_rombel) ?>" onclick="return confirm('Are you sure?');">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                        <?php } ?>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Guru Table -->
                    <div class="tab-pane fade" id="guru-table" role="tabpanel">
                        <a href="<?= base_url('/formdata') ?>" class="btn btn-custom-add mb-3">
                            <i class="fa fa-plus me-2"></i>Tambah Guru
                        </a>
                        
                        <div class="table-wrapper">
                            <table id="guruTable" class="table table-hover w-100">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nip</th>
                                         <th>Nama Guru</th>
                                        <th>jenis kelaimin</th>
                                        <th>tanggal lahir</th>
                                        <th>jabatan </th>
                                        <?php if (session()->get('level') == 1 || session()->get('level') == 2 || session()->get('level') == 3 || session()->get('level') == 4) { ?>
                                        <th>Aksi</th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $ms = 1;
                                    foreach ($guru as $key => $value) {
                                    ?>
                                    <tr>
                                        <td><?= $ms++ ?></td>
                                        <td><?= $value->nip ?></td>
                                        <td><?= $value->nama_guru ?></td>
                                        <td><?= $value->jenis_kelamin ?></td>
                                        <td><?= $value->tanggal_lahir ?></td>
                                             <td><?= $value->jabatan ?></td>
                                        <?php if (session()->get('level') == 1 || session()->get('level') == 2 || session()->get('level') == 3 || session()->get('level') == 4) { ?>
                                        <td>
                                            <a href="<?= base_url('/editguru/' . $value->id_guru) ?>" class="btn btn-warning btn-sm">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a class="btn btn-danger btn-sm delete-btn" href="<?= base_url('deleteguru/' . $value->id_guru) ?>" onclick="return confirm('Are you sure?');">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                        <?php } ?>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
       


                </div>
            </div>
        </div>
    </div>
</section>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function() {
    const tableConfig = {
        pageLength: 10,
        lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "Semua"]],
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json'
        },
        responsive: true,
        order: [[0, 'asc']],
        destroy: true
    };

    // Initialize first table
    $('#userTable').DataTable(tableConfig);

    // Initialize tables when tab is shown
    $('button[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
        const target = $(e.target).data('bs-target');
        const tableId = $(target).find('table').attr('id');
        
        if (tableId && !$.fn.DataTable.isDataTable('#' + tableId)) {
            $('#' + tableId).DataTable(tableConfig);
        }
    });
});
</script>

</body>
</html>