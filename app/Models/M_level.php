<?php

namespace App\Models;

use CodeIgniter\Model;

	class M_level extends Model
	{

		protected $table = 'level';
		protected $primaryKey = 'id_level';

		// ✅ MUST EXIST
		protected $allowedFields = [
			'nama_level',
		];

		protected $returnType = 'object';

	}
