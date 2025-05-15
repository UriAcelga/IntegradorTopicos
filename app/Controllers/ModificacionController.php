<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Amos_db;
use App\Models\Mascotas_db;
use App\Models\Veterinarios_db;
class ModificacionController extends BaseController
{
      public function __construct(){
        helper(['form', 'url', 'text']); // Añadido text helper para esc()
    }
    public function index()
    {

        $modeloAmo = new Amos_db();
        $modeloMascota = new Mascotas_db();
        $modeloVeterinarios = new Veterinarios_db();

        $amos = $modeloAmo->findAll();
        $mascotas = $modeloMascota->findAll();
        $veterinarios = $modeloVeterinarios->findAll();
        $data = [
            'amos' => $amos,
            'mascotas' => $mascotas,
            'veterinarios' => $veterinarios,
        ];
        return view('modificacion',$data);
    }
    public function modificarAmo(){
        $modeloAmo = new Amos_db();
        $modeloMascota = new Mascotas_db();
        $modeloVeterinarios = new Veterinarios_db();

        $amos = $modeloAmo->findAll();
        $mascotas = $modeloMascota->findAll();
        $veterinarios = $modeloVeterinarios->findAll();
        $idAmo = $this->request->getPost('mod_amo_select');
        $amoM = $modeloAmo->where('id_amo',$idAmo)->first();

        $data = [
            'amoId' => $idAmo,
            'amoM' => $amoM,
            'amos' => $amos,
            'mascotas' => $mascotas,
            'veterinarios' => $veterinarios,
        ];
return view('modificacion',$data);
    }
    public function guardarAmo(){
  $modeloAmo = new Amos_db();
  $nombre = $this->request->getPost('nombre');
  $apellido = $this->request->getPost('apellido');
  $direccion = $this->request->getPost('direccion');
   $telefono = $this->request->getPost('telefono');
   $id = $this->request->getPost('amo');

      $data = [
    'nombre' => $nombre,
    'apellido' => $apellido,
    'direccion_amo' => $direccion,
    'telefono' => $telefono,
   ];
$modeloAmo->update($id,$data);
 return redirect()->to('/modificacion#amo-tab')->with('success', 'modificacion de amo se realizo con éxito.');
    }

    public function modificarMascota(){
      $modeloAmo = new Amos_db();
        $modeloMascota = new Mascotas_db();
        $modeloVeterinarios = new Veterinarios_db();
        $amos = $modeloAmo->findAll();
        $mascotas = $modeloMascota->findAll();
        $veterinarios = $modeloVeterinarios->findAll();
        $idMascota = $this->request->getPost('mod_mascota_select');
        $mascotaM = $modeloMascota->where('nro_registro',$idMascota)->first();
     $data = [
        'mascotaId' => $idMascota,
            'amos' => $amos,
            'mascotas' => $mascotas,
            'veterinarios' => $veterinarios,
            'mascotaM' => $mascotaM,
        ];

        return view('modificacion',$data);
    }
    public function guardarMascota(){
$modeloMascota = new Mascotas_db();
$id = $this->request->getPost('mascota');
 $nombre = $this->request->getPost('nombre');
  $edad= $this->request->getPost('edad');
  $data = [
    'nombre' => $nombre,
    'edad' => $edad,
];
$modeloMascota->update($id,$data);
return redirect()->to('/modificacion#mascota-tab')->with('success', 'modificacion de mascota se realizo con éxito.');
    }

 public function modificarVeterinario(){
        $modeloAmo = new Amos_db();
        $modeloMascota = new Mascotas_db();
        $modeloVeterinarios = new Veterinarios_db();

        $amos = $modeloAmo->findAll();
        $mascotas = $modeloMascota->findAll();
        $veterinarios = $modeloVeterinarios->findAll();
        $idVet = $this->request->getPost('mod_vet_select');
        $veterinarioM = $modeloVeterinarios->where('id_veterinario',$idVet)->first();

        $data = [
            'veterinarioId' => $idVet,
            'veterinarioM' => $veterinarioM,
            'amos' => $amos,
            'mascotas' => $mascotas,
            'veterinarios' => $veterinarios,
        ];
return view('modificacion',$data);
    }
public function guardarVeterinario(){
$modeloVeterinarios = new Veterinarios_db();
$id = $this->request->getPost('veterinario');
 $nombre = $this->request->getPost('nombre');
  $apellido= $this->request->getPost('apellido');
  $especialidad = $this->request->getPost('especialidad');
  $telefono = $this->request->getPost('telefono');
  $data = [
    'nombre' => $nombre,
    'apellido' => $apellido,
    'especialidad' => $especialidad,
    'telefono' => $telefono,
];
$modeloVeterinarios->update($id,$data);
return redirect()->to('/modificacion#veterinario-tab')->with('success', 'modificacion de veterinario se realizo con éxito.');

}
}
