<?php

namespace App\Controllers;

use App\Models\M_preguntas;

class Preguntas extends BaseController
{
    public function __construct() 
    {
         $this->m_preguntas = new M_preguntas();
	}
    public function index()
    {
        return view('template/secciones/header').view('v_preguntas').view('template/secciones/footer');
    }
    public function cantidadPreguntas()
    {
        $area = $this->request->getPost('area'); 
        $datos = count($this->m_preguntas->get()->getResult());
        echo json_encode($datos);
    }
    public function registrar()
    {
        $validation = \Config\Services::validation();
        $rules = ['dni' => 'required|is_unique[estudiante.dni]|min_length[8]|max_length[8]'];
        $validation->setRules($rules);
        if ($validation->withRequest($this->request)->run()) 
        {
            $data = [
                'dni' => $this->request->getPost('dni'),
                'nombres' => $this->request->getPost('nombres'),
                'apellidos' => $this->request->getPost('apellidos'),
                'estado' => $this->request->getPost('estado'),  
                'iiee_codmodular' => $this->request->getPost('codmodular'), 
                'grados_idgrados' => $this->request->getPost('grados'),
                'seccion_idseccion' => $this->request->getPost('secciones'),
                'sexo' => $this->request->getPost('sexo')
            ];
            $result = $this->m_estudiante->insert($data);

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
            {   
                $msg=$msg."Error en el campo $campo: $mensaje <br>";}
            echo json_encode(["msg"=>$msg,"estado"=>false]);
        }
    }
    public function listar()
    {
        // echo('llego hasta aki');
        $this->m_estudiante->orderBy('idestudiante', 'desc');
        $datos = $this->m_estudiante->get()->getResult();
        echo json_encode($datos);
    }
    public function eliminar()
    {
        $estado = $this->m_estudiante->delete($_POST["id"]);

        if($estado)
            echo json_encode(["msg"=>"Se realizo el proceso exitosamente.","estado"=>true]);
        else
            echo json_encode(["msg"=>"Algo salio mal.","estado"=>false]);
    }
    public function consultar()//con
    {
        // echo 'entro';
        $est = $this->m_estudiante->where('idestudiante', $_POST["id"])->get()->getResult();

        echo json_encode($est[0]);
    }
    public function actualizar()
    {

            $data = [
                'dni' => $this->request->getPost('dni'),
                'nombres' => $this->request->getPost('nombres'),
                'apellidos' => $this->request->getPost('apellidos'),
                'estado' => $this->request->getPost('estado'),  
                'iiee_codmodular' => $this->request->getPost('codmodular'), 
                'grados_idgrados' => $this->request->getPost('grados'),
                'seccion_idseccion' => $this->request->getPost('secciones'),
                'sexo' => $this->request->getPost('sexo')
            ];
            
            $estado = $this->m_estudiante->update($this->request->getPost('idestudiante'),$data);

            if($estado)
                echo json_encode(["msg"=>"Se guardo los cambios.","estado"=>true]);
            else
                echo json_encode(["msg"=>"Algo salio mal.","estado"=>false]);
     
       
    }
    public function cargaMasiva()
    {
        return view('template/secciones/header').view('iiee/cargaMasiva').view('template/secciones/footer');
    }

    
}
