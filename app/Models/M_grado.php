<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;

class M_grado extends Model
{
    protected $table = 'grados';
    protected $primaryKey = 'idgrados';
    
    protected $returnType = 'array';
    // protected $useSoftDeletes = false;

    protected $allowedFields = ['idgrados','descripcion'];

    // protected $useTimestamps = false;
    // protected $createdField = 'fr';
    // protected $updatedField = 'fa';

    // protected $validationRules = [];
    // protected $validationMessages = [];
    // protected $skipValidation = false;

    // protected $db;
}