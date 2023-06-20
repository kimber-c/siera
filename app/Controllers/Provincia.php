<?php

namespace App\Controllers;

use App\Models\M_provincia;

class Provincia extends BaseController
{
    public function __construct() 
    {
		$db = db_connect();
        $this->m_provincia = new M_provincia($db);
	}
    public function index()
    {
        return view('template/secciones/header').view('provincia/provincia').view('template/secciones/footer');
    }
    public function listar()
    {
        $data = $this->m_provincia->select('*')->get()->getResult();
        echo json_encode($data);
    }
    public function registrar()
    {
        $validation = \Config\Services::validation();
        $rules = [
            'idprovincia' => 'required|is_unique[provincia.idprovincia]',
        ];
        $validation->setRules($rules);
        if ($validation->withRequest($this->request)->run()) 
        {
            $data = [
                'idprovincia' => $this->request->getPost('idprovincia'),
                'descripcion' => $this->request->getPost('descripcion'),
            ];
            $result = $this->m_provincia->insert($data);
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
        $estado = $this->m_provincia->delete($_POST["id"]);
        if($estado)
            echo json_encode(["msg"=>"Se realizo el proceso exitosamente.","estado"=>true]);
        else
            echo json_encode(["msg"=>"Algo salio mal.","estado"=>false]);
    }
    public function consultar()//con
    {
        $grado = $this->m_provincia->where('idprovincia', $_POST["id"])->get()->getResult();
        echo json_encode($grado[0]);
    }
    public function actualizar()
    {
        $data = [
            'idprovincia' => $this->request->getPost('idprovincia'),
            'descripcion' => $this->request->getPost('descripcion'),
        ];
        // var_dump($this->request->getPost('idprovinciaOld'));
        $existingData = $this->m_provincia->where('idprovincia', $this->request->getPost('idprovinciaOld'))->first();
        
        $estado = $this->m_provincia->update($this->request->getPost('idprovinciaOld'),$data);
        if($estado)
            echo json_encode(["msg"=>"Se guardo los cambios.","estado"=>true]);
        else
            echo json_encode(["msg"=>"Algo salio mal.","estado"=>false]);
    }
}
