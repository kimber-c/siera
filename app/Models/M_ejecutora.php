<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;

class M_ejecutora extends Model
{
    protected $table = 'ejecutora';
    protected $primaryKey = 'idejecutora';
    
    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['idejecutora','descripcion'];

    protected $useTimestamps = false;
    // protected $createdField = 'fr';
    // protected $updatedField = 'fa';

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;

    protected $db;
}