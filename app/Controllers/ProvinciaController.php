<?php

namespace App\Controllers;

use App\Models\M_provincia;

class ProvinciaController extends BaseController
{
    public function __construct() 
    {
		$db = db_connect();
        $this->provinciaModel = new M_provincia($db);
	}
    public function listar()
    {
        $data = $this->provinciaModel->select('*')->get()->getResult();
        echo json_encode($data);
    }
}
