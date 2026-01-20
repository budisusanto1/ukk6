<?php

namespace App\Models;

use CodeIgniter\Model;

	class M_jurusan extends Model
	{

		protected $table = 'jurusan';
		protected $primaryKey = 'id_jurusan';

		// ✅ MUST EXIST
		protected $allowedFields = [
			'nama_jurusan',
		];

		protected $returnType = 'object';

	}
