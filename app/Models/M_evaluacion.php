<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;

class M_evaluacion extends Model
{
    protected $table = 'evaluacion';
    protected $primaryKey = 'idevaluacion';
    protected $returnType = 'array';
    protected $allowedFields = [
        'idevaluacion',
        'anio',
        'etapa'
    ];
}