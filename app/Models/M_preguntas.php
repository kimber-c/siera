<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;

class M_preguntas extends Model
{
    protected $table = 'preguntas';
    protected $primaryKey = 'idpreguntas';
    
    protected $returnType = 'array';
    protected $allowedFields = [
        'idpreguntas',
        'descripcion',
        'criterio',
        'evaluacion_idevaluacion',
        'grados_idgrados',
        'area_idarea',
    ];
}