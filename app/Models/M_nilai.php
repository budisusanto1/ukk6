<?php

namespace App\Models;

use CodeIgniter\Model;

	class M_nilai extends Model
	{

		protected $table = 'nilai_ekskul';
		protected $primaryKey = 'id_nilai';

		protected $allowedFields = [
			'id_daftar',
			'nilai',
			'predikat',
			'catatan',
			'bulan'
		];

		protected $returnType = 'object';

	}
