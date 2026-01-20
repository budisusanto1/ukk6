<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabel Penilaian</title>
    
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
        
        /* Export Button */
        .btn-success.export-btn {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%) !important;
            border: none !important;
            color: white !important;
            font-weight: 600;
            padding: 12px 25px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(40, 167, 69, 0.3);
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 25px;
        }
        
        .btn-success.export-btn:hover {
            background: linear-gradient(135deg, #20c997 0%, #1ea885 100%) !important;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(40, 167, 69, 0.4);
        }
        
        .btn-success.export-btn i {
            font-size: 1.1rem;
        }

        /* Print Button */
        .btn-info.print-btn {
            background: linear-gradient(135deg, #17a2b8 0%, #138496 100%) !important;
            border: none !important;
            color: white !important;
            font-weight: 600;
            padding: 12px 25px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(23, 162, 184, 0.3);
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 25px;
            margin-left: 10px;
        }

        .btn-info.print-btn:hover {
            background: linear-gradient(135deg, #138496 0%, #117a8b 100%) !important;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(23, 162, 184, 0.4);
        }

        .btn-info.print-btn i {
            font-size: 1.1rem;
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
        
        table.datatable tbody td:first-child {
            font-weight: 600;
            color: #555;
        }
        
        /* Form Controls in Table */
        .nilai-input {
            width: 100px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            padding: 8px 12px;
            font-weight: 500;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }
        
        .nilai-input:focus {
            border-color: #A41F13;
            box-shadow: 0 0 0 3px rgba(164, 31, 19, 0.1);
            outline: none;
        }
        
        .nilai-input[readonly] {
            background-color: #f5f5f5;
            cursor: not-allowed;
        }
        
        .predikat-select {
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            padding: 8px 12px;
            font-weight: 600;
            transition: all 0.3s ease;
            cursor: pointer;
            background: white;
            font-size: 0.95rem;
            min-width: 140px;
        }
        
        .predikat-select:focus {
            border-color: #A41F13;
            box-shadow: 0 0 0 3px rgba(164, 31, 19, 0.1);
            outline: none;
        }
        
        .predikat-select[disabled] {
            background-color: #f5f5f5;
            cursor: not-allowed;
        }
        
        .catatan-input {
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            padding: 8px 12px;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            resize: vertical;
            min-height: 60px;
            width: 100%;
        }
        
        .catatan-input:focus {
            border-color: #A41F13;
            box-shadow: 0 0 0 3px rgba(164, 31, 19, 0.1);
            outline: none;
        }
        
        .catatan-input[readonly] {
            background-color: #f5f5f5;
            cursor: not-allowed;
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
            
            .btn-success.export-btn {
                padding: 10px 20px;
                font-size: 0.95rem;
                width: 100%;
                justify-content: center;
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
            
            .nilai-input {
                width: 80px;
                font-size: 0.85rem;
                padding: 6px 10px;
            }
            
            .predikat-select {
                font-size: 0.85rem;
                padding: 6px 10px;
                min-width: 120px;
            }
            
            .catatan-input {
                font-size: 0.85rem;
                min-height: 50px;
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
    <span>Tersimpan otomatis</span>
</div>

<section class="latest-podcast-section d-flex align-items-center justify-content-center pb-5" id="section_2">
    <div class="container">
        <div class="col-lg-12 col-12 mt-5 mb-4 mb-lg-4">
            <div class="custom-block d-flex flex-column">

                <ul class="nav nav-tabs mb-4" id="penilaianTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="penilaian-tab" data-bs-toggle="tab" data-bs-target="#penilaian-table" type="button" role="tab">
                            Tabel Penilaian - Bulan <?= date('F Y', strtotime($current_month . '-01')) ?>
                        </button>
                    </li>
                </ul>

                <!-- Tab Content -->
                <div class="tab-content" id="penilaianTabsContent">

                    <!-- Filter Buttons (Level 2) -->
                    <?php if (session()->get('level') == 2) { ?>
                        <div class="filter-buttons">
                            <a href="<?= base_url('/penilaian?mode=rombel&bulan=' . $current_month) ?>"
                                class="btn <?= ($mode == 'rombel') ? 'btn-primary' : 'btn-outline-primary' ?>">
                                📘 Rombel Saya
                            </a>

                            <a href="<?= base_url('/penilaian?mode=ekskul&bulan=' . $current_month) ?>"
                                class="btn <?= ($mode == 'ekskul') ? 'btn-success filter-btn' : 'btn-outline-success' ?>">
                                🏅 Ekskul Saya
                            </a>
                        </div>
                    <?php } ?>

                    <!-- Export Button -->
                    <a href="<?= base_url('/penilaian/export?bulan=' . $current_month) ?>"
                        class="btn btn-success export-btn">
                        <i class="fas fa-file-excel"></i>
                        <span>Export Excel</span>
                    </a>

                    <!-- Print Button -->
                    <button class="btn btn-info print-btn" onclick="printTable()">
                        <i class="fas fa-print"></i>
                        <span>Print</span>
                    </button>

                    <!-- Penilaian Table -->
                    <div class="tab-pane fade show active" id="penilaian-table" role="tabpanel">
                        <div class="table-container">
                            <table id="penilaianTable" class="table table-hover datatable">
                                <thead>
                                    <tr>
                                        <th style="width: 70px;">No<br><input type="text" class="form-control form-control-sm column-search" placeholder="Search No"></th>
                                        <?php if (session()->get('level') == 1 || session()->get('level') == 2) { ?>
                                            <th>Siswa<br><input type="text" class="form-control form-control-sm column-search" placeholder="Search Siswa"></th>
                                        <?php } ?>
                                        <th>Ekskul<br><input type="text" class="form-control form-control-sm column-search" placeholder="Search Ekskul"></th>
                                        <th style="width: 130px;">
                                            <i class="fas fa-star me-1"></i>Nilai<br>
                                            <small style="font-size: 0.75rem; opacity: 0.8;">(1-100)</small>
                                        </th>
                                        <th style="width: 170px;">
                                            <i class="fas fa-award me-1"></i>Predikat<br>
                                            <small style="font-size: 0.75rem; opacity: 0.8;">(A-D)</small>
                                        </th>
                                        <th style="width: 220px;">
                                            <i class="fas fa-comment-dots me-1"></i>Catatan<br>
                                            <small style="font-size: 0.75rem; opacity: 0.8;">(Opsional)</small>
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
                                                <?php if (session()->get('level') == 1 || session()->get('level') == 2) { ?>
                                                    <div style="position: relative;">
                                                        <small style="display: block; color: #666; margin-bottom: 5px; font-weight: 600;">
                                                            <i class="fas fa-star" style="color: #ffc107; font-size: 0.8rem;"></i> Nilai (1-100)
                                                        </small>
                                                        <input type="number" 
                                                            class="form-control nilai-input" 
                                                            data-id="<?= $value->id_daftar ?>" 
                                                            min="1" 
                                                            max="100" 
                                                            value="<?= $value->nilai ?: '' ?>" 
                                                            <?= $is_locked ? 'readonly' : '' ?> 
                                                            placeholder="Contoh: 85">
                                                    </div>
                                                <?php } else { ?>
                                                    <span class="badge" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 8px 15px; font-size: 1rem;">
                                                        <?= $value->nilai ?: 'Belum diisi' ?>
                                                    </span>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <?php if (session()->get('level') == 1 || session()->get('level') == 2) { ?>
                                                    <div style="position: relative;">
                                                        <small style="display: block; color: #666; margin-bottom: 5px; font-weight: 600;">
                                                            <i class="fas fa-award" style="color: #28a745; font-size: 0.8rem;"></i> Predikat (A-D)
                                                        </small>
                                                        <select class="form-select predikat-select" 
                                                            data-id="<?= $value->id_daftar ?>" 
                                                            <?= $is_locked ? 'disabled' : '' ?>>
                                                            <option value="">Pilih Predikat</option>
                                                            <option value="A" <?= $value->predikat == 'A' ? 'selected' : '' ?>>A (91-100)</option>
                                                            <option value="B" <?= $value->predikat == 'B' ? 'selected' : '' ?>>B (81-90)</option>
                                                            <option value="C" <?= $value->predikat == 'C' ? 'selected' : '' ?>>C (70-80)</option>
                                                            <option value="D" <?= $value->predikat == 'D' ? 'selected' : '' ?>>D (&lt;70)</option>
                                                        </select>
                                                    </div>
                                                <?php } else { ?>
                                                    <span class="badge" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); color: white; padding: 8px 15px; font-size: 1rem;">
                                                        <?= $value->predikat ?: 'Belum diisi' ?>
                                                    </span>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <?php if (session()->get('level') == 1 || session()->get('level') == 2) { ?>
                                                    <div style="position: relative;">
                                                        <small style="display: block; color: #666; margin-bottom: 5px; font-weight: 600;">
                                                            <i class="fas fa-comment-dots" style="color: #17a2b8; font-size: 0.8rem;"></i> Catatan (Opsional)
                                                        </small>
                                                        <textarea class="form-control catatan-input" 
                                                            data-id="<?= $value->id_daftar ?>" 
                                                            rows="2" 
                                                            placeholder="Contoh: Siswa aktif dan antusias" 
                                                            <?= $is_locked ? 'readonly' : '' ?>><?= $value->catatan ?: '' ?></textarea>
                                                    </div>
                                                <?php } else { ?>
                                                    <div style="color: #666; font-style: italic;">
                                                        <?= $value->catatan ?: 'Belum diisi' ?>
                                                    </div>
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
        
        // Initialize DataTable (PENTING: inisialisasi setelah DOM ready)
        var table = $('#penilaianTable').DataTable({
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
        $('#penilaianTable thead th input').on('click', function(e) {
            e.stopPropagation();
        });
        
        // Auto-save functionality
        function showSaveIndicator() {
            $('#saveIndicator').addClass('show');
            setTimeout(function() {
                $('#saveIndicator').removeClass('show');
            }, 2000);
        }

        $('.nilai-input, .predikat-select, .catatan-input').on('change', function() {
            let id_daftar = $(this).data('id');
            let $row = $(this).closest('tr');

            $.ajax({
                url: '<?= base_url('/penilaian/update') ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    id_daftar: id_daftar,
                    nilai: $('.nilai-input[data-id="' + id_daftar + '"]').val(),
                    predikat: $('.predikat-select[data-id="' + id_daftar + '"]').val(),
                    catatan: $('.catatan-input[data-id="' + id_daftar + '"]').val(),
                    bulan: '<?= $current_month ?>'
                },
                success: function(res) {
                    if (res.success) {
                        showSaveIndicator();
                        console.log('Nilai tersimpan');

                        // Visual feedback
                        $row.css('background-color', '#d4edda');
                        setTimeout(function() {
                            $row.css('background-color', '');
                        }, 500);
                    } else {
                        alert(res.message);
                    }
                },
                error: function() {
                    alert('AJAX error');
                }
            });
        });

        // Print functionality
        window.printTable = function() {
            // Create a new window for printing
            var printWindow = window.open('', '_blank');

            // Get the table content
            var tableContent = $('#penilaianTable').clone();

            // Remove search inputs from headers
            tableContent.find('.column-search').remove();

            // Determine column indices based on user level
            var hasSiswaColumn = <?= session()->get('level') == 1 || session()->get('level') == 2 ? 'true' : 'false' ?>;
            var totalColumns = tableContent.find('tbody tr:first td').length;
            var nilaiIndex = hasSiswaColumn ? 3 : 2;
            var predikatIndex = hasSiswaColumn ? 4 : 3;
            var catatanIndex = totalColumns - 1; // Catatan is always the last column

            console.log('User level:', <?= session()->get('level') ?>);
            console.log('Has Siswa column:', hasSiswaColumn);
            console.log('Total columns:', totalColumns);
            console.log('Catatan index:', catatanIndex);
            console.log('Table rows:', tableContent.find('tbody tr').length);

            // Clean up table cells - remove form controls and show values
            tableContent.find('tbody tr').each(function() {
                var $row = $(this);

                // Handle nilai column
                var nilaiCell = $row.find('td').eq(nilaiIndex);
                if (nilaiCell.find('.nilai-input').length > 0) {
                    var nilaiValue = nilaiCell.find('.nilai-input').val() || 'Belum diisi';
                    nilaiCell.html('<div style="text-align: center; font-weight: 600;">' + nilaiValue + '</div>');
                } else {
                    // For view-only mode, keep the badge text
                    var badgeText = nilaiCell.find('.badge').text();
                    nilaiCell.html('<div style="text-align: center; font-weight: 600;">' + badgeText + '</div>');
                }

                // Handle predikat column
                var predikatCell = $row.find('td').eq(predikatIndex);
                if (predikatCell.find('.predikat-select').length > 0) {
                    var predikatValue = predikatCell.find('.predikat-select option:selected').text() || 'Belum diisi';
                    predikatCell.html('<div style="text-align: center; font-weight: 600;">' + predikatValue + '</div>');
                } else {
                    // For view-only mode, keep the badge text
                    var badgeText = predikatCell.find('.badge').text();
                    predikatCell.html('<div style="text-align: center; font-weight: 600;">' + badgeText + '</div>');
                }

                // Handle catatan column
                var catatanCell = $row.find('td').eq(catatanIndex);
                if (catatanCell.find('.catatan-input').length > 0) {
                    var catatanValue = catatanCell.find('.catatan-input').val() || 'Belum diisi';
                    catatanCell.html('<div style="font-weight: 500;">' + catatanValue + '</div>');
                } else {
                    // For view-only mode, keep the text
                    var text = catatanCell.text().trim() || 'Belum diisi';
                    catatanCell.html('<div style="font-weight: 500;">' + text + '</div>');
                }
            });

            // Create print-friendly HTML
            var printContent = `
                <!DOCTYPE html>
                <html lang="id">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Tabel Penilaian - ${'<?= date('F Y', strtotime($current_month . '-01')) ?>'}</title>
                    <style>
                        body {
                            font-family: Arial, sans-serif;
                            margin: 20px;
                            color: #333;
                        }
                        h2 {
                            text-align: center;
                            color: #A41F13;
                            margin-bottom: 30px;
                            font-size: 24px;
                        }
                        table {
                            width: 100%;
                            border-collapse: collapse;
                            margin: 0 auto;
                            font-size: 12px;
                        }
                        th, td {
                            border: 1px solid #ddd;
                            padding: 8px;
                            text-align: left;
                            vertical-align: top;
                        }
                        th {
                            background-color: #A41F13;
                            color: white;
                            font-weight: bold;
                            text-transform: uppercase;
                            font-size: 11px;
                        }
                        tr:nth-child(even) {
                            background-color: #f9f9f9;
                        }
                        tr:hover {
                            background-color: #f5f5f5;
                        }
                        .no-column {
                            width: 50px;
                            text-align: center;
                        }
                        .nilai-column, .predikat-column {
                            text-align: center;
                            font-weight: bold;
                        }
                        .print-date {
                            text-align: center;
                            margin-bottom: 20px;
                            font-size: 14px;
                            color: #666;
                        }
                        @media print {
                            body { margin: 0; }
                            table { page-break-inside: auto; }
                            tr { page-break-inside: avoid; page-break-after: auto; }
                            th, td { padding: 6px; }
                        }
                    </style>
                </head>
                <body>
                    <div class="print-date">
                        Dicetak pada: ${new Date().toLocaleDateString('id-ID', {
                            year: 'numeric',
                            month: 'long',
                            day: 'numeric',
                            hour: '2-digit',
                            minute: '2-digit'
                        })}
                    </div>
                    <h2>Tabel Penilaian Ekstrakurikuler</h2>
                    <h3 style="text-align: center; margin-bottom: 20px;">Bulan: ${'<?= date('F Y', strtotime($current_month . '-01')) ?>'}</h3>
                    ${tableContent.prop('outerHTML')}
                </body>
                </html>
            `;

            // Write content to print window
            printWindow.document.write(printContent);
            printWindow.document.close();

            // Wait for content to load then print
            printWindow.onload = function() {
                printWindow.print();
                printWindow.close();
            };
        };

    });
</script>

</body>
</html>