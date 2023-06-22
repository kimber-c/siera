<?php

namespace App\Controllers;

use App\Models\M_especialista;
use App\Models\M_usuario;

class Especialista extends BaseController
{
    public function __construct() 
    {
        $this->m_especialista = new M_especialista();
        $this->m_usuario = new M_usuario();
	}
    public function index()
    {
        return view('template/secciones/header').view('v_especialista').view('template/secciones/footer');
    }
    public function listar()
    {
        $this->m_especialista->select('especialista.*, ejecutora.*, usuario.*');
        $this->m_especialista->join('ejecutora', 'ejecutora.idejecutora = especialista.ugel_idugel');
        $this->m_especialista->join('usuario', 'usuario.idusuario = especialista.usuario_idusuario');
        $datos = $this->m_especialista->get()->getResult();
        echo json_encode($datos);
    }
    public function registrar()
    {
        // var_dump($this->request->getPost('estado'));
        // exit();
        $validation = \Config\Services::validation();
        $rules = [
            'ejecutora' => 'required',
            'dni' => 'required|is_unique[especialista.dni]',
            'usuario' => 'required|is_unique[usuario.usuario]',

        ];
        $validation->setRules($rules);
        if($validation->withRequest($this->request)->run()) 
        {
            $dataUsuario = [
                'usuario' => $this->request->getPost('usuario'),
                'contraseña' => password_hash($this->request->getPost('password'),PASSWORD_DEFAULT),
                // $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                'estado' => $this->request->getPost('estado')=="true"?"activo":"inactivo",
            ];
            $resultUsuario = $this->m_usuario->insert($dataUsuario);
            if($resultUsuario) 
            {
                // $idusuario = $this->m_usuario->insertID();
                $dataEspecialista = [
                    'dni' => $this->request->getPost('dni'),
                    'nombres' => $this->request->getPost('nombres'),
                    'apellidos' => $this->request->getPost('apellidos'),
                    'ugel_idugel' => $this->request->getPost('ejecutora'),
                    'usuario_idusuario' => $this->m_usuario->insertID(),
                ];
                $resultEspecialista = $this->m_especialista->insert($dataEspecialista);
                if($resultEspecialista)
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
        $especialista = $this->m_especialista->where('idespecialista', $_POST["id"])->get()->getResult();
        $estadoEspecialista = $this->m_especialista->delete($_POST["id"]);
        $estadoUsuario = $this->m_usuario->delete($especialista[0]->usuario_idusuario);
        if($estadoEspecialista && $estadoUsuario)
            echo json_encode(["msg"=>"Se realizo el proceso exitosamente.","estado"=>true]);
        else
            echo json_encode(["msg"=>"Algo salio mal.","estado"=>false]);
    }
    public function consultar()
    {
        $this->m_especialista->select('especialista.*, usuario.*');
        $this->m_especialista->join('usuario', 'usuario.idusuario = especialista.usuario_idusuario');
        $this->m_especialista->where('especialista.idespecialista', $_POST["id"]);
        $especialista = $this->m_especialista->get()->getResult();
        echo json_encode($especialista[0]);
    }
    public function actualizar()
    {
        $dataUsuario = [
            'usuario' => $this->request->getPost('usuario'),
            // 'contraseña' => $this->request->getPost('password'),
            'contraseña' => password_hash($this->request->getPost('password'),PASSWORD_DEFAULT),
            'estado' => $this->request->getPost('estado')=="true"?"activo":"inactivo",
        ];
        $existeEspecialista = $this->m_especialista->where('idespecialista', $this->request->getPost('idespecialista'))->get()->getRow();
        $id = $existeEspecialista->usuario_idusuario;
        // $existingUsuario = $this->m_usuario->where('idusuario', $this->request->getPost('idejecutoraOld'))->first();
        
        $estadoUsuario = $this->m_usuario->update($id,$dataUsuario);
        if($estadoUsuario)
        {
            // var_dump('estro hast aki');
            // exit();
            // var_dump('llego hasta aki');
            // echo json_encode(["msg"=>"Se guardo los cambios.","estado"=>true]);
            // $idusuario = $this->m_usuario->insertID();
            $dataEspecialista = [
                'dni' => $this->request->getPost('dni'),
                'nombres' => $this->request->getPost('nombres'),
                'apellidos' => $this->request->getPost('apellidos'),
                'ugel_idugel' => $this->request->getPost('ejecutora'),
            ];
            // $resultDirector = $this->m_especialista->insert($dataEspecialista);
            $estadoEspecialista = $this->m_especialista->update($this->request->getPost('idespecialista'),$dataEspecialista);
            if($estadoEspecialista)
                echo json_encode(["msg"=>"Se registro exitosamente.","estado"=>true]);
            else
                echo json_encode(["msg"=>"Algo salio mal.","estado"=>false]);
        }
        else
            echo json_encode(["msg"=>"Algo salio mal.","estado"=>false]);
    }
}
