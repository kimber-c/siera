<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;

class M_confalternativas extends Model
{
    protected $table = 'conf-alternativas';
    protected $primaryKey = 'idealt';
    protected $returnType = 'array';
    protected $allowedFields = [
        'idealt',
        'evaluacion_idevaluacion',
        'grados_idgrados',
        'area_idarea',
        'alternativa',
    ];
}