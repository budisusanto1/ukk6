<?php

namespace App\Models;

use CodeIgniter\Model;

class M_absensi extends Model
{
    protected $table = 'absensi_ekskul';
    protected $primaryKey = 'id_absen';
    protected $allowedFields = [
        'id_daftar',
        'tanggal',
        'keterangan',
    ];

    protected $returnType = 'object';

}
