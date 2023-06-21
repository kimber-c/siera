<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;

class M_estudiante extends Model
{
    protected $table = 'estudiante';
    protected $primaryKey = 'idestudiante';
    
    protected $returnType = 'array';


    protected $allowedFields = [
        'idestudiante',
        'dni',
        'nombres',
        'apellidos',
        'estado',
        'sexo',
        'iiee_codmodular',
        'grados_idgrados',
        'seccion_idseccion'
    ];

}