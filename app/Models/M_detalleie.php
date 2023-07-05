<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;

class M_detalleie extends Model
{
    protected $table = 'detalleie';
    protected $primaryKey = 'iddetalleie';
    protected $returnType = 'array';
    protected $allowedFields = [
        'iddetalleie',
        'iiee_codmodular',
        'grados_idgrados',
        'seccion_idseccion',
    ];
}