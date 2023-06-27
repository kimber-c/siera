<?php

namespace App\Controllers;

use App\Models\M_respuestas;

class Respuestas extends BaseController
{
    public function __construct() 
    {

        $this->M_respuestas = new M_respuestas();
	}
    public function index()
    {
        return view('template/secciones/header').view('v_respuestas').view('template/secciones/footer');
    }
    public function listar()
    {   
        $grado = $this->request->getPost('grado');
        $lista = $this->M_respuestas->AlumnosxGradoSeccion($grado);

        echo json_encode($lista);
    }

    public function cantPreguntas()
    {   
        $grado = $this->request->getPost('grado');
        $area = $this->request->getPost('area');
        $lista = $this->M_respuestas->cantPreguntas($grado, $area);

        echo json_encode($lista);
    }
    

    public function registrar()
    {
        $validation = \Config\Services::validation();
        $rules = [
            'evaluacion_idevaluacion' => 'required',
        ];
        $validation->setRules($rules);
        if ($validation->withRequest($this->request)->run()) 
        {
            $data = [
                'idejecutora' => $this->request->getPost('idejecutora'),
                'descripcion' => $this->request->getPost('descripcion'),
            ];
            $result = $this->m_confalternativas->insert($data);
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
    
    
    public function actualizar()
    {
        $data = [
            'idejecutora' => $this->request->getPost('idejecutora'),
            'descripcion' => $this->request->getPost('descripcion'),
        ];
        // var_dump($this->request->getPost('idejecutoraOld'));
        $existingData = $this->m_confalternativas->where('idejecutora', $this->request->getPost('idejecutoraOld'))->first();
        
        $estado = $this->m_confalternativas->update($this->request->getPost('idejecutoraOld'),$data);
        if($estado)
            echo json_encode(["msg"=>"Se guardo los cambios.","estado"=>true]);
        else
            echo json_encode(["msg"=>"Algo salio mal.","estado"=>false]);
    }
}
