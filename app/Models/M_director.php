<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;

class M_director extends Model
{
    protected $table = 'director';
    protected $primaryKey = 'iddirector';
    protected $returnType = 'array';
    protected $allowedFields = [
        'iddirector',
        'dni',
        'nombres',
        'apellidos',
        'iiee_cod_modular',
        'usuario_idusuario',
    ];
}