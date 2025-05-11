<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class MostrarController extends BaseController
{
    public function index()
    {
        return view('mostrar');
    }
}
