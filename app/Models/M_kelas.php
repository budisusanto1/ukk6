<?php

namespace App\Models;

use CodeIgniter\Model;

	class M_kelas extends Model
	{

		protected $table = 'kelas';
		protected $primaryKey = 'id_kelas';

		protected $allowedFields = [
			'nama_kelas',
		];

		protected $returnType = 'object';

	}
