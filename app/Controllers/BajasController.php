<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class BajasController extends BaseController
{
    public function index()
    {
        return view('bajas');
    }
}
