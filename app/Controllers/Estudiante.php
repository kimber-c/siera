<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Models\M_estudiante;
use App\Models\M_detalleie;

class Estudiante extends BaseController
{
    public function __construct() 
    {
        $this->m_estudiante = new M_estudiante();
        $this->m_detalleie = new M_detalleie();
	}
    public function index()
    {
        return view('template/secciones/header').view('v_estudiante').view('template/secciones/footer');
    }
    public function cargamasiva()
    {
        return view('template/secciones/header').view('v_cargamasiva').view('template/secciones/footer');
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
    // funcion en des uso
    public function subirArchivoOld()
    {
        $file = $this->request->getFile('file');
        if($file->isValid() && !$file->hasMoved()) 
        {
            if(unlink('cargamasiva/estudiante/cargamasiva_estudiantes.xlsx'))
                $file->move('cargamasiva/estudiante');
            else
                return $this->response->setJSON(['estado' => false, 'msg' => 'Error al momento de cargar archivo']);
        } 
        else 
        {
            return $this->response->setJSON(['estado' => false, 'msg' => 'Error al cargar el archivo']);
        }
        
        $file = 'cargamasiva/estudiante/cargamasiva_estudiantes.xlsx';
        $spreadsheet = IOFactory::load($file);
        $sheet = $spreadsheet->getActiveSheet();
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();
        $highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn);
// $listaDie = $this->m_detalleie->select('detalleie.*')
//     ->where('iiee_codmodular', '1234567')
//     ->where('grados_idgrados', '1')
//     ->where('seccion_idseccion', 'a')
//     ->get()->getRow();

//     var_dump($listaDie->iiee_codmodular);
        for ($row = 2; $row < $highestRow; ++$row) 
        {
            // for ($col = 1; $col <= $highestColumnIndex; ++$col) {
            //     $cellValue = $sheet->getCellByColumnAndRow($col, $row)->getValue();
            //     $data[$row][$col] = $cellValue;
            // }
// -------------------------------------
            // echo '<pre>';
            // print_r($data);
            // echo '</pre>';

            $listaDie = $this->m_detalleie->select('detalleie.*')
                ->where('iiee_codmodular', $sheet->getCellByColumnAndRow(1, $row)->getValue())
                ->where('grados_idgrados', $sheet->getCellByColumnAndRow(2, $row)->getValue())
                ->where('seccion_idseccion', $sheet->getCellByColumnAndRow(3, $row)->getValue())
                ->get()->getRow();

            // var_dump($listaDie!=null);
            if($listaDie==null)
            {
                $dataDie = [
                    'iiee_codmodular' => $sheet->getCellByColumnAndRow(1, $row)->getValue(),
                    'grados_idgrados' => $sheet->getCellByColumnAndRow(2, $row)->getValue(),
                    'seccion_idseccion' => $sheet->getCellByColumnAndRow(3, $row)->getValue(),
                ];
                // var_dump($dataDie);
                $result = $this->m_detalleie->insert($dataDie);
                if(!$result) 
                    echo json_encode(["msg"=>"Algo salio mal.","estado"=>false]);
                $listaDie = $this->m_detalleie->select('detalleie.*')
                    ->where('iiee_codmodular', $sheet->getCellByColumnAndRow(1, $row)->getValue())
                    ->where('grados_idgrados', $sheet->getCellByColumnAndRow(2, $row)->getValue())
                    ->where('seccion_idseccion', $sheet->getCellByColumnAndRow(3, $row)->getValue())
                    ->get()->getRow();
            }
            // var_dump('llego hasta aki');
            $dataEst = [
                'dni' => $sheet->getCellByColumnAndRow(4, $row)->getValue(),
                'nombres' => $sheet->getCellByColumnAndRow(5, $row)->getValue(),
                'apellidos' => $sheet->getCellByColumnAndRow(6, $row)->getValue(),
                'estado' => '1',
                'fecha_registro' => new Time('now', 'UTC'),
                'detalleie_iddetalleie' => $listaDie->iddetalleie,
            ];
            // var_dump($dataEst);
            $result = $this->m_estudiante->insert($dataEst);
            if(!$result) 
                echo json_encode(["msg"=>"Algo salio mal.","estado"=>false]);

            // var_dump($listaDie);
            
        }
        // exit();
        return $this->response->setJSON(['estado' => true, 'msg' => 'Archivo cargado con éxito']);
    }
    public function subirArchivo()
    {
        $file = $this->request->getFile('file');
        if($file->isValid() && !$file->hasMoved()) 
        {
            if(unlink('cargamasiva/estudiante/cargamasiva_estudiantes.xlsx'))
                $file->move('cargamasiva/estudiante');
            else
                return $this->response->setJSON(['estado' => false, 'msg' => 'Error al momento de cargar archivo']);
        } 
        else 
        {
            return $this->response->setJSON(['estado' => false, 'msg' => 'Error al cargar el archivo']);
        }
        
        $file = 'cargamasiva/estudiante/cargamasiva_estudiantes.xlsx';
        $spreadsheet = IOFactory::load($file);
        $sheet = $spreadsheet->getActiveSheet();
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();
        $highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn);

        for ($row = 2; $row < $highestRow; ++$row) 
        {
            $dataEst = [
                'dni' => $sheet->getCellByColumnAndRow(4, $row)->getValue(),
                'nombres' => $sheet->getCellByColumnAndRow(5, $row)->getValue(),
                'apellidos' => $sheet->getCellByColumnAndRow(6, $row)->getValue(),
                'estado' => '1',
                'sexo' => $sheet->getCellByColumnAndRow(7, $row)->getValue(),
                'iiee_codmodular' => $sheet->getCellByColumnAndRow(1, $row)->getValue(),
                'grados_idgrados' => $sheet->getCellByColumnAndRow(2, $row)->getValue(),
                'seccion_idseccion' => $sheet->getCellByColumnAndRow(3, $row)->getValue(),
            ];
            // var_dump($dataEst);
            $result = $this->m_estudiante->insert($dataEst);
            if(!$result) 
                echo json_encode(["msg"=>"Algo salio mal.","estado"=>false]);

            // var_dump($listaDie);
            
        }
        // exit();
        return $this->response->setJSON(['estado' => true, 'msg' => 'Archivo cargado con éxito']);
    }
    
}
