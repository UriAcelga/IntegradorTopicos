<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Amos_db;
use App\Models\Mascotas_db;
use App\Models\Veterinarios_db;
use App\Models\Amos_mascotas_db;

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
        if (is_null($this->request->getPost('amo_mascotas_select'))) {
            return $this->index();
        }

        $idAmo = $this->request->getPost('amo_mascotas_select');
        $modeloMascotas = new Mascotas_db(); 
        $modeloAmos = new Amos_db();

        $data = [
            'nombreAmo' => $modeloAmos->select('nombre')->where('id_amo', $idAmo)->first()['nombre'],
            'mascotas' => $modeloMascotas
                ->select('mascotas.*, amo_mascota.es_actual')
                ->join('amo_mascota', 'mascotas.nro_registro = amo_mascota.id_mascota')
                ->where('amo_mascota.id_amo', $idAmo)
                ->findAll(),
        ];
        return view('mostrarMascotasPorAmo', $data);
    }

    public function amosPorMascota()
    {
        if (is_null($this->request->getPost('mascota-amos-select'))) {
            return $this->index();
        }

        $idMascota = $this->request->getPost('amo_mascotas_select');
        $modeloAmos = new Amos_db();
        $modeloMascotas = new Mascotas_db();

        $data = [
            'nombreMascota' => $modeloMascotas->select('nombre')->where('nro_registro', $idMascota)->first()['nombre'],
            'amos' => $modeloAmos
                ->select('amos.*, amo_mascota.es_actual')
                ->join('amo_mascota', 'amos.id_amo = amo_mascota.id_amo')
                ->where('amo_mascota.id_mascota', $idMascota)
                ->findAll(),
        ];
        return view('mostrarAmosPorMascota', $data);
    }
}
