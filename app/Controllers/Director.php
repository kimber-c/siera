<?php

namespace App\Controllers;

use App\Models\M_director;
use App\Models\M_usuario;

class Director extends BaseController
{
    public function __construct() 
    {
        $this->m_director = new M_director();
        $this->m_usuario = new M_usuario();
	}
    public function index()
    {
        return view('template/secciones/header').view('v_director').view('template/secciones/footer');
    }
    public function listar()
    {
        $this->m_director->select('director.*, iiee.*, usuario.*');
        $this->m_director->join('iiee', 'iiee.codmodular = director.iiee_cod_modular');
        $this->m_director->join('usuario', 'usuario.idusuario = director.usuario_idusuario');
        $datos = $this->m_director->get()->getResult();
        echo json_encode($datos);
    }
    public function registrar()
    {
        $validation = \Config\Services::validation();
        $rules = [
            'iiee' => 'required|is_unique[director.iiee_cod_modular]|min_length[7]|max_length[7]',
            'dni' => 'required|is_unique[director.dni]',
            'usuario' => 'required|is_unique[usuario.usuario]',

        ];
        $validation->setRules($rules);
        if($validation->withRequest($this->request)->run()) 
        {
            $dataUsuario = [
                'usuario' => $this->request->getPost('usuario'),
                'contraseña' => $this->request->getPost('password'),
                'estado' => 'activo',
            ];
            $resultUsuario = $this->m_usuario->insert($dataUsuario);
            if($resultUsuario) 
            {
                // $idusuario = $this->m_usuario->insertID();
                $dataDirector = [
                    'dni' => $this->request->getPost('dni'),
                    'nombres' => $this->request->getPost('nombres'),
                    'apellidos' => $this->request->getPost('apellidos'),
                    'iiee_cod_modular' => $this->request->getPost('iiee'),
                    'usuario_idusuario' => $this->m_usuario->insertID(),
                ];
                $resultDirector = $this->m_director->insert($dataDirector);
                if($resultDirector)
                    echo json_encode(["msg"=>"Se registro exitosamente.","estado"=>true]);
                else
                    echo json_encode(["msg"=>"Algo salio mal.","estado"=>false]);
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
        $director = $this->m_director->where('iddirector', $_POST["id"])->get()->getResult();
        $estadoDirector = $this->m_director->delete($_POST["id"]);
        $estadoUsuario = $this->m_usuario->delete($director[0]->usuario_idusuario);
        if($estadoDirector && $estadoUsuario)
            echo json_encode(["msg"=>"Se realizo el proceso exitosamente.","estado"=>true]);
        else
            echo json_encode(["msg"=>"Algo salio mal.","estado"=>false]);
    }
    public function consultar()
    {
        $this->m_director->select('director.*, usuario.*');
        $this->m_director->join('usuario', 'usuario.idusuario = director.usuario_idusuario');
        $this->m_director->where('director.iddirector', $_POST["id"]);
        $director = $this->m_director->get()->getResult();
        echo json_encode($director[0]);
    }
    public function actualizar()
    {
        $dataUsuario = [
            'usuario' => $this->request->getPost('usuario'),
            'contraseña' => $this->request->getPost('password'),
            'estado' => 'activo',
        ];
        $existingDirector = $this->m_director->where('iddirector', $this->request->getPost('iddirector'))->get()->getRow();
        $id = $existingDirector->usuario_idusuario;
        // $existingUsuario = $this->m_usuario->where('idusuario', $this->request->getPost('idejecutoraOld'))->first();
        
        $estadoUsuario = $this->m_usuario->update($id,$dataUsuario);
        if($estadoUsuario)
        {
            // var_dump('llego hasta aki');
            // echo json_encode(["msg"=>"Se guardo los cambios.","estado"=>true]);
            // $idusuario = $this->m_usuario->insertID();
            $dataDirector = [
                'dni' => $this->request->getPost('dni'),
                'nombres' => $this->request->getPost('nombres'),
                'apellidos' => $this->request->getPost('apellidos'),
                'iiee_cod_modular' => $this->request->getPost('iiee'),
            ];
            // $resultDirector = $this->m_director->insert($dataDirector);
            $estadoDirector = $this->m_director->update($this->request->getPost('iddirector'),$dataDirector);
            if($estadoDirector)
                echo json_encode(["msg"=>"Se registro exitosamente.","estado"=>true]);
            else
                echo json_encode(["msg"=>"Algo salio mal.","estado"=>false]);
        }
        else
            echo json_encode(["msg"=>"Algo salio mal.","estado"=>false]);
    }
}
