<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;

class M_usuario extends Model
{
    protected $table = 'usuario';
    protected $primaryKey = 'idusuario';
    protected $returnType = 'array';
    protected $allowedFields = [
        'idusuario',
        'usuario',
        'contraseña',
        'estado',
    ];
}