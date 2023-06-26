<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;

class M_respuestas extends Model
{
    protected $table = 'conf-alternativas';
    protected $primaryKey = 'idealt';
    protected $returnType = 'array';
    protected $allowedFields = [
        'idrespuestas',
        'estudiante_idestudiante',
        'preguntas_idpreguntas',
        'clave',
        'aciertos',
    ];
}