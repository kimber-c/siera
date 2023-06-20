<?php

namespace App\Controllers;

use App\Models\M_distrito;

class Distrito extends BaseController
{
    public function __construct() 
    {
		$db = db_connect();
        $this->m_distrito = new M_distrito($db);
	}
    public function index()
    {
        return view('template/secciones/header').view('distrito/distrito').view('template/secciones/footer');
    }
    public function listar()
    {
        $this->m_distrito->select('distrito.*,provincia.descripcion as nombreProvincia');
        $this->m_distrito->join('provincia', 'provincia.idprovincia = distrito.provincia_idprovincia');
        $datos = $this->m_distrito->get()->getResult();
        echo json_encode($datos);
    }
    public function registrar()
    {
        $validation = \Config\Services::validation();
        $rules = [
            'idprovincia' => 'required',
            'descripcion' => 'required',
        ];
        $validation->setRules($rules);
        if ($validation->withRequest($this->request)->run()) 
        {
            $data = [
                'provincia_idprovincia' => $this->request->getPost('idprovincia'),
                'descripcion' => $this->request->getPost('descripcion'),
            ];
            $result = $this->m_distrito->insert($data);
            if($result) 
                echo json_encode(["msg"=>"Se registro exitosamente.","estado"=>true]);
            else
                echo json_encode(["msg"=>"Algo salio mal--.","estado"=>false]);
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
        $estado = $this->m_distrito->delete($_POST["id"]);
        if($estado)
            echo json_encode(["msg"=>"Se realizo el proceso exitosamente.","estado"=>true]);
        else
            echo json_encode(["msg"=>"Algo salio mal.","estado"=>false]);
    }
    public function consultar()
    {
        $distrito = $this->m_distrito->where('iddistrito', $_POST["id"])->get()->getResult();
        echo json_encode($distrito[0]);
    }
    public function actualizar()
    {
        $data = [
            'provincia_idprovincia' => $this->request->getPost('idprovincia'),
            'descripcion' => $this->request->getPost('descripcion'),
        ];
        // var_dump($this->request->getPost('idprovinciaOld'));
        $existingData = $this->m_distrito->where('iddistrito', $this->request->getPost('iddistrito'))->first();
        
        $estado = $this->m_distrito->update($this->request->getPost('iddistrito'),$data);
        if($estado)
            echo json_encode(["msg"=>"Se guardo los cambios.","estado"=>true]);
        else
            echo json_encode(["msg"=>"Algo salio mal.","estado"=>false]);
    }
}
