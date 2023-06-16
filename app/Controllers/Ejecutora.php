<?php

namespace App\Controllers;

use App\Models\M_ejecutora;

class Ejecutora extends BaseController
{
    public function __construct() 
    {
		$db = db_connect();
        $this->ugelModel = new M_ejecutora($db);
	}
    public function listar()
    {
        $data = $this->ugelModel->select('*')->get()->getResult();
        echo json_encode($data);
    }
}
