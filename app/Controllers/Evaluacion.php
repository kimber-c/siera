<?php

namespace App\Controllers;

use App\Models\M_evaluacion;

class Evaluacion extends BaseController
{
    public function __construct() 
    {
        $this->m_evaluacion = new M_evaluacion();
	}
    public function index()
    {
        return view('template/secciones/header').view('v_evaluacion').view('template/secciones/footer');
    }
    public function listar()
    {
        $data = $this->m_evaluacion->select('*')->get()->getResult();
        echo json_encode($data);
    }
    public function registrar()
    {
        $validation = \Config\Services::validation();
        $rules = [
            'anio' => 'required',
            'etapa' => 'required',
        ];
        $validation->setRules($rules);
        if ($validation->withRequest($this->request)->run()) 
        {
            $data = [
                'anio' => $this->request->getPost('anio'),
                'etapa' => $this->request->getPost('etapa'),
            ];
            $result = $this->m_evaluacion->insert($data);
            if($result) 
                echo json_encode(["msg"=>"Se registro exitosamente.","estado"=>true]);
            else
                echo json_encode(["msg"=>"Algo salio mal.","estado"=>false]);
        }
        else 
        {
            $errores = $validation->getErrors();
            $msg='';
            foreach ($errores as $campo => $mensaje) 
            {   $msg=$msg."Error en el campo $campo: $mensaje <br>";}
            echo json_encode(["msg"=>$msg,"estado"=>false]);
        }
    }
    public function eliminar()
    {
        $estado = $this->m_evaluacion->delete($_POST["id"]);
        if($estado)
            echo json_encode(["msg"=>"Se realizo el proceso exitosamente.","estado"=>true]);
        else
            echo json_encode(["msg"=>"Algo salio mal.","estado"=>false]);
    }
    public function consultar()
    {
        $evaluacion = $this->m_evaluacion->where('idevaluacion', $_POST["id"])->get()->getResult();
        echo json_encode($evaluacion[0]);
    }
    public function actualizar()
    {
        $data = [
            'anio' => $this->request->getPost('anio'),
            'etapa' => $this->request->getPost('etapa'),
        ];
        $estado = $this->m_evaluacion->update($this->request->getPost('idevaluacion'),$data);
        if($estado)
            echo json_encode(["msg"=>"Se guardo los cambios.","estado"=>true]);
        else
            echo json_encode(["msg"=>"Algo salio mal.","estado"=>false]);
    }
    public function ultimaEvaluacion()
    {
        // $evaluacion = $this->m_evaluacion->where('idevaluacion', $_POST["id"])->get()->getResult();
        // $e = $this->m_evaluacion->last();
        $evaluacion = $this->m_evaluacion->orderBy('idevaluacion', 'desc')->get()->getResult();
        // var_dump($e[0]);
        // exit();
        echo json_encode($evaluacion[0]);
    }
    
}
