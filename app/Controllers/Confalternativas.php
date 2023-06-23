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
    public function eliminar()
    {
        $estado = $this->m_confalternativas->delete($_POST["id"]);
        if($estado)
            echo json_encode(["msg"=>"Se realizo el proceso exitosamente.","estado"=>true]);
        else
            echo json_encode(["msg"=>"Algo salio mal.","estado"=>false]);
    }
    public function consultar()//con
    {
        $ejecutora = $this->m_confalternativas->where('idejecutora', $_POST["id"])->get()->getResult();
        echo json_encode($ejecutora[0]);
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
