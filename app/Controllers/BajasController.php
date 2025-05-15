<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\AmosModel;
use App\Models\RelacionModel;
use App\Models\MascotasModel;
use App\Models\BajasModel;
use App\Models\VeterinarioModel;

class BajasController extends BaseController
{
    public function __construct(){
        helper('form'); 
    }
    public function index()
    {
         $amoModel = new AmosModel();
         $veterinariosModel = new VeterinarioModel();
         $amos = $amoModel->distinct()
                      ->select('amos.*')
                    ->join('amo_mascota', 'amos.id_amo = amo_mascota.id_amo') 
                     ->where('amo_mascota.es_actual', 1)
                    ->findAll();
         $veterinarios=$veterinariosModel->where('fecha_egreso',null)->findAll();
         $data = [
            'veterinarios' => $veterinarios,
    'amos' => $amos,
                 ];
        
        return view('bajas',$data);
    }
public function eleccion(){
         $amoId = $this->request->getPost('amo');
         $mascotasModel = new MascotasModel();
         $amoModel = new AmosModel();
            $veterinariosModel = new VeterinarioModel(); 
             $amos = $amoModel ->distinct()
                     ->select('amos.*')
                    ->join('amo_mascota', 'amos.id_amo = amo_mascota.id_amo') 
                     ->where('amo_mascota.es_actual', 1)
                    ->findAll();
         $veterinarios=$veterinariosModel->where('fecha_egreso',NULL)->findAll();
         $mascotas = $mascotasModel->select('mascotas.*')
                    ->join('amo_mascota', 'mascotas.nro_registro = amo_mascota.id_mascota') // Join on the pet ID
                    ->where('amo_mascota.id_amo', $amoId) // Filter by the owner ID
                     ->where('amo_mascota.es_actual', 1)
                    ->findAll(); // Get all matching results
                $data = [
                    'mascotas' => $mascotas,
                    'amoId' => $amoId,  
                    'amos' => $amos,
                    'veterinarios' => $veterinarios,    
         ];
         return view('bajas',$data);
        }
        public function baja(){
                    $relacionesModel = new RelacionModel();
                    $mascotasModel = new MascotasModel();
                    $baja = new BajasModel();
                   $amoId = $this->request->getPost('amo');
                    $mascotaId = $this->request->getPost('mascota');
                    $motivo = $this->request->getPost('motivo-baja');
                    $fechaActual = date('Y-m-d');
                    log_message('debug', 'Intentando actualizar relacion para Amo ID: ' . $amoId . ' y Mascota ID: ' . $mascotaId);
     if($motivo === "fallecimiento"){

        $dataf = [
            'fecha_defuncion'=> $fechaActual,
        ];
        $mascotasModel->update($mascotaId, $dataf);
     }
     $datab = [
        'fecha_baja' => $fechaActual,
        'id_mascota' => $mascotaId,
        'motivo' => $motivo,
      ];
$baja->insert($datab);

$data = [
    'es_actual' => 0
];

$db = \Config\Database::connect();
$builder = $db->table('amo_mascota');

$builder->where('id_amo', $amoId)
        ->where('id_mascota', $mascotaId)
        ->update(['es_actual' => 0]);
             return redirect()->back()->with('success', 'Baja realizada con éxito.');
        }
  
public function bajaVeterinario(){
    $veterinarios = new veterinarioModel();
$id_veterinario = $this->request->getpost('veterinario');
   $fechaActual = date('Y-m-d');
$data = [

    'fecha_egreso' => $fechaActual,
];
 $veterinarios->update($id_veterinario,$data);
return redirect()->back()->with('success', 'Baja realizada con éxito.');
}
}
