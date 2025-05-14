<?php

namespace App\Controllers;
use App\Models\Amos_mascotas_db;
use App\Models\Amos_db;
use App\Models\Mascotas_db;
use App\Models\Veterinarios_db;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class AltasController extends BaseController
{
     public function __construct()
    {
        helper(['form', 'url']);
        $session = \Config\Services::session();
    }

    public function index()
    {
        $modeloAmo = new Amos_db();
        $modeloMascota = new Mascotas_db(); // Para obtener las mascotas disponibles

        $listaDeAmos = $modeloAmo->getAmosForSelect();
        $listaDeMascotasDisponibles = $modeloMascota->getMascotasDisponiblesParaAsociacion();

        $dataParaVista = [
            'titulo_pagina' => 'Nueva Asociación Amo-Mascota',
            'amos_para_select' => $listaDeAmos,
            'mascotas_disponibles_para_select' => $listaDeMascotasDisponibles,
            'validation' => session()->getFlashdata('validation'), // Para mostrar errores si vienen de un redirect
            // Para repoblar selects si la validación falló en guardarAsociacion:
            'old_selected_amo' => old('select_amo'),
            'old_selected_mascota' => old('id_mascota_a_asociar')
        ];

        return view('altas', $dataParaVista);
    
    }
    
       public function guardarAsociacion() // Maneja POST /altas/guardar_asociacion
    {
        $validation = \Config\Services::validation();
        $rules = [
            'select_amo'           => 'required|numeric|is_not_unique[amos.id_amo]',
            'id_mascota_a_asociar' => 'required|numeric|is_not_unique[mascotas.nro_registro]'
            // Podrías añadir una regla de validación personalizada aquí para verificar
            // que la mascota seleccionada SIGUE disponible, como una doble verificación.
        ];

        $messages = [ // Mensajes personalizados (opcional)
            'select_amo' => [
                'required' => 'Debe seleccionar un amo.',
                'is_not_unique' => 'El amo seleccionado no es válido.'
            ],
            'id_mascota_a_asociar' => [
                'required' => 'Debe seleccionar una mascota disponible.',
                'is_not_unique' => 'La mascota seleccionada no es válida.'
            ]
        ];

        if ($this->validate($rules, $messages)) {
            $modeloAmoMascota = new Amos_mascotas_db(); // Modelo para la tabla 'amo_mascota'

            $idAmo = $this->request->getPost('select_amo');
            $idMascota = $this->request->getPost('id_mascota_a_asociar');

            // Lógica antes de insertar (si es necesaria):
            // Por ejemplo, si una mascota sólo puede tener UNA asociación activa (es_actual=1),
            // aquí deberías poner cualquier otra asociación activa de ESA MASCOTA a es_actual=0.
            // Esto debe hacerse en una transacción para asegurar la integridad de los datos.
            // Ejemplo (requiere que el modelo Amos_mascotas_db esté configurado para la tabla 'amo_mascota'):
            /*
            $this->db->transStart();
            $modeloAmoMascota->where('id_mascota', $idMascota)
                             ->set(['es_actual' => 0])
                             ->update();
            */

            $dataAsociacion = [
                'id_amo'     => $idAmo,
                'id_mascota' => $idMascota,
                'es_actual'  => 1 // Nueva asociación siempre es actual
            ];

            if ($modeloAmoMascota->CargarAmoMascota($dataAsociacion)) {
                // Si usaste transacción: $this->db->transComplete();
                // if ($this->db->transStatus() === false) { /* Manejar error de transacción */ }
                return redirect()->to('/altas')->with('success', 'La asociación Amo-Mascota ha sido exitosa.');
            } else {
                // Si usaste transacción: $this->db->transRollback();
                return redirect()->to('/altas')
                                 ->with('error', 'Error al crear la asociación Amo-Mascota. Intente nuevamente.')
                                 ->withInput(); // Para repoblar el formulario
            }
        } else {
            // Validación falló
            return redirect()->to('/altas')
                             ->withInput() // 'Flashea' los datos del POST actual para repoblar el formulario
                             ->with('validation', $this->validator); // 'Flashea' los errores de validación
        }
    
       
    }

    public function alta_amo(){
    $validation = \Config\Services::validation();
        // Reglas y mensajes igual que en postGuardar_tarea()

        // Reglas de validación
        $rules = [
            'nombre' => 'required|min_length[4]|max_length[50]',
            'apellido' => 'required|min_length[4] |max_length[50]',
            'telefono' => 'required|numeric|min_length[10]|max_length[15]',
            'direccion' => 'required|min_length[4]|max_length[50]',
        ];

        // Mensajes personalizados
        $messages = [
            'nombre' => [
                'required' => 'El campo nombre es obligatorio',
                'min_length' => 'El nombre debe tener al menos 4 caracteres',
                'max_length' => 'El nombre no puede tener más de 50 caracteres',
            ],
            'apellido' => [
                'required' => 'El campo apellido es obligatorio',
                'min_length' => 'El apellido debe tener al menos 4 caracteres',
                'max_length' => 'El apellido no puede tener más de 50 caracteres',
            ],
            'telefono' => [
                'required' => 'El campo telefono es obligatorio',
                'numeric' => 'El campo telefono debe ser numérico',
                'min_length' => 'El telefono debe tener al menos 10 numeros',    
                'max_length' => 'El telefono no puede tener más de 15 numeros',
            ],
            'direccion' => [
                 'required' => 'El campo direccion es obligatorio',
                'min_length' => 'La direccion debe tener al menos 4 caracteres',
                'max_length' => 'La direccion no puede tener más de 50 caracteres',
            ],

        ];

        // Mostrar Mensajes de error
        if (!$this->validate($rules, $messages)) {
            return redirect()->to('/altas')->withInput()->with('errors', $validation->getErrors());
        }
        $data = [
            'nombre' => $this->request->getPost('nombre'),
            'apellido' => $this->request->getPost('apellido'),
            'telefono' => $this->request->getPost('telefono'),
            'direccion' => $this->request->getPost('direccion')
        ];
        $amos_db = new Amos_db();
        if ($amos_db->CargarAmo($data)) {
            return redirect()->to('/altas')->with('success', 'El Amo ha sido registrado exitosamente.');
        } else {
            return redirect()->to('/altas')->with('error', 'Error al registrar el Amo.');
        }
    }

    public function alta_mascota(){
        $validation = \Config\Services::validation();
        // Reglas y mensajes igual que en postGuardar_tarea()

        // Reglas de validación
        $rules = [
            'nombre' => 'required|min_length[4]|max_length[50]',
            'raza' => 'required|min_length[4]|max_length[50]',
            'edad' => 'required|numeric|min_length[1]|max_length[3]',
            'peso' => 'required|numeric|min_length[1]|max_length[3]',
            'especie' => 'required',
            'sexo' => 'required'
        ];

        // Mensajes personalizados
        $messages = [
            'nombre' => [
                'required' => 'El campo nombre es obligatorio',
                'min_length' => 'El nombre debe tener al menos 4 caracteres',
                'max_length' => 'El nombre no puede tener más de 50 caracteres',
            ],
            'raza' => [
                'required' => 'El campo raza es obligatorio',
                'min_length' => 'La raza debe tener al menos 4 caracteres',
                'max_length' => 'La raza no puede tener más de 50 caracteres',
            ],
            'edad' => [
                'required' => 'El campo edad es obligatorio',
                'numeric' => 'El campo edad debe ser numérico',
                'min_length' => 'La edad debe tener al menos 1 numero',    
                'max_length' => 'La edad no puede tener más de 3 numeros',
            ],
            'peso' => [
                 'required' => 'El campo peso es obligatorio',
                'numeric' => 'El campo peso debe ser numérico',
                'min_length' => 'El peso debe tener al menos 1 numero',    
                'max_length' => 'El peso no puede tener más de 3 numeros',
            ],
            'especie' => [
                'required' => 'El campo especie es obligatorio',
            ],
            'sexo' => [
                'required' => 'El campo sexo es obligatorio',
            ],

        ];

        // Mostrar Mensajes de error
        if (!$this->validate($rules, $messages)) {
            return redirect()->to('/altas')->withInput()->with('errors', $validation->getErrors());
        }
        $data = [
            'nombre' => $this->request->getPost('nombre'),
            'raza' => $this->request->getPost('raza'),
            'especie' => $this->request->getPost('especie'),
            'edad' => $this->request->getPost('edad'),
            'peso' => $this->request->getPost('peso'),
            'sexo' => $this->request->getPost('sexo')
        ];
        $mascotas_db = new Mascotas_db();
        if ($mascotas_db->CargarMascota($data)) {
            return redirect()->to('/altas')->with('success', 'La Mascota ha sido registrada exitosamente.');
        } else {
            return redirect()->to('/altas')->with('error', 'Error al registrar la Mascota.');
        }

    }

    public function alta_veterinario(){
        $validation = \Config\Services::validation();
        // Reglas y mensajes igual que en postGuardar_tarea()

        // Reglas de validación
        $rules = [
            'nombre' => 'required|min_length[4]|max_length[50]',
            'telefono' => 'required|numeric|min_length[10]|max_length[15]',
            'especialidad' => 'required'];

        // Mensajes personalizados
        $messages = [
            'nombre' => [
                'required' => 'El campo nombre es obligatorio',
                'min_length' => 'El nombre debe tener al menos 4 caracteres',
                'max_length' => 'El nombre no puede tener más de 50 caracteres',
            ],
            'telefono' => [
                'required' => 'El campo telefono es obligatorio',
                'numeric' => 'El campo telefono debe ser numérico',
                'min_length' => 'El telefono debe tener al menos 10 numeros',    
                'max_length' => 'El telefono no puede tener más de 15 numeros',
            ],
            'especialidad' => [
                'required' => 'El campo especialidad es obligatorio',
            ],
        ];

        // Mostrar Mensajes de error
        if (!$this->validate($rules, $messages)) {
            return redirect()->to('/altas')->withInput()->with('errors', $validation->getErrors());
        }
        $data = [
            'nombre' => $this->request->getPost('nombre'),
            'especialidad' => $this->request->getPost('especialidad'),
            'telefono' => $this->request->getPost('telefono')
        ];
        $veterinarios_db = new Veterinarios_db();
        if ($veterinarios_db->CargarVeterinario($data)) {
            return redirect()->to('/altas')->with('success', 'El Veterinario ha sido registrado exitosamente.');
        } else {
            return redirect()->to('/altas')->with('error', 'Error al registrar el Veterinario.');
        }
        
    }

   
}
