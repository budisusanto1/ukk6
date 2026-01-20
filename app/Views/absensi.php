<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabel Absensi</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #E0DBD8;
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding-top: 100px;
            padding-bottom: 50px;
        }
        
        /* Container & Block */
        .latest-podcast-section {
            padding-top: 100px;
        }
        
        .custom-block {
            background-color: #FAF5F1;
            border-radius: 20px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.08);
            padding: 40px;
            margin-bottom: 30px;
        }
        
        /* Tabs Navigation */
        .nav-tabs {
            border: none;
            border-bottom: 2px solid #e0e0e0;
            margin-bottom: 30px;
            padding-bottom: 0;
        }
        
        .nav-tabs .nav-item {
            margin-bottom: 0;
        }
        
        .nav-tabs .nav-link {
            border: none;
            background: transparent;
            color: #666;
            font-weight: 600;
            font-size: 1rem;
            padding: 14px 30px;
            border-radius: 0;
            transition: all 0.3s ease;
            position: relative;
        }
        
        .nav-tabs .nav-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 3px;
            background: #A41F13;
            transition: width 0.3s ease;
        }
        
        .nav-tabs .nav-link:hover {
            color: #A41F13;
            background: transparent;
        }
        
        .nav-tabs .nav-link:hover::after {
            width: 100%;
        }
        
        .nav-tabs .nav-link.active {
            color: #A41F13;
            background: transparent;
            border: none;
        }
        
        .nav-tabs .nav-link.active::after {
            width: 100%;
        }
        
        /* Filter Buttons */
        .filter-buttons {
            margin-bottom: 20px;
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }
        
        .btn-primary,
        .btn-outline-primary {
            border-radius: 10px !important;
            padding: 10px 20px !important;
            font-weight: 600 !important;
            transition: all 0.3s ease !important;
            border: 2px solid #0d6efd !important;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%) !important;
            box-shadow: 0 4px 12px rgba(13, 110, 253, 0.3) !important;
            color: white !important;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px) !important;
            box-shadow: 0 6px 16px rgba(13, 110, 253, 0.4) !important;
        }
        
        .btn-outline-primary {
            background: white !important;
            color: #0d6efd !important;
        }
        
        .btn-outline-primary:hover {
            background: #0d6efd !important;
            color: white !important;
            transform: translateY(-2px) !important;
            box-shadow: 0 4px 12px rgba(13, 110, 253, 0.3) !important;
        }
        
        .btn-success.filter-btn,
        .btn-outline-success {
            border-radius: 10px !important;
            padding: 10px 20px !important;
            font-weight: 600 !important;
            transition: all 0.3s ease !important;
            border: 2px solid #198754 !important;
        }
        
        .btn-success.filter-btn {
            background: linear-gradient(135deg, #198754 0%, #157347 100%) !important;
            box-shadow: 0 4px 12px rgba(25, 135, 84, 0.3) !important;
            color: white !important;
        }
        
        .btn-success.filter-btn:hover {
            transform: translateY(-2px) !important;
            box-shadow: 0 6px 16px rgba(25, 135, 84, 0.4) !important;
        }
        
        .btn-outline-success {
            background: white !important;
            color: #198754 !important;
        }
        
        .btn-outline-success:hover {
            background: #198754 !important;
            color: white !important;
            transform: translateY(-2px) !important;
            box-shadow: 0 4px 12px rgba(25, 135, 84, 0.3) !important;
        }
        
        /* Table Container */
        .table-container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.06);
            overflow: hidden;
            padding: 25px;
        }
        
        /* Table Styles */
        table.datatable {
            width: 100% !important;
            border-collapse: separate;
            border-spacing: 0;
            background-color: #ffffff;
        }
        
        table.datatable thead {
            background: linear-gradient(135deg, #A41F13 0%, #8a1a0f 100%);
        }
        
        table.datatable thead th {
            color: white !important;
            font-weight: 600;
            font-size: 0.95rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 18px 15px !important;
            border: none !important;
            vertical-align: top;
        }
        
        /* Column Search Input */
        table.datatable thead th .column-search {
            margin-top: 10px;
            background: rgba(255,255,255,0.95) !important;
            border: 1px solid rgba(255,255,255,0.3) !important;
            border-radius: 6px;
            padding: 8px 12px;
            font-size: 0.85rem;
            color: #333 !important;
            width: 100%;
            transition: all 0.3s ease;
            font-weight: 400;
            text-transform: none;
            letter-spacing: normal;
        }
        
        table.datatable thead th .column-search::placeholder {
            color: #999 !important;
            font-weight: 400;
        }
        
        table.datatable thead th .column-search:focus {
            background: white !important;
            border-color: white !important;
            box-shadow: 0 2px 8px rgba(255,255,255,0.3) !important;
            outline: none;
        }
        
        /* Table Body */
        table.datatable tbody tr {
            background-color: white !important;
            border-bottom: 1px solid #f5f5f5;
            transition: all 0.3s ease;
        }
        
        table.datatable tbody tr:hover {
            background-color: #fafafa !important;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            transform: translateY(-1px);
        }
        
        table.datatable tbody tr:last-child {
            border-bottom: none;
        }
        
        table.datatable tbody td {
            padding: 16px 15px !important;
            color: #333;
            font-size: 0.95rem;
            vertical-align: middle;
            border: none !important;
        }
        
        /* Form Controls in Table */
        .keterangan-select {
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            padding: 8px 12px;
            font-weight: 600;
            transition: all 0.3s ease;
            cursor: pointer;
            background: white;
            font-size: 0.95rem;
            min-width: 160px;
        }
        
        .keterangan-select:focus {
            border-color: #A41F13;
            box-shadow: 0 0 0 3px rgba(164, 31, 19, 0.1);
            outline: none;
        }
        
        /* Status Badge */
        .status-badge {
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
            display: inline-block;
        }
        
        .status-hadir {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: white;
        }
        
        .status-izin {
            background: linear-gradient(135deg, #ffc107 0%, #ff9800 100%);
            color: white;
        }
        
        .status-alpha {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            color: white;
        }
        
        /* Auto-save indicator */
        .save-indicator {
            position: fixed;
            top: 120px;
            right: 30px;
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: white;
            padding: 12px 20px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
            display: none;
            z-index: 1000;
            font-weight: 600;
            animation: slideIn 0.3s ease;
        }
        
        .save-indicator.show {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
        
        /* Responsive Design */
        @media (max-width: 992px) {
            .custom-block {
                padding: 30px 25px;
            }
            
            .table-container {
                padding: 20px;
            }
            
            table.datatable thead th,
            table.datatable tbody td {
                padding: 12px 10px !important;
                font-size: 0.9rem;
            }
        }
        
        @media (max-width: 768px) {
            .custom-block {
                padding: 25px 20px;
                border-radius: 15px;
            }
            
            .nav-tabs .nav-link {
                padding: 12px 20px;
                font-size: 0.95rem;
            }
            
            .filter-buttons {
                flex-direction: column;
            }
            
            .filter-buttons .btn {
                width: 100%;
            }
            
            .table-container {
                padding: 15px;
                overflow-x: auto;
            }
            
            table.datatable thead th,
            table.datatable tbody td {
                padding: 10px 8px !important;
                font-size: 0.85rem;
            }
            
            .keterangan-select {
                font-size: 0.85rem;
                padding: 6px 10px;
                min-width: 140px;
            }
            
            .save-indicator {
                top: 100px;
                right: 15px;
                font-size: 0.9rem;
                padding: 10px 15px;
            }
        }
        
        @media (max-width: 576px) {
            .latest-podcast-section {
                padding-top: 80px;
            }
            
            .custom-block {
                padding: 20px 15px;
            }
            
            .nav-tabs .nav-link {
                padding: 10px 15px;
                font-size: 0.9rem;
            }
            
            table.datatable thead th .column-search {
                padding: 6px 8px;
                font-size: 0.8rem;
            }
        }
        
        /* Scrollbar Styling */
        .table-container::-webkit-scrollbar {
            height: 8px;
        }
        
        .table-container::-webkit-scrollbar-track {
            background: #f5f5f5;
            border-radius: 10px;
        }
        
        .table-container::-webkit-scrollbar-thumb {
            background: #A41F13;
            border-radius: 10px;
        }
        
        .table-container::-webkit-scrollbar-thumb:hover {
            background: #8a1a0f;
        }
    </style>
</head>
<body>

<!-- Auto-save Indicator -->
<div class="save-indicator" id="saveIndicator">
    <i class="fas fa-check-circle"></i>
    <span>Absensi tersimpan</span>
</div>

<section class="latest-podcast-section d-flex align-items-center justify-content-center pb-5" id="section_2">
    <div class="container">
        <div class="col-lg-12 col-12 mt-5 mb-4 mb-lg-4">
            <div class="custom-block d-flex flex-column">

                <ul class="nav nav-tabs mb-4" id="absensiTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="absensi-tab" data-bs-toggle="tab" data-bs-target="#absensi-table" type="button" role="tab">
                            <i class="fas fa-clipboard-check me-2"></i>Tabel Absensi
                        </button>
                    </li>
                </ul>

                <!-- Tab Content -->
                <div class="tab-content" id="absensiTabsContent">

                    <!-- Filter Buttons (Level 2) -->
                    <?php if (session()->get('level') == 2) { ?>
                        <div class="filter-buttons">
                            <a href="<?= base_url('/absensi?mode=rombel') ?>"
                                class="btn <?= ($mode == 'rombel') ? 'btn-primary' : 'btn-outline-primary' ?>">
                                📘 Rombel Saya
                            </a>

                            <a href="<?= base_url('/absensi?mode=ekskul') ?>"
                                class="btn <?= ($mode == 'ekskul') ? 'btn-success filter-btn' : 'btn-outline-success' ?>">
                                🏅 Ekskul Saya
                            </a>
                        </div>
                    <?php } ?>

                    <!-- Absensi Table -->
                    <div class="tab-pane fade show active" id="absensi-table" role="tabpanel">
                        <div class="table-container">
                            <table id="absensiTable" class="table table-hover datatable">
                                <thead>
                                    <tr>
                                        <th style="width: 70px;">
                                            <i class="fas fa-hashtag me-1"></i>No<br>
                                            <input type="text" class="form-control form-control-sm column-search" placeholder="Cari No">
                                        </th>
                                        <?php if (session()->get('level') == 1 || session()->get('level') == 2) { ?>
                                            <th>
                                                <i class="fas fa-user-graduate me-1"></i>Siswa<br>
                                                <input type="text" class="form-control form-control-sm column-search" placeholder="Cari Siswa">
                                            </th>
                                        <?php } ?>
                                        <th>
                                            <i class="fas fa-running me-1"></i>Ekskul<br>
                                            <input type="text" class="form-control form-control-sm column-search" placeholder="Cari Ekskul">
                                        </th>
                                        <th style="width: 150px;">
                                            <i class="fas fa-calendar-alt me-1"></i>Tanggal<br>
                                            <input type="text" class="form-control form-control-sm column-search" placeholder="Cari Tanggal">
                                        </th>
                                        <th style="width: 200px;">
                                            <i class="fas fa-clipboard-list me-1"></i>Keterangan<br>
                                            <small style="font-size: 0.75rem; opacity: 0.8;">(Status Kehadiran)</small>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $ms = 1;
                                    foreach ($daftar as $key => $value) {
                                    ?>
                                        <tr>
                                            <td>
                                                <div style="text-align: center;">
                                                    <small style="display: block; color: #666; margin-bottom: 5px; font-weight: 600;">
                                                        <i class="fas fa-hashtag" style="color: #6c757d; font-size: 0.8rem;"></i> No
                                                    </small>
                                                    <span style="font-size: 1.1rem; font-weight: 700; color: #A41F13;">
                                                        <?= $ms++ ?>
                                                    </span>
                                                </div>
                                            </td>
                                            <?php if (session()->get('level') == 1 || session()->get('level') == 2) { ?>
                                                <td>
                                                    <div>
                                                        <small style="display: block; color: #666; margin-bottom: 5px; font-weight: 600;">
                                                            <i class="fas fa-user-graduate" style="color: #0d6efd; font-size: 0.8rem;"></i> Nama Siswa
                                                        </small>
                                                        <strong style="font-size: 1rem; color: #333;">
                                                            <?= $value->nama_siswa ?>
                                                        </strong>
                                                    </div>
                                                </td>
                                            <?php } ?>
                                            <td>
                                                <div>
                                                    <small style="display: block; color: #666; margin-bottom: 5px; font-weight: 600;">
                                                        <i class="fas fa-running" style="color: #198754; font-size: 0.8rem;"></i> Ekstrakurikuler
                                                    </small>
                                                    <strong style="font-size: 1rem; color: #333;">
                                                        <?= $value->nama_ekskul ?>
                                                    </strong>
                                                </div>
                                            </td>
                                            <td>
                                                <div>
                                                    <small style="display: block; color: #666; margin-bottom: 5px; font-weight: 600;">
                                                        <i class="fas fa-calendar-alt" style="color: #6f42c1; font-size: 0.8rem;"></i> Tanggal
                                                    </small>
                                                    <strong style="font-size: 0.95rem; color: #333;">
                                                        <?= $value->tanggal_absen ?? '-' ?>
                                                    </strong>
                                                </div>
                                            </td>
                                            <td>
                                                <?php if (session()->get('level') == 1 || session()->get('level') == 2) { ?>
                                                    <div style="position: relative;">
                                                        <small style="display: block; color: #666; margin-bottom: 5px; font-weight: 600;">
                                                            <i class="fas fa-clipboard-list" style="color: #fd7e14; font-size: 0.8rem;"></i> Status Kehadiran
                                                        </small>
                                                        <select class="form-select keterangan-select"
                                                            data-id="<?= $value->id_daftar ?>"
                                                            data-absen="<?= $value->id_absen ?? '' ?>">
                                                            <option value="">Pilih Status</option>
                                                            <option value="hadir" <?= $value->keterangan == 'Hadir' ? 'selected' : '' ?>>✅ Hadir</option>
                                                            <option value="izin" <?= $value->keterangan == 'Izin' ? 'selected' : '' ?>>📝 Izin</option>
                                                            <option value="alpha" <?= $value->keterangan == 'Alpha' ? 'selected' : '' ?>>❌ Alpha</option>
                                                        </select>
                                                    </div>
                                                <?php } else { ?>
                                                    <?php 
                                                    $statusClass = '';
                                                    if ($value->keterangan == 'Hadir') {
                                                        $statusClass = 'status-hadir';
                                                    } elseif ($value->keterangan == 'Izin') {
                                                        $statusClass = 'status-izin';
                                                    } elseif ($value->keterangan == 'Alpha') {
                                                        $statusClass = 'status-alpha';
                                                    }
                                                    ?>
                                                    <span class="status-badge <?= $statusClass ?>">
                                                        <?= $value->keterangan ?: 'Belum diisi' ?>
                                                    </span>
                                                <?php } ?>
                                            </td>
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

</main>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<!-- Bootstrap JS -->
<script src="<?= base_url('js/bootstrap.bundle.min.js'); ?>"></script>

<script>
    $(document).ready(function() {
        
        // Initialize DataTable
        var table = $('#absensiTable').DataTable({
            pageLength: 10,
            lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "Semua"]],
            ordering: true,
            searching: true,
            language: {
                "lengthMenu": "Tampilkan _MENU_ data per halaman",
                "zeroRecords": "Data tidak ditemukan",
                "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                "infoEmpty": "Tidak ada data tersedia",
                "infoFiltered": "(difilter dari _MAX_ total data)",
                "search": "Cari:",
                "paginate": {
                    "first": "Pertama",
                    "last": "Terakhir",
                    "next": "Selanjutnya",
                    "previous": "Sebelumnya"
                }
            }
        });

        // Column search functionality
        table.columns().every(function() {
            var that = this;
            $('input', this.header()).on('keyup change clear', function() {
                if (that.search() !== this.value) {
                    that.search(this.value).draw();
                }
            });
        });
        
        // Prevent sorting when clicking on search input
        $('#absensiTable thead th input').on('click', function(e) {
            e.stopPropagation();
        });
        
        // Auto-save functionality
        function showSaveIndicator() {
            $('#saveIndicator').addClass('show');
            setTimeout(function() {
                $('#saveIndicator').removeClass('show');
            }, 2000);
        }

        // Handle keterangan change
        $('.keterangan-select').on('change', function() {
            var id_daftar = $(this).data('id');
            var keterangan = $(this).val();
            var $row = $(this).closest('tr');

            $.ajax({
                url: '<?= base_url('/absensi/update') ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    id_daftar: id_daftar,
                    keterangan: keterangan
                },
                success: function(response) {
                    if (response.success) {
                        showSaveIndicator();
                        
                        // Visual feedback
                        $row.css('background-color', '#d4edda');
                        setTimeout(function() {
                            $row.css('background-color', '');
                        }, 500);
                    } else {
                        alert('Gagal memperbarui absensi');
                    }
                },
                error: function() {
                    alert('Terjadi kesalahan');
                }
            });
        });

    });
</script>

</body>
</html>