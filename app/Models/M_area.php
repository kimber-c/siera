<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;

class M_area extends Model
{
    protected $table = 'area';
    protected $primaryKey = 'idarea';
    protected $returnType = 'array';
    protected $allowedFields = [
        'idarea',
        'descripcion',
        'idioma',
        'nivel',
    ];
}