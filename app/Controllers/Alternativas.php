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
        // var_dump($this->request->getPost('alternativas')[0]['alternativa']);
        // exit();
        $validez=1;
        for ($i=0; $i < $this->request->getPost('cantAlternativas'); $i++) 
        { 
            $data = [
                'alternativa' => $this->request->getPost('alternativas')[$i]['alternativa'],
                'validez' => $validez,
                'preguntas_idpreguntas' => $this->request->getPost('idpreguntas'),  
            ];
            $result = $this->m_alternativas->insert($data);
            if(!$result) 
                echo json_encode(["msg"=>"Algo salio mal.","estado"=>false]);
            $validez=0;
        }
        $evaluacion = $this->m_alternativas->where('preguntas_idpreguntas', $this->request->getPost('idpreguntas'))->get()->getResult();
        echo json_encode($evaluacion);
    }
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
        $alternativa = $this->m_alternativas
            ->where('validez', 1)
            ->where('preguntas_idpreguntas', $this->request->getPost('idpreguntas'))
            ->get()->getResult();
        if(count($alternativa)!=0)
        {
            $estadoOld = $this->m_alternativas->update($alternativa[0]->idalternativas,['validez' => 0]);
            if($estadoOld)
            {
                $estado = $this->m_alternativas->update($this->request->getPost('idalternativas'),['validez' => 1]);
                if($estado)
                    echo json_encode(["msg"=>"Se guardo los cambios.","estado"=>true]);
                else
                    echo json_encode(["msg"=>"Algo salio mal.","estado"=>false]);
            }
        }
        else
        {
            $estado = $this->m_alternativas->update($this->request->getPost('idalternativas'),['validez' => 1]);
            if($estado)
                echo json_encode(["msg"=>"Se guardo los cambios.","estado"=>true]);
            else
                echo json_encode(["msg"=>"Algo salio mal.","estado"=>false]);
        }
    }
    public function addOpcion()
    {
        $alternativa = $this->m_alternativas
            ->where('validez', 1)
            ->where('preguntas_idpreguntas', $this->request->getPost('idpreguntas'))
            ->get()->getResult();
        $data = [
            'alternativa' => $this->request->getPost('alternativa'),
            'validez' => count($alternativa)!=0?0:1,
            'preguntas_idpreguntas' => $this->request->getPost('idpreguntas'),  
        ];
        $result = $this->m_alternativas->insert($data);
        if($result) 
        {
            $p = $this->m_alternativas->orderBy('idalternativas ', 'desc')->get()->getResult();
            echo json_encode($p[0]);
        }
        else
            echo json_encode(["msg"=>"Algo salio mal.","estado"=>false]);
    }
    public function eliminarOpcion()
    {
        $alternativa = $this->m_alternativas
            ->where('idalternativas', $_POST["id"])
            ->get()->getRow();
        $idpreguntas = $alternativa->preguntas_idpreguntas;
        // var_dump($idpreguntas);
        // exit();
        if($idpreguntas!==null)
        {
            $estado = $this->m_alternativas->delete($_POST["id"]);
            if($estado)
            {
                $alternativas = $this->m_alternativas->select('alternativas.*')
                ->where('preguntas_idpreguntas', $idpreguntas)
                ->orderBy('idalternativas', 'asc')
                ->get()->getResult();

                $letras = range('A', 'Z');
                for ($i=0; $i < count($alternativas); $i++) 
                { 
                    $data = ['alternativa' => $letras[$i]];
                    $estado = $this->m_alternativas->update($alternativas[$i]->idalternativas,$data);
                    if(!$estado) 
                        echo json_encode(["msg"=>"Algo salio mal.","estado"=>false]);
                }

                // echo json_encode(["msg"=>"Se realizo el proceso exitosamente.","estado"=>true]);
                echo json_encode($alternativa);
            }
            else
                echo json_encode(["msg"=>"Algo salio mal.","estado"=>false]);
        }

    }
}
