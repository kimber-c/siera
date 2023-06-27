<?php

namespace App\Controllers;

use App\Models\M_alternativas;

class Alternativas extends BaseController
{
    public function __construct() 
    {
         $this->m_alternativas = new M_alternativas();
	}
    public function registrar()
    {
        $validation = \Config\Services::validation();

        $rules = [
            'idpreguntas' => 'required',
        ];
        $validation->setRules($rules);
        if ($validation->withRequest($this->request)->run()) 
        {
            $data = [
                'validez' => 0,
                'preguntas_idpreguntas' => $this->request->getPost('idpreguntas'),  
            ];
            // var_dump($data);
            // exit();
            $result = $this->m_alternativas->insert($data);
            if($result) 
            {
                $p = $this->m_alternativas->orderBy('idalternativas ', 'desc')->get()->getResult();
                echo json_encode($p[0]);
            }
            else
                echo json_encode(["msg"=>"Algo salio mal.","estado"=>false]);
        }
        else 
        {
            $errores = $validation->getErrors();
            $msg='';
            foreach ($errores as $campo => $mensaje) 
            {   
                $msg=$msg."Error en el campo $campo: $mensaje <br>";}
            echo json_encode(["msg"=>$msg,"estado"=>false]);
        }
    }
    public function registrarVarios()
    {
        for ($i=0; $i < $this->request->getPost('cantAlternativas'); $i++) 
        { 
            $data = [
                'validez' => 0,
                'preguntas_idpreguntas' => $this->request->getPost('idpreguntas'),  
            ];
            $result = $this->m_alternativas->insert($data);
            if(!$result) 
                echo json_encode(["msg"=>"Algo salio mal.","estado"=>false]);
        }
        $evaluacion = $this->m_alternativas->where('preguntas_idpreguntas', $this->request->getPost('idpreguntas'))->get()->getResult();
        echo json_encode($evaluacion);
    }
    // public function eliminar()
    // {
    //     $estado = $this->m_preguntas->delete($_POST["id"]);

    //     if($estado)
    //         echo json_encode(["msg"=>"Se realizo el proceso exitosamente.","estado"=>true]);
    //     else
    //         echo json_encode(["msg"=>"Algo salio mal.","estado"=>false]);
    // }
    public function actualizar()
    {
        $data = ['descripcion' => $this->request->getPost('descripcion'), ];
        $estado = $this->m_alternativas->update($this->request->getPost('idalternativas'),$data);
        if($estado)
            echo json_encode(["msg"=>"Se guardo los cambios.","estado"=>true]);
        else
            echo json_encode(["msg"=>"Algo salio mal.","estado"=>false]);
    }
    public function actualizarValidez()
    {
        $dataOld = ['validez' => 0];
        $alternativa = $this->m_alternativas->where('validez', 1)->get()->getResult();
        // var_dump($alternativa[0]->idevaluacion===undefined);
        var_dump(count($alternativa));
        exit();
        // echo json_encode($alternativa[0].);
        // // $estado = $this->m_evaluacion->update($this->request->getPost('idevaluacion'),$dataOld);
        // // -----------
        // $data = ['validez' => 1];
        // $estado = $this->m_alternativas->update($this->request->getPost('idalternativas'),$data);
        // if($estado)
        //     echo json_encode(["msg"=>"Se guardo los cambios.","estado"=>true]);
        // else
        //     echo json_encode(["msg"=>"Algo salio mal.","estado"=>false]);
    }
}
