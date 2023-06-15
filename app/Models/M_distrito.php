<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;

class M_distrito extends Model
{
    protected $table = 'distrito';
    protected $primaryKey = 'iddistrito';
    
    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['iddistrito','descripcion',];

    protected $useTimestamps = false;
    // protected $createdField = 'fr';
    // protected $updatedField = 'fa';

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
}