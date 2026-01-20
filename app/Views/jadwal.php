<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabel Jadwal</title>
    
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
        
        /* Add Button */
        .btn-success {
            background: linear-gradient(135deg, #292F36 0%, #1a1f24 100%) !important;
            border: none !important;
            color: white;
            font-weight: 600;
            padding: 12px 25px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(41, 47, 54, 0.3);
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 25px;
        }
        
        .btn-success:hover {
            background: linear-gradient(135deg, #1a1f24 0%, #0f1216 100%) !important;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(41, 47, 54, 0.4);
        }
        
        .btn-success i {
            font-size: 1.1rem;
        }
        
        /* Table Container */
        .table-container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.06);
            overflow: hidden;
        }
        
        /* DataTables Wrapper */
        .dataTables_wrapper {
            padding: 25px;
        }
        
        .dataTables_wrapper .dataTables_length {
            margin-bottom: 20px;
        }
        
        .dataTables_wrapper .dataTables_length label {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #555;
            font-weight: 500;
        }
        
        .dataTables_wrapper .dataTables_length select {
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            padding: 8px 35px 8px 12px;
            color: #333;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            background: white url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23333' d='M6 9L1 4h10z'/%3E%3C/svg%3E") no-repeat right 10px center;
            appearance: none;
        }
        
        .dataTables_wrapper .dataTables_length select:focus {
            outline: none;
            border-color: #A41F13;
            box-shadow: 0 0 0 3px rgba(164, 31, 19, 0.1);
        }
        
        .dataTables_wrapper .dataTables_filter {
            margin-bottom: 20px;
        }
        
        .dataTables_wrapper .dataTables_filter label {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #555;
            font-weight: 500;
        }
        
        .dataTables_wrapper .dataTables_filter input {
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            padding: 8px 15px;
            color: #333;
            font-weight: 400;
            transition: all 0.3s ease;
            width: 250px;
        }
        
        .dataTables_wrapper .dataTables_filter input:focus {
            outline: none;
            border-color: #A41F13;
            box-shadow: 0 0 0 3px rgba(164, 31, 19, 0.1);
        }
        
        /* Table Styles */
        table.dataTable {
            width: 100% !important;
            border-collapse: separate;
            border-spacing: 0;
        }
        
        table.dataTable thead {
            background: linear-gradient(135deg, #A41F13 0%, #8a1a0f 100%);
        }
        
        table.dataTable thead th {
            color: white !important;
            font-weight: 600;
            font-size: 0.95rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 18px 15px !important;
            border: none !important;
            vertical-align: top;
        }
        
        table.dataTable thead th:first-child {
            border-top-left-radius: 0;
        }
        
        table.dataTable thead th:last-child {
            border-top-right-radius: 0;
        }
        
        /* Column Search Input */
        table.dataTable thead th .column-search {
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
        
        table.dataTable thead th .column-search::placeholder {
            color: #999 !important;
            font-weight: 400;
        }
        
        table.dataTable thead th .column-search:focus {
            background: white !important;
            border-color: white !important;
            box-shadow: 0 2px 8px rgba(255,255,255,0.3) !important;
            outline: none;
        }
        
        /* Table Body */
        table.dataTable tbody tr {
            background-color: white;
            border-bottom: 1px solid #f5f5f5;
            transition: all 0.3s ease;
        }
        
        table.dataTable tbody tr:hover {
            background-color: #fafafa !important;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            transform: translateY(-1px);
        }
        
        table.dataTable tbody tr:last-child {
            border-bottom: none;
        }
        
        table.dataTable tbody td {
            padding: 16px 15px !important;
            color: #333;
            font-size: 0.95rem;
            vertical-align: middle;
            border: none !important;
        }
        
        table.dataTable tbody td:first-child {
            font-weight: 600;
            color: #555;
        }
        
        /* Action Buttons */
        .btn-action-group {
            display: flex;
            gap: 8px;
            justify-content: flex-start;
        }
        
        .btn-warning,
        .btn-danger {
            padding: 8px 14px !important;
            border-radius: 8px !important;
            border: none !important;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        
        .btn-warning {
            background: linear-gradient(135deg, #edb047 0%, #d89a35 100%) !important;
            color: white !important;
        }
        
        .btn-warning:hover {
            background: linear-gradient(135deg, #d89a35 0%, #c58a2f 100%) !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(237, 176, 71, 0.4);
        }
        
        .btn-danger {
            background: linear-gradient(135deg, #8F7A6E 0%, #7a6860 100%) !important;
            color: white !important;
        }
        
        .btn-danger:hover {
            background: linear-gradient(135deg, #7a6860 0%, #665651 100%) !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(143, 122, 110, 0.4);
        }
        
        /* Pagination */
        .dataTables_wrapper .dataTables_paginate {
            margin-top: 25px;
            display: flex;
            justify-content: center;
        }
        
        .dataTables_wrapper .dataTables_paginate .pagination {
            gap: 5px;
        }
        
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            border: 2px solid #e0e0e0 !important;
            border-radius: 8px !important;
            padding: 8px 14px !important;
            margin: 0 !important;
            background: white !important;
            color: #555 !important;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .dataTables_wrapper .dataTables_paginate .paginate_button:hover:not(.disabled) {
            background: #f5f5f5 !important;
            border-color: #A41F13 !important;
            color: #A41F13 !important;
            transform: translateY(-1px);
        }
        
        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: linear-gradient(135deg, #A41F13 0%, #8a1a0f 100%) !important;
            border-color: #A41F13 !important;
            color: white !important;
            box-shadow: 0 4px 12px rgba(164, 31, 19, 0.3);
        }
        
        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled {
            opacity: 0.4;
            cursor: not-allowed;
            pointer-events: none;
        }
        
        /* Info Text */
        .dataTables_wrapper .dataTables_info {
            color: #666;
            font-size: 0.9rem;
            font-weight: 500;
            padding-top: 20px;
        }
        
        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 80px 20px;
            color: #999;
        }
        
        .empty-state i {
            font-size: 4rem;
            color: #ddd;
            margin-bottom: 20px;
            display: block;
        }
        
        .empty-state p {
            font-size: 1.1rem;
            color: #aaa;
        }
        
        /* Responsive Design */
        @media (max-width: 992px) {
            .custom-block {
                padding: 30px 25px;
            }
            
            .dataTables_wrapper {
                padding: 20px;
            }
            
            table.dataTable thead th,
            table.dataTable tbody td {
                padding: 12px 10px !important;
                font-size: 0.9rem;
            }
            
            .dataTables_wrapper .dataTables_filter input {
                width: 200px;
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
            
            .btn-success {
                padding: 10px 20px;
                font-size: 0.95rem;
            }
            
            .dataTables_wrapper {
                padding: 15px;
            }
            
            .dataTables_wrapper .dataTables_length,
            .dataTables_wrapper .dataTables_filter {
                margin-bottom: 15px;
            }
            
            .dataTables_wrapper .dataTables_filter input {
                width: 100%;
            }
            
            table.dataTable thead th,
            table.dataTable tbody td {
                padding: 10px 8px !important;
                font-size: 0.85rem;
            }
            
            .btn-warning,
            .btn-danger {
                padding: 6px 10px !important;
                font-size: 0.85rem;
            }
            
            .btn-action-group {
                gap: 5px;
            }
            
            .dataTables_wrapper .dataTables_paginate .paginate_button {
                padding: 6px 10px !important;
                font-size: 0.85rem;
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
            
            table.dataTable thead th .column-search {
                padding: 6px 8px;
                font-size: 0.8rem;
            }
        }
        
        /* Scrollbar Styling */
        .dataTables_wrapper::-webkit-scrollbar {
            height: 8px;
        }
        
        .dataTables_wrapper::-webkit-scrollbar-track {
            background: #f5f5f5;
            border-radius: 10px;
        }
        
        .dataTables_wrapper::-webkit-scrollbar-thumb {
            background: #A41F13;
            border-radius: 10px;
        }
        
        .dataTables_wrapper::-webkit-scrollbar-thumb:hover {
            background: #8a1a0f;
        }
    </style>
</head>
<body>

<section class="latest-podcast-section d-flex align-items-center justify-content-center pb-5" id="section_2">
    <div class="container">
        <div class="col-lg-12 col-12 mt-5 mb-4 mb-lg-4">
            <div class="custom-block d-flex flex-column">

                <ul class="nav nav-tabs mb-4" id="inputTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="jadwal-tab" data-bs-toggle="tab" data-bs-target="#jadwal-table" type="button" role="tab">Tabel Jadwal</button>
                    </li>
                </ul>

                <!-- Tab Content -->
                <div class="tab-content" id="inputTabsContent">

                    <!-- jadwal Table -->
                    <div class="tab-pane fade show active" id="jadwal-table" role="tabpanel">
                        <?php if (session()->get('level') == 1) { ?>
                            <a href="<?= base_url('/inputjadwal') ?>" class="btn btn-success">
                                <i class="fa fa-plus-circle"></i>
                                <span>Tambah Jadwal</span>
                            </a>
                        <?php } ?>

                        <div class="table-container">
                            <table id="jadwalTable" class="table table-hover datatable">
                                <thead>
                                    <tr>
                                        <th style="width: 70px;">No<br><input type="text" class="form-control form-control-sm column-search" placeholder="Cari No"></th>
                                        <th>Hari<br><input type="text" class="form-control form-control-sm column-search" placeholder="Cari Hari"></th>
                                        <th>Ekskul<br><input type="text" class="form-control form-control-sm column-search" placeholder="Cari Ekskul"></th>
                                        <th>Jam Mulai<br><input type="text" class="form-control form-control-sm column-search" placeholder="Cari Jam"></th>
                                        <th>Jam Selesai<br><input type="text" class="form-control form-control-sm column-search" placeholder="Cari Jam"></th>
                                        <?php if (session()->get('level') == 1) { ?>
                                            <th style="width: 130px;">Aksi</th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $ms = 1;
                                    foreach ($jadwal as $key => $value) {
                                    ?>
                                        <tr>
                                            <td><?= $ms++ ?></td>
                                            <td><strong><?= $value->hari ?></strong></td>
                                            <td><?= $value->nama_ekskul ?></td>
                                            <td><?= $value->jam_mulai ?></td>
                                            <td><?= $value->jam_selesai ?></td>
                                            <?php if (session()->get('level') == 1) { ?>
                                                <td>
                                                    <div class="btn-action-group">
                                                        <a href="<?= base_url('/editjadwal/' . $value->id_jadwal) ?>"
                                                            class="btn btn-warning btn-sm" title="Edit">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <a href="<?= base_url('/deletejadwal/' . $value->id_jadwal) ?>"
                                                            class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Yakin hapus data ini?');" title="Hapus">
                                                            <i class="fa fa-trash"></i>
                                                        </a>
                                                    </div>
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

        function initDataTable(tableId) {
            var table = $(tableId).DataTable({
                pageLength: 5,
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
                },
                columnDefs: [
                    { orderable: false, targets: -1 }
                ],
                drawCallback: function() {
                    // Add animation to rows
                    $(tableId + ' tbody tr').each(function(index) {
                        $(this).css('animation', 'fadeIn 0.5s ease ' + (index * 0.05) + 's forwards');
                    });
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
            $(tableId + ' thead th input').on('click', function(e) {
                e.stopPropagation();
            });
        }

        // Initialize table
        initDataTable('#jadwalTable');
    });
</script>

</body>
</html>