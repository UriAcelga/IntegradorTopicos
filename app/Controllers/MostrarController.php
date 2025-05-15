<?php

namespace App\Controllers;

use App\Models\Amos_db;
use App\Models\Mascotas_db;
use App\Models\Veterinarios_db;
// No es necesario: use App\Models\Amos_mascotas_db; // A menos que lo uses directamente aquí
// No es necesario: use App\Controllers\BaseController; // Ya se extiende

class MostrarController extends BaseController
{
    public function __construct()
    {
        helper(['form', 'url', 'text']); // Añadido text helper para esc()
    }

    public function index()
    {
        $modeloAmos = new Amos_db();
        $modeloMascotas = new Mascotas_db();
        $modeloVeterinarios = new Veterinarios_db();

        $data = [
            'amos' => $modeloAmos->findAll(),
            'mascotas' => $modeloMascotas->findAll(), // Para el select de "Amos por Mascota"
            'veterinarios' => $modeloVeterinarios->findAll(),
            'amosActivos' => $modeloAmos->distinct()
                                      ->select('amos.*')
                                      ->join('amo_mascota', 'amos.id_amo = amo_mascota.id_amo') 
                                      ->where('amo_mascota.es_actual', 1)
                                      ->orderBy('amos.apellido', 'ASC')->orderBy('amos.nombre', 'ASC')
                                      ->findAll(),
            'active_tab' => session()->getFlashdata('active_tab') ?? 'mostrar-mascotas', // Para mantener la pestaña activa
        ];
        return view('mostrar', $data);
    }

    public function mascotasPorAmo()
    {
        // Validar que se recibió el ID del amo
        $idAmo = $this->request->getPost('amo_mascotas_select');
        if (empty($idAmo)) {
            // Redirigir a la página principal de mostrar, indicando la pestaña correcta
            return redirect()->to(site_url('mostrar').'#mostrar-mascotas-amo-tab')->with('error', 'Por favor, seleccione un amo.');
        }

        $modeloMascotas = new Mascotas_db(); 
        $modeloAmos = new Amos_db();
        $amoSeleccionado = $modeloAmos->find($idAmo);

        if (!$amoSeleccionado) {
            return redirect()->to(site_url('mostrar').'#mostrar-mascotas-amo-tab')->with('error', 'El amo seleccionado no es válido.');
        }

        $data = [
            'nombreAmo' => $amoSeleccionado['nombre'] . ' ' . $amoSeleccionado['apellido'],
            'mascotasDelAmo' => $modeloMascotas // Renombrado para claridad en la vista
                ->select('mascotas.*,amo_mascota.es_actual') // Añadido campos de la relación
                ->join('amo_mascota', 'mascotas.nro_registro = amo_mascota.id_mascota')
                ->where('amo_mascota.id_amo', $idAmo)
                ->orderBy('mascotas.nombre', 'ASC')
                ->findAll(),
        ];
        return view('mostrarMascotasPorAmo', $data); // Vista específica
    }

    public function amosPorMascota()
    {
        // Validar que se recibió el ID de la mascota
        $idMascota = $this->request->getPost('mascota_amos_select'); // Corregido el nombre del campo del POST
        
        if (empty($idMascota)) {
             // Redirigir a la página principal de mostrar, indicando la pestaña correcta
            return redirect()->to(site_url('mostrar').'#mostrar-amos-mascota-tab')->with('error', 'Por favor, seleccione una mascota.');
        }

        $modeloAmos = new Amos_db();
        $modeloMascotas = new Mascotas_db();
        $mascotaSeleccionada = $modeloMascotas->find($idMascota);

        if (!$mascotaSeleccionada) {
            return redirect()->to(site_url('mostrar').'#mostrar-amos-mascota-tab')->with('error', 'La mascota seleccionada no es válida.');
        }

        $data = [
            'nombreMascota' => $mascotaSeleccionada['nombre'], // Nombre de la mascota para el título
            'amosDeLaMascota' => $modeloAmos // Renombrado para claridad en la vista
                ->select('amos.*,amo_mascota.es_actual') // Añadido campos de la relación
                ->join('amo_mascota', 'amos.id_amo = amo_mascota.id_amo')
                ->where('amo_mascota.id_mascota', $idMascota)
                ->orderBy('amos.apellido', 'ASC')->orderBy('amos.nombre', 'ASC')
                ->findAll(),
        ];
        return view('mostrarAmosPorMascota', $data); // Vista específica
    }
}
