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
            'amos' => $modeloAmos->findAll(),
            'mascotas' => $modeloMascotas->findAll(),
            'veterinarios' => $modeloVeterinarios->findAll(),
            'amosActivos' => $modeloAmos->distinct()
                         ->select('amos.*')
                         ->join('amo_mascota', 'amos.id_amo = amo_mascota.id_amo') 
                         ->where('amo_mascota.es_actual', 1)
                         ->orderBy('amos.apellido', 'ASC')->orderBy('amos.nombre', 'ASC')
                         ->findAll(),
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
