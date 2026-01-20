<?php

namespace App\Models;

use CodeIgniter\Model;

	class M_login extends Model
	{

		protected $table = 'user';
		protected $primaryKey = 'id_user';
		protected $allowedFields = [
			'username',
			'email',
			'password',
			'level',
			'foto',
			'created_at',
			'updated_at',
			'deleted_at',
			'created_by',
			'updated_by',
			'deleted_by',
			'token',
			'expiry',
		];

		protected $returnType = 'object';

	}
