<?php

namespace App\Controllers;

use App\Models\M_seccion;

class Seccion extends BaseController
{
    public function __construct() 
    {
        $this->m_seccion = new M_seccion();
    }
    public function index()
    {
        return view('template/secciones/header').view('seccion/seccion').view('template/secciones/footer');
    }
    public function listar()
    {
        $this->m_seccion->orderBy('idSeccion', 'desc');
        $datos = $this->m_seccion->get()->getResult();
        echo json_encode($datos);
    }
    public function registrar()
    {
        $validation = \Config\Services::validation();
        $rules = [
            'idseccion' => 'required|is_unique[seccion.idseccion]',
        ];
        $validation->setRules($rules);
        if ($validation->withRequest($this->request)->run()) 
        {
            $data = [
                'idseccion' => $this->request->getPost('idseccion'),
                'descripcion' => $this->request->getPost('descripcion'),
            ];
            $result = $this->m_seccion->insert($data);
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
        $estado = $this->m_seccion->delete($_POST["id"]);
        if($estado)
            echo json_encode(["msg"=>"Se realizo el proceso exitosamente.","estado"=>true]);
        else
            echo json_encode(["msg"=>"Algo salio mal.","estado"=>false]);
    }
    public function consultar()//con
    {
        $grado = $this->m_seccion->where('idseccion', $_POST["id"])->get()->getResult();
        echo json_encode($grado[0]);
    }
    public function actualizar()
    {
        $data = [
            'idseccion' => $this->request->getPost('idseccion'),
            'descripcion' => $this->request->getPost('descripcion'),
        ];
        // var_dump($this->request->getPost('idseccionOld'));
        $existingData = $this->m_seccion->where('idseccion', $this->request->getPost('idseccionOld'))->first();
        
        $estado = $this->m_seccion->update($this->request->getPost('idseccionOld'),$data);
        if($estado)
            echo json_encode(["msg"=>"Se guardo los cambios.","estado"=>true]);
        else
            echo json_encode(["msg"=>"Algo salio mal.","estado"=>false]);
    }
}
