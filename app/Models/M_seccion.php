<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;

class M_seccion extends Model
{
    protected $table = 'seccion';
    protected $primaryKey = 'idseccion';
    
    protected $returnType = 'array';

    protected $allowedFields = ['idseccion','descripcion'];
}