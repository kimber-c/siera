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

        $rules = [
            'idevaluacion' => 'required',
            'grado' => 'required',
            'area' => 'required',
        ];
        $validation->setRules($rules);
        if ($validation->withRequest($this->request)->run()) 
        {
            $data = [
                'evaluacion_idevaluacion' => $this->request->getPost('idevaluacion'),
                'grados_idgrados' => $this->request->getPost('grado'),
                'area_idarea' => $this->request->getPost('area'),
                'descripcion' => '--',  
                'orden' => $this->request->getPost('orden'),
            ];
            // var_dump($data);
            // exit();
            $result = $this->m_preguntas->insert($data);

            if($result) 
            {
                $p = $this->m_preguntas->orderBy('idpreguntas ', 'desc')->get()->getResult();
                echo json_encode($p[0]);
            }
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
        $this->m_estudiante->orderBy('idestudiante', 'desc');
        $datos = $this->m_estudiante->get()->getResult();
        echo json_encode($datos);
    }
    public function eliminar()
    {
        // ------------------------------------------------------------------
        
        // var_dump(count($preguntas));
        // exit();
        $estado = $this->m_preguntas->delete($_POST["id"]);

        if($estado)
        {
            $preguntas = $this->m_preguntas->select('preguntas.*')
            ->where('evaluacion_idevaluacion', $_POST["idevaluacion"])
            ->where('grados_idgrados', $_POST["grado"])
            ->where('area_idarea', $_POST["area"])
            ->orderBy('orden', 'asc')
            ->get()->getResult();

            $j=1;
            for ($i=0; $i < count($preguntas); $i++) 
            { 
                $data = ['orden' => $j];
                $estado = $this->m_preguntas->update($preguntas[$i]->idpreguntas,$data);
                if(!$estado) 
                    echo json_encode(["msg"=>"Algo salio mal.","estado"=>false]);
                $j=$j+1;
            }

            echo json_encode(["msg"=>"Se realizo el proceso exitosamente.","estado"=>true]);
        }
        else
            echo json_encode(["msg"=>"Algo salio mal.","estado"=>false]);
    }
    public function consultar()
    {
        $est = $this->m_estudiante->where('idestudiante', $_POST["id"])->get()->getResult();

        echo json_encode($est[0]);
    }
    public function actualizar()
    {
        if($this->request->getPost('tipo')=='pregunta')
            $data = ['descripcion' => $this->request->getPost('descripcion'), ];
        else
            $data = ['criterio' => $this->request->getPost('criterio'), ];

        $estado = $this->m_preguntas->update($this->request->getPost('idpreguntas'),$data);
        if($estado)
            echo json_encode(["msg"=>"Se guardo los cambios.","estado"=>true]);
        else
            echo json_encode(["msg"=>"Algo salio mal.","estado"=>false]);
    }
    
    public function listarCard()
    {
        $listarAlternativas = $this->m_preguntas->listarAlternativas(
            $this->request->getPost('idevaluacion'),
            $this->request->getPost('grado'),
            $this->request->getPost('area'),
        );
        $listarPreguntas = $this->m_preguntas->listarPreguntas(
            $this->request->getPost('idevaluacion'),
            $this->request->getPost('grado'),
            $this->request->getPost('area'),
        );
        $data = [
            'alternativas' => $listarAlternativas,
            'preguntas' => $listarPreguntas
        ];
        $jsonData = json_encode($data);

        return $this->response->setJSON($jsonData);

        // $jsonData = json_encode($data);
    }
    public function cambiarOrden()
    {
        for ($i=0; $i < count($this->request->getPost('ordenPreguntas')); $i++) 
        { 
            $id = explode("id", $this->request->getPost('ordenPreguntas')[$i])[1];
            $data = ['orden' => ($i+1)];
            $estado = $this->m_preguntas->update($id,$data);
            if(!$estado) 
                echo json_encode(["msg"=>"Algo salio mal.","estado"=>false]);
        }
        echo json_encode(["msg"=>"Procesos exitoso.","estado"=>true]);
        // exit();
        // $ordenActual=$this->request->getPost('newOrden')+1;

        // $preguntas = $this->m_preguntas->select('preguntas.*')
        //     ->where('evaluacion_idevaluacion', $_POST["idevaluacion"])
        //     ->where('grados_idgrados', $_POST["grado"])
        //     ->where('area_idarea', $_POST["area"])
        //     ->orderBy('orden', 'asc')
        //     ->get()->getResult();

        // $j=1;
        // for ($i=0; $i < count($preguntas); $i++) 
        // { 
        //     if($preguntas[$i]->idpreguntas==$this->request->getPost('idpreguntas'))
        //     {
        //         $data = ['orden' => $ordenActual];
        //         $estado = $this->m_preguntas->update($preguntas[$i]->idpreguntas,$data);
        //         if(!$estado) 
        //             echo json_encode(["msg"=>"Algo salio mal.","estado"=>false]);
        //     }
        //     else
        //     {
        //         if($preguntas[$i]->orden==$ordenActual)
        //         {
        //             $j=$j+1;
        //         }
        //         $data = ['orden' => $j];
        //         $estado = $this->m_preguntas->update($preguntas[$i]->idpreguntas,$data);
        //         if(!$estado) 
        //             echo json_encode(["msg"=>"Algo salio mal.","estado"=>false]);
        //     }
        //     $j=$j+1;
        // }

        // exit();
    }
}
