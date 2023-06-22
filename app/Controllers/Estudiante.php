<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Models\M_estudiante;

class Estudiante extends BaseController
{
    public function __construct() 
    {
        $this->m_estudiante = new M_estudiante();
	}
    public function index()
    {
        return view('template/secciones/header').view('v_estudiante').view('template/secciones/footer');
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
    // public function subirArchivo()
    // {
    //     $provincias = array(
    //         "abancay" => 1,
    //         "andahuaylas" => 2,
    //         "aymaraes" => 3,
    //         "grau" => 4,
    //         "antabamba" => 5,
    //         "chincheros" => 6,
    //         "cotabamba" => 7,
    //         "huancarama" => 8,
    //     );
    //     // echo ($provincias['antabamba']);
    //     // exit();

    //     // --------------------
    //     $file = $this->request->getFile('file');
    //     if ($file->isValid() && !$file->hasMoved()) 
    //     {
    //         if(unlink('cargamasiva/iiee/cargamasiva.xlsx'))
    //             $file->move('cargamasiva/iiee');
    //         else
    //             return $this->response->setJSON(['estado' => false, 'msg' => 'Error al momento de cargar archivo']);
    //         // return $this->response->setJSON(['estado' => true, 'msg' => 'Archivo cargado con éxito']);
    //     } else 
    //     {
    //         return $this->response->setJSON(['estado' => false, 'msg' => 'Error al cargar el archivo']);
    //     }
    //     // Obtener el nombre y la ubicación del archivo de Excel
    //     $file = 'cargamasiva/iiee/cargamasiva.xlsx';
    //     // Cargar el archivo de Excel
    //     $spreadsheet = IOFactory::load($file);
    //     // Obtener la hoja de cálculo activa
    //     $sheet = $spreadsheet->getActiveSheet();
    //     // Obtener el número de filas y columnas en la hoja de cálculo
    //     $highestRow = $sheet->getHighestRow();
    //     $highestColumn = $sheet->getHighestColumn();
    //     $highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn);
    //     // Recorrer las filas y columnas para leer los datos
    //     $data = array();
    //     for ($row = 2; $row <= $highestRow; ++$row) {
    //         // for ($col = 1; $col <= $highestColumnIndex; ++$col) {
    //         //     $cellValue = $sheet->getCellByColumnAndRow($col, $row)->getValue();
    //         //     $data[$row][$col] = $cellValue;
    //         // }
    //             // -------------------------------------
    //         $nivel = $sheet->getCellByColumnAndRow(4, $row)->getValue()=='primaria'?1:2;
    //         $gestion = $sheet->getCellByColumnAndRow(5, $row)->getValue()=='publico'?1:2;
            
    //         $data = [
    //             'codmodular' => $sheet->getCellByColumnAndRow(1, $row)->getValue(),
    //             'cod_local' => $sheet->getCellByColumnAndRow(2, $row)->getValue(),
    //             'descripcion' => $sheet->getCellByColumnAndRow(3, $row)->getValue(),
    //             'nivel' => $nivel,
    //             'gestion' => $gestion,
    //             'direccion' => $sheet->getCellByColumnAndRow(6, $row)->getValue(),
    //             'localidad' => $sheet->getCellByColumnAndRow(7, $row)->getValue(),
    //             'area_geografica' => $sheet->getCellByColumnAndRow(8, $row)->getValue(),
    //             'provincia_idprovincia' => $provincias[strval($sheet->getCellByColumnAndRow(9, $row)->getValue())],
    //             'distrito_iddistrito' => 1,
    //             'ejecutora_idejecutora' => $provincias[strval($sheet->getCellByColumnAndRow(11, $row)->getValue())],
    //         ];
    //         $existingData = $this->m_iiee->where('codmodular', $data['codmodular'])->first();
    //         // echo '<pre>';
    //         // print_r($existingData);
    //         // echo '</pre>';
    //         if ($existingData) 
    //         {
    //             $this->m_iiee->update($existingData['codmodular'], $data);
    //             if ($this->m_iiee->affectedRows() == 0) {
    //                 return $this->response->setJSON(['estado' => false, 'msg' => 'Error al actualizar el registro']);
    //             }
    //         } 
    //         else 
    //         {
    //             $result = $this->m_iiee->insert($data);
    //             if($result!=0) 
    //             {   return $this->response->setJSON(['estado' => false, 'msg' => 'Algo salio mal al momento de guardar los registros.']);}
    //         }
            
        
    //     return $this->response->setJSON(['estado' => true, 'msg' => 'Archivo cargado con éxito']);
    // }
    
}
