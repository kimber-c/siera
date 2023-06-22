<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;

class M_especialista extends Model
{
    protected $table = 'especialista';
    protected $primaryKey = 'idespecialista';
    protected $returnType = 'array';
    protected $allowedFields = [
        'idespecialista',
        'dni',
        'nombres',
        'apellidos',
        'ugel_idugel',
        'usuario_idusuario',
    ];
}