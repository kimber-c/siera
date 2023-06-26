<?php

namespace App\Controllers;

use App\Models\M_confalternativas;

class Confalternativas extends BaseController
{
    public function __construct() 
    {
		$db = db_connect();
        $this->m_confalternativas = new M_confalternativas($db);
	}
    public function index()
    {
        return view('template/secciones/header').view('v_confalternativas').view('template/secciones/footer');
    }
    public function listar()
    {
        $data = $this->m_confalternativas->select('*')->get()->getResult();
        echo json_encode($data);
    }
    public function registrar()
    {
        // var_dump($this->request->getPost('letra'));
        // exit();
        $validation = \Config\Services::validation();
        $rules = [
            'idevaluacion' => 'required',
        ];
        $validation->setRules($rules);
        if ($validation->withRequest($this->request)->run()) 
        {
            $data = [
                'evaluacion_idevaluacion' => $this->request->getPost('idevaluacion'),
                'grados_idgrados' => $this->request->getPost('grado'),
                'area_idarea' => $this->request->getPost('area'),
                'alternativa' => $this->request->getPost('letra'),
            ];
            $result = $this->m_confalternativas->insert($data);
            if($result) 
            {
                $ca = $this->m_confalternativas->orderBy('idealt', 'desc')->get()->getResult();
                echo json_encode($ca[0]);
                // echo json_encode(["msg"=>"Se registro exitosamente.","estado"=>true]);
            }
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
        $estado = $this->m_confalternativas->delete($_POST["id"]);
        if($estado)
            echo json_encode(["msg"=>"Se realizo el proceso exitosamente.","estado"=>true]);
        else
            echo json_encode(["msg"=>"Algo salio mal.","estado"=>false]);
    }
    public function consultar()
    {
        $ca = $this->m_confalternativas->where('idealt', $_POST["id"])->get()->getResult();
        echo json_encode($ca[0]);
    }
    public function actualizar()
    {
        $data = [
            'evaluacion_idevaluacion' => $this->request->getPost('idevaluacion'),
            'grados_idgrados' => $this->request->getPost('grado'),
            'area_idarea' => $this->request->getPost('area'),
            'alternativa' => $this->request->getPost('letra'),
        ];
        // var_dump($this->request->getPost('idejecutoraOld'));
        $existingData = $this->m_confalternativas->where('idealt', $this->request->getPost('idealt'))->first();
        
        $estado = $this->m_confalternativas->update($this->request->getPost('idealt'),$data);
        if($estado)
            echo json_encode(["msg"=>"Se guardo los cambios.","estado"=>true]);
        else
            echo json_encode(["msg"=>"Algo salio mal.","estado"=>false]);
    }
    public function mostrar()
    {
        $lista = $this->m_confalternativas
            ->where('evaluacion_idevaluacion', $this->request->getPost('idevaluacion'))
            ->where('grados_idgrados ', $this->request->getPost('grado'))
            ->where('area_idarea', $this->request->getPost('area'))
            ->get()->getResult();
        // var_dump($lista);
        // exit();
        echo json_encode($lista);
    }
}
