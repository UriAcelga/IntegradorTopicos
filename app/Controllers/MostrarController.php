<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Amos_db;
use App\Models\Mascotas_db;
use App\Models\Veterinarios_db;

class MostrarController extends BaseController
{
    public function index()
    {
        $modeloAmos = new Amos_db();
        $modeloMascotas = new Mascotas_db();
        $modeloVeterinarios = new Veterinarios_db();

        $data = [
            'amos' => $modeloAmos->paginate(10),
            'pagerAmos' => $modeloAmos->pager,
            //'mascotas' => $modeloMascotas->paginate(10),
            //'pagerMascotas' => $modeloMascotas->pager,
            'mascotas' => $modeloMascotas->findAll(),
            'veterinarios' => $modeloVeterinarios->paginate(10),
            'pagerVeterinarios' => $modeloVeterinarios->pager,
        ];
        return view('mostrar', $data);
    }

    public function mascotasPorAmo()
    {
        return view('mostrarMascotasPorAmo');
    }

    public function amosPorMascota()
    {
        return view('mostrarAmosPorMascota');
    }
}
