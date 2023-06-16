<?php

namespace App\Controllers;

class Login extends BaseController
{
    public function login()
    {
        return view('login/login');
    }
    public function index()
    {
        return view('template/secciones/header').view('dashboard/inicio').view('template/secciones/footer');
    }
}
