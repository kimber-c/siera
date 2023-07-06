<?php

namespace App\Controllers;
use CodeIgniter\I18n\Time;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Models\M_iiee;

class Iiee extends BaseController
{
    public function __construct() 
    {
		// $db = db_connect();
        //       $this->iieeModel = new M_iiee($db);
        $this->m_iiee = new M_iiee();
	}
    public function index()
    {
        return view('template/secciones/header').view('iiee/iiee').view('template/secciones/footer');
    }
    public function registrar()
    {
        $validation = \Config\Services::validation();
        $rules = [
            'codmodular' => 'required|is_unique[iiee.codmodular]|min_length[7]|max_length[7]',
        ];
        $validation->setRules($rules);
        if ($validation->withRequest($this->request)->run()) 
        {
            $fechaActual = new Time('now', 'UTC');
            $fechaFormateada = $fechaActual->format('Y-m-d H:i:s');
            $data = [
                'codmodular' => $this->request->getPost('codmodular'),
                'cod_local' => $this->request->getPost('cod_local'),
                'descripcion' => $this->request->getPost('descripcion'),
                'nivel' => $this->request->getPost('nivel'),
                'gestion' => $this->request->getPost('gestion'),
                'direccion' => $this->request->getPost('direccion'),
                'localidad' => $this->request->getPost('localidad'),
                'area_geografica' => $this->request->getPost('area_geografica'),
                'provincia_idprovincia' => $this->request->getPost('provincia'),
                'distrito_iddistrito' => $this->request->getPost('distrito'),
                'ejecutora_idejecutora' => $this->request->getPost('ugel'),
                'fecha_registro' => $fechaFormateada,
            ];
            $result = $this->m_iiee->insert($data);
            // $modelo = new M_iiee();
            // $result = $modelo->insert($data);
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
    public function listar()
    {
        $this->m_iiee->select('iiee.*, ejecutora.descripcion as nombreEjecutora, provincia.descripcion as nombreProvincia, distrito.descripcion as nombreDistrito');
        $this->m_iiee->join('ejecutora', 'ejecutora.idejecutora = iiee.ejecutora_idejecutora');
        $this->m_iiee->join('provincia', 'provincia.idprovincia = iiee.provincia_idprovincia');
        $this->m_iiee->join('distrito', 'distrito.iddistrito = iiee.distrito_iddistrito');
        $datos = $this->m_iiee->get()->getResult();
        echo json_encode($datos);
    }
    public function eliminar()
    {
        $estado = $this->m_iiee->delete($_POST["id"]);
        // var_dump($estado);
        if($estado)
            echo json_encode(["msg"=>"Se realizo el proceso exitosamente.","estado"=>true]);
        else
            echo json_encode(["msg"=>"Algo salio mal.","estado"=>false]);
    }
    public function consultar()//con
    {
        // echo 'entro';
        $ie = $this->m_iiee->where('codmodular', $_POST["id"])->get()->getResult();
        // var_dump($ie);
        echo json_encode($ie[0]);
    }
    public function actualizar()
    {
        // $validation = \Config\Services::validation();
        // $rules = [
        //     'codmodular' => 'required|is_unique[iiee.codmodular]|min_length[7]|max_length[7]',
        // ];
        // $validation->setRules($rules);
        // if ($validation->withRequest($this->request)->run()) 
        // {

            $data = [
                'codmodular' => $this->request->getPost('codmodular'),
                'cod_local' => $this->request->getPost('cod_local'),
                'descripcion' => $this->request->getPost('descripcion'),
                'nivel' => $this->request->getPost('nivel'),
                'gestion' => $this->request->getPost('gestion'),
                'direccion' => $this->request->getPost('direccion'),
                'localidad' => $this->request->getPost('localidad'),
                'area_geografica' => $this->request->getPost('area_geografica'),
                'provincia_idprovincia' => $this->request->getPost('provincia'),
                'distrito_iddistrito' => $this->request->getPost('distrito'),
                'ejecutora_idejecutora' => $this->request->getPost('ugel'),
            ];
            // var_dump($data);
            // exit();
            $estado = $this->m_iiee->update($this->request->getPost('codmodular'),$data);
            if($estado)
                echo json_encode(["msg"=>"Se guardo los cambios.","estado"=>true]);
            else
                echo json_encode(["msg"=>"Algo salio mal.","estado"=>false]);
        // }
        // else
        // {
        //     $errores = $validation->getErrors();
        //     $msg='';
        //     foreach ($errores as $campo => $mensaje) 
        //     {   $msg=$msg."Error en el campo $campo: $mensaje <br>";}
        //     echo json_encode(["msg"=>$msg,"estado"=>false]);
        // }
    }
    public function cargaMasiva()
    {
        return view('template/secciones/header').view('iiee/cargaMasiva').view('template/secciones/footer');
    }
    public function subirArchivo()
    {
        $provincias = array(
            "abancay" => 1,
            "andahuaylas" => 2,
            "aymaraes" => 3,
            "grau" => 4,
            "antabamba" => 5,
            "chincheros" => 6,
            "cotabambas" => 7,
            "huancarama" => 8,
        );
        // echo ($provincias['antabamba']);
        // exit();

        // --------------------
        $file = $this->request->getFile('file');
        if ($file->isValid() && !$file->hasMoved()) 
        {
            if(unlink('cargamasiva/iiee/cargamasiva.xlsx'))
                $file->move('cargamasiva/iiee');
            else
                return $this->response->setJSON(['estado' => false, 'msg' => 'Error al momento de cargar archivo']);
            // return $this->response->setJSON(['estado' => true, 'msg' => 'Archivo cargado con éxito']);
        } else 
        {
            return $this->response->setJSON(['estado' => false, 'msg' => 'Error al cargar el archivo']);
        }
        $file = 'cargamasiva/iiee/cargamasiva.xlsx';
        $spreadsheet = IOFactory::load($file);
        $sheet = $spreadsheet->getActiveSheet();
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();
        $highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn);
        $data = array();
        for ($row = 2; $row <= $highestRow; ++$row) {
            // for ($col = 1; $col <= $highestColumnIndex; ++$col) {
            //     $cellValue = $sheet->getCellByColumnAndRow($col, $row)->getValue();
            //     $data[$row][$col] = $cellValue;
            // }
                // -------------------------------------
            $nivel = $sheet->getCellByColumnAndRow(4, $row)->getValue()=='primaria'?1:2;
            $gestion = $sheet->getCellByColumnAndRow(5, $row)->getValue()=='publico'?1:2;
            
            $data = [
                'codmodular' => $sheet->getCellByColumnAndRow(1, $row)->getValue(),
                'cod_local' => $sheet->getCellByColumnAndRow(2, $row)->getValue(),
                'descripcion' => $sheet->getCellByColumnAndRow(3, $row)->getValue(),
                'nivel' => $nivel,
                'gestion' => $gestion,
                'direccion' => $sheet->getCellByColumnAndRow(6, $row)->getValue(),
                'localidad' => $sheet->getCellByColumnAndRow(7, $row)->getValue(),
                'area_geografica' => $sheet->getCellByColumnAndRow(8, $row)->getValue(),
                'provincia_idprovincia' => $provincias[strval($sheet->getCellByColumnAndRow(9, $row)->getValue())],
                'distrito_iddistrito' => 1,
                'ejecutora_idejecutora' => $provincias[strval($sheet->getCellByColumnAndRow(11, $row)->getValue())],
            ];
            $existingData = $this->m_iiee->where('codmodular', $data['codmodular'])->first();
            // echo '<pre>';
            // print_r($existingData);
            // echo '</pre>';
            if ($existingData) 
            {
                $this->m_iiee->update($existingData['codmodular'], $data);
                if ($this->m_iiee->affectedRows() == 0) {
                    return $this->response->setJSON(['estado' => false, 'msg' => 'Error al actualizar el registro']);
                }
            } 
            else 
            {
                $result = $this->m_iiee->insert($data);
                if($result!=0) 
                {   return $this->response->setJSON(['estado' => false, 'msg' => 'Algo salio mal al momento de guardar los registros.']);}
            }
            
        
        // -------------------------------------------------------------
        }
        return $this->response->setJSON(['estado' => true, 'msg' => 'Archivo cargado con éxito']);
    }
    
}
