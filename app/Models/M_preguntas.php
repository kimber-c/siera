<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;

class M_preguntas extends Model
{
    protected $table = 'preguntas';
    protected $primaryKey = 'idpreguntas';
    
    protected $returnType = 'array';
    protected $allowedFields = [
        'idpreguntas',
        'descripcion',
        'criterio',
        'evaluacion_idevaluacion',
        'grados_idgrados',
        'area_idarea',
    ];
    public function listarAlternativas($idevaluacion, $grado, $area)
    {
        $query = $this->select('preguntas.criterio, preguntas.descripcion as pregunta, alternativas.*')
            ->join('alternativas', 'alternativas.preguntas_idpreguntas = preguntas.idpreguntas', 'left')
            ->where('evaluacion_idevaluacion', $idevaluacion)
            ->where('grados_idgrados', $grado)
            ->where('area_idarea', $area)
            ->get();

        return $query->getResult();
    }
    public function listarPreguntas($idevaluacion, $grado, $area)
    {
        $query = $this->select('preguntas.*')
            ->where('evaluacion_idevaluacion', $idevaluacion)
            ->where('grados_idgrados', $grado)
            ->where('area_idarea', $area)
            ->get();

        return $query->getResult();
    }
}