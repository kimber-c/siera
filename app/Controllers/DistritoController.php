<?php

namespace App\Controllers;

use App\Models\M_distrito;

class DistritoController extends BaseController
{
    public function __construct() 
    {
		$db = db_connect();
        $this->distritoModel = new M_distrito($db);
	}
    public function listar()
    {
        $data = $this->distritoModel->select('*')->get()->getResult();
        echo json_encode($data);
    }
}
