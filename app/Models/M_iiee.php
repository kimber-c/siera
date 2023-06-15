<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;

class M_iiee extends Model
{
    protected $table = 'iiee';
    protected $primaryKey = 'cod_modular';
    
    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'cod_modular',
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

    protected $useTimestamps = false;
    protected $createdField = 'fr';
    protected $updatedField = 'fa';

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;

}