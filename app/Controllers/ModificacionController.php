<?php

namespace App\Controllers;

// Removido: use App\Controllers\BaseController; // Ya se extiende
// Removido: use CodeIgniter\HTTP\ResponseInterface; // No se usa directamente
use App\Models\Amos_db;
use App\Models\Mascotas_db;
use App\Models\Veterinarios_db;

class ModificacionController extends BaseController
{
    public function __construct(){
        helper(['form', 'url', 'text']); 
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
            'active_tab' => session()->getFlashdata('active_tab') ?? 'mod-amo', // Pestaña por defecto o desde flashdata
            // Asegúrate de pasar también los datos para repoblar formularios si vienes de un error de validación en 'guardarXyz'
            'validation' => session()->getFlashdata('validation') 
        ];
        
        return view('modificacion', $data);
    }

    public function modificarAmo(){
        $modeloAmo = new Amos_db();
        $modeloMascota = new Mascotas_db(); // Para los selects generales
        $modeloVeterinarios = new Veterinarios_db(); // Para los selects generales

        $idAmo = $this->request->getPost('mod_amo_select');
        $amoM = null;
        if (!empty($idAmo)) {
            $amoM = $modeloAmo->where('id_amo', $idAmo)->first();
        }

        $data = [
            'amoId' => $idAmo,
            'amoM' => $amoM, // Datos del amo seleccionado para el formulario de modificación
            'amos' => $modeloAmo->findAll(), // Lista completa para el select
            'mascotas' => $modeloMascota->findAll(), // Lista completa para el select (si es necesario en otras pestañas)
            'veterinarios' => $modeloVeterinarios->findAll(), // Lista completa para el select (si es necesario en otras pestañas)
            'active_tab' => 'mod-amo' // Indicar que esta pestaña debe estar activa
        ];
        return view('modificacion', $data);
    }

    public function guardarAmo(){
        $modeloAmo = new Amos_db();
        $id = $this->request->getPost('amo_id_hidden'); // Cambiado para que coincida con el input hidden
        $data = [
            'nombre'        => $this->request->getPost('nombre'),
            'apellido'      => $this->request->getPost('apellido'),
            'direccion_amo' => $this->request->getPost('direccion'), // Asegúrate que el nombre del campo en DB sea 'direccion_amo'
            'telefono'      => $this->request->getPost('telefono'),
        ];

        // Aquí deberías añadir validación antes de actualizar
        // Ejemplo de validación (simplificado):
        // $rules = [ /* tus reglas */ ];
        // if ($this->validate($rules)) {
        //     if ($modeloAmo->update($id, $data)) {
        //         return redirect()->to('/modificacion#mod-amo-tab')->with('success_mod_amo', 'Datos del Amo actualizados con éxito.');
        //     } else {
        //         return redirect()->to('/modificacion#mod-amo-tab')->with('error_mod_amo', 'Error al actualizar los datos del Amo.')->withInput();
        //     }
        // } else {
        //     // Pasar los datos necesarios para repoblar el formulario y la lista, además de la validación y la pestaña activa
        //     // Esto es más complejo porque necesitas recargar todos los datos que `modificarAmo` carga
        //     // Es mejor manejar la carga de datos para la vista en un método separado o en index() y pasar `active_tab`
        //     return redirect()->to(site_url('modificacionController/recargarModificarAmo/'.$id))->withInput()->with('validation', $this->validator)->with('active_tab', 'mod-amo');

        // }

        // Simplificado por ahora, asumiendo que la actualización siempre es exitosa para el ejemplo
        if ($modeloAmo->update($id, $data)) {
            return redirect()->to('/modificacion#mod-amo-tab')->with('success_mod_amo', 'Modificación de amo se realizó con éxito.');
        } else {
             return redirect()->to('/modificacion#mod-amo-tab')->with('error_mod_amo', 'Error al modificar el amo.')->withInput();
        }
    }

    public function modificarMascota(){
        $modeloMascota = new Mascotas_db();
        $idMascota = $this->request->getPost('mod_mascota_select');
        $mascotaM = null;
        if (!empty($idMascota)) {
            $mascotaM = $modeloMascota->where('nro_registro', $idMascota)->first();
        }

        // Necesitas cargar los datos para todos los selects de la página
        $modeloAmo = new Amos_db();
        $modeloVeterinarios = new Veterinarios_db();

        $data = [
            'mascotaId' => $idMascota,
            'mascotaM' => $mascotaM,
            'amos' => $modeloAmo->findAll(),
            'mascotas' => $modeloMascota->findAll(), // Para el select principal de mascotas
            'veterinarios' => $modeloVeterinarios->findAll(),
            'active_tab' => 'mod-mascota' // Indicar que esta pestaña debe estar activa
        ];
        return view('modificacion', $data);
    }

    public function guardarMascota(){
        $modeloMascota = new Mascotas_db();
        $id = $this->request->getPost('mascota_id_hidden'); // Cambiado
        $data = [
            'nombre' => $this->request->getPost('nombre'),
            'edad'   => $this->request->getPost('edad'),
            // Añade aquí más campos si los tienes en el formulario de modificación de mascota
        ];
        // Añadir validación aquí
        if ($modeloMascota->update($id, $data)) {
            return redirect()->to('/modificacion#mod-mascota-tab')->with('success_mod_mascota', 'Modificación de mascota se realizó con éxito.');
        } else {
            return redirect()->to('/modificacion#mod-mascota-tab')->with('error_mod_mascota', 'Error al modificar la mascota.')->withInput();
        }
    }

    public function modificarVeterinario(){
        $modeloVeterinarios = new Veterinarios_db();
        $idVet = $this->request->getPost('mod_vet_select');
        $veterinarioM = null;
        if (!empty($idVet)) {
            $veterinarioM = $modeloVeterinarios->where('id_veterinario', $idVet)->first();
        }

        // Necesitas cargar los datos para todos los selects de la página
        $modeloAmo = new Amos_db();
        $modeloMascota = new Mascotas_db();

        $data = [
            'veterinarioId' => $idVet,
            'veterinarioM' => $veterinarioM,
            'amos' => $modeloAmo->findAll(),
            'mascotas' => $modeloMascota->findAll(),
            'veterinarios' => $modeloVeterinarios->findAll(), // Para el select principal de veterinarios
            'active_tab' => 'mod-veterinario' // Indicar que esta pestaña debe estar activa
        ];
        return view('modificacion', $data);
    }

    public function guardarVeterinario(){
        $modeloVeterinarios = new Veterinarios_db();
        $id = $this->request->getPost('veterinario_id_hidden'); // Cambiado
        $data = [
            'nombre'       => $this->request->getPost('nombre'),
            'apellido'     => $this->request->getPost('apellido'),
            'especialidad' => $this->request->getPost('especialidad'),
            'telefono'     => $this->request->getPost('telefono'),
        ];
        // Añadir validación aquí
        if ($modeloVeterinarios->update($id, $data)) {
            return redirect()->to('/modificacion#mod-veterinario-tab')->with('success_mod_veterinario', 'Modificación de veterinario se realizó con éxito.');
        } else {
            return redirect()->to('/modificacion#mod-veterinario-tab')->with('error_mod_veterinario', 'Error al modificar el veterinario.')->withInput();
        }
    }
}
