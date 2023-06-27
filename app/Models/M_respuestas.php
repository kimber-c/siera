<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;

class M_respuestas extends Model
{
    protected $table = 'conf-alternativas';
    protected $primaryKey = 'idealt';
    protected $returnType = 'array';
    protected $allowedFields = [
        'idrespuestas',
        'estudiante_idestudiante',
        'preguntas_idpreguntas',
        'clave',
        'aciertos',
    ];

     function AlumnosxGradoSeccion($grado){
        $query = $this->db->table('estudiante ES')
                         ->join('grados GR', 'GR.idgrados = ES.grados_idgrados')
                         ->select('ES.dni, CONCAT(ES.apellidos, \', \', ES.nombres) AS nombres, ES.estado, GR.idgrados')
                         ->where('GR.idgrados', $grado)
                         ->get();
        
        return $query->getResult();
    }

    function cantPreguntas($grado, $area){
        $query = $this->db->table('preguntas PR')
                         ->select('PR.idpreguntas')
                         ->where('PR.area_idarea', $area)
                         ->where('PR.grados_idgrados', $grado)
                         ->get();
        
        return $query->countAllResults();
    }
}