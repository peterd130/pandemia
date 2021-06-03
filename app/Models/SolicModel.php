<?php

namespace App\Models;

use CodeIgniter\Model;

class SolicModel extends Model
{
	protected $table = 'SOLIC';

	protected $primaryKey = 'ID';

	protected $allowedFields = ['NOME', 'CPF', 'DATASOLIC','DATAENTREG', 'DATACONTAM', 'DATAMELHORA', 'STATUS', 'TIPO'];

}

?>