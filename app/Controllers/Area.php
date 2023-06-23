<?php

namespace App\Controllers;

use App\Models\M_area;

class Area extends BaseController
{
    public function __construct() 
    {
        $this->m_area = new M_area();
	}
    public function index()
    {
        return view('template/secciones/header').view('v_area').view('template/secciones/footer');
    }
    public function listar()
    {
        $data = $this->m_area->select('*')->get()->getResult();
        echo json_encode($data);
    }
    public function registrar()
    {
        $validation = \Config\Services::validation();
        $rules = [
            'descripcion' => 'required',
        ];
        $validation->setRules($rules);
        if ($validation->withRequest($this->request)->run()) 
        {
            $data = [
                'descripcion' => $this->request->getPost('descripcion'),
                'idioma' => $this->request->getPost('idioma'),
                'nivel' => $this->request->getPost('nivel'),
            ];
            $result = $this->m_area->insert($data);
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
        $estado = $this->m_area->delete($_POST["id"]);
        if($estado)
            echo json_encode(["msg"=>"Se realizo el proceso exitosamente.","estado"=>true]);
        else
            echo json_encode(["msg"=>"Algo salio mal.","estado"=>false]);
    }
    public function consultar()//con
    {
        $area = $this->m_area->where('idarea', $_POST["id"])->get()->getResult();
        echo json_encode($area[0]);
    }
    public function actualizar()
    {
        $data = [
            'descripcion' => $this->request->getPost('descripcion'),
            'idioma' => $this->request->getPost('idioma'),
            'nivel' => $this->request->getPost('nivel'),
        ];
        // $existingData = $this->m_area->where('idejecutora', $this->request->getPost('idarea'))->first();
        $estado = $this->m_area->update($this->request->getPost('idarea'),$data);
        if($estado)
            echo json_encode(["msg"=>"Se guardo los cambios.","estado"=>true]);
        else
            echo json_encode(["msg"=>"Algo salio mal.","estado"=>false]);
    }
}
