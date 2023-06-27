<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;

class M_alternativas extends Model
{
    protected $table = 'alternativas';
    protected $primaryKey = 'idalternativas';
    
    protected $returnType = 'array';
    protected $allowedFields = [
        'idalternativas',
        'descripcion',
        'validez',
        'preguntas_idpreguntas',
    ];
}