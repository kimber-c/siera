<?php

namespace App\Controllers;

use App\Models\M_grado;

class Grado extends BaseController
{
    public function __construct() 
    {
        $this->m_grado = new M_grado();
    }
    public function index()
    {
        return view('template/secciones/header').view('v_grado').view('template/secciones/footer');
    }
    public function listar()
    {
        $this->m_grado->orderBy('idgrados', 'desc');
        $datos = $this->m_grado->get()->getResult();
        echo json_encode($datos);
    }
    public function registrar()
    {
        $validation = \Config\Services::validation();
        $rules = [
            'idgrados' => 'required|is_unique[grados.idgrados]',
        ];
        $validation->setRules($rules);
        if ($validation->withRequest($this->request)->run()) 
        {
            $data = [
                'idgrados' => $this->request->getPost('idgrados'),
                'descripcion' => $this->request->getPost('descripcion'),
            ];
            $result = $this->m_grado->insert($data);
            if($result==0) 
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
        $estado = $this->m_grado->delete($_POST["id"]);
        if($estado)
            echo json_encode(["msg"=>"Se realizo el proceso exitosamente.","estado"=>true]);
        else
            echo json_encode(["msg"=>"Algo salio mal.","estado"=>false]);
    }
    public function consultar()//con
    {
        $grado = $this->m_grado->where('idgrados', $_POST["id"])->get()->getResult();
        echo json_encode($grado[0]);
    }
    public function actualizar()
    {
        $data = [
            'idgrados' => $this->request->getPost('idgrados'),
            'descripcion' => $this->request->getPost('descripcion'),
        ];
        $existingData = $this->m_grado->where('idgrados', $this->request->getPost('idgradosOld'))->first();
        
        $estado = $this->m_grado->update($this->request->getPost('idgradosOld'),$data);
        if($estado)
            echo json_encode(["msg"=>"Se guardo los cambios.","estado"=>true]);
        else
            echo json_encode(["msg"=>"Algo salio mal.","estado"=>false]);
    }
}
