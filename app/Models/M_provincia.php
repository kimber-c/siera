<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;

class M_provincia extends Model
{
    protected $table = 'provincia';
    protected $primaryKey = 'idprovincia';
    
    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['idprovincia','descripcion',];

    protected $useTimestamps = false;
    // protected $createdField = 'fr';
    // protected $updatedField = 'fa';

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
}