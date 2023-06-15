<?php

namespace App\Controllers;

class LoginController extends BaseController
{
    public function login()
    {
        return view('login/login');
    }
    public function ingresar()
    {
        return view('template/secciones/header').view('dashboard/inicio').view('template/secciones/footer');
    }
}
