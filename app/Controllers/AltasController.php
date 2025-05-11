<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class AltasController extends BaseController
{
    public function index()
    {
        return view('altas');
    }
}
