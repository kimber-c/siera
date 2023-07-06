<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;

class M_iiee extends Model
{
    protected $table = 'iiee';
    protected $primaryKey = 'codmodular';
    protected $returnType = 'array';
    protected $allowedFields = [
        'codmodular',
        'cod_local',
        'descripcion',
        'nivel',
        'gestion',
        'direccion',
        'localidad',
        'area_geografica',
        'provincia_idprovincia',
        'distrito_iddistrito',
        'ejecutora_idejecutora',
        'fecha_registro',
    ];
}