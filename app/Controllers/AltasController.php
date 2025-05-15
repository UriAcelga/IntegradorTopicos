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
           helper(['form', 'url', 'text']); 
        $session = \Config\Services::session();
    }

    public function index()
    {
        $modeloAmo = new Amos_db();
        $modeloMascota = new Mascotas_db(); // Para obtener las mascotas disponibles

        $listaDeAmos = $modeloAmo->getAmosForSelect();
        $listaDeMascotasDisponibles = $modeloMascota->getMascotasDisponiblesParaAsociacion();

           $dataParaVista = [
            'titulo_pagina' => 'Alta de Registros',
            'amos_para_select' => $listaDeAmos,
            'mascotas_disponibles_para_select' => $listaDeMascotasDisponibles,
            
            // Recuperar objetos de validación específicos de la sesión flash
            'validation_asociacion' => session()->getFlashdata('validation_asociacion'),
            'validation_veterinario' => session()->getFlashdata('validation_veterinario'),
            'validation_amo' => session()->getFlashdata('validation_amo'),
            'validation_mascota' => session()->getFlashdata('validation_mascota'),
            
            // Recuperar la pestaña que debería estar activa
            'active_tab' => session()->getFlashdata('active_tab'),

            // Para repoblar campos (old input)
            // CodeIgniter 4 maneja 'old input' automáticamente con withInput(),
            // por lo que no siempre es necesario pasarlos explícitamente así para set_value()
            // 'old_selected_amo' => old('select_amo'), // old() helper funciona si withInput() se usó
            // 'old_selected_mascota' => old('id_mascota_a_asociar')
        ];

        // Si no hay una pestaña activa definida (ej. primera carga), se puede definir una por defecto
        if (empty($dataParaVista['active_tab'])) {
            $dataParaVista['active_tab'] = 'mascota-amo'; // O la pestaña que quieras por defecto
        }

        return view('altas', $dataParaVista);
    }
    
    public function guardarAsociacion()
    {
        $rules = [
            'select_amo'           => 'required|numeric|is_not_unique[amos.id_amo]',
            'id_mascota_a_asociar' => 'required|numeric|is_not_unique[mascotas.nro_registro]'
        ];
        // Mensajes personalizados para la asociación
        $messages = [ 
            'select_amo' => [
                'required' => 'Debe seleccionar un amo.',
                'is_not_unique' => 'El amo seleccionado no es válido.'
            ],
            'id_mascota_a_asociar' => [
                'required' => 'Debe seleccionar una mascota disponible.',
                'is_not_unique' => 'La mascota seleccionada no es válida.'
            ]
        ];

        if ($this->validate($rules, $messages)) { // Pasando los mensajes personalizados
            $modeloAmoMascota = new Amos_mascotas_db();
            $dataAsociacion = [
                'id_amo'     => $this->request->getPost('select_amo'),
                'id_mascota' => $this->request->getPost('id_mascota_a_asociar'),
                'es_actual'  => 1 
            ];

            if ($modeloAmoMascota->CargarAmoMascota($dataAsociacion)) { 
                return redirect()->to('/altas#mascota-amo-tab')->with('success', 'La asociación Amo-Mascota ha sido exitosa.');
            } else {
                return redirect()->to('/altas#mascota-amo-tab')
                                 ->with('error', 'Error al crear la asociación Amo-Mascota.')
                                 ->withInput();
            }
        } else {
            return redirect()->to('/altas#mascota-amo-tab')
                             ->withInput()
                             ->with('validation_asociacion', $this->validator) 
                             ->with('active_tab', 'mascota-amo'); 
        }
    }

    public function alta_amo()
    {
        $rules = [
            'nombre'    => 'required|min_length[4]|max_length[50]',
            'apellido'  => 'required|min_length[4]|max_length[50]',
            'telefono'  => 'required|numeric|min_length[10]|max_length[15]',
            'direccion' => 'required|min_length[4]|max_length[50]',
        ];
        // Mensajes personalizados para alta de amo
        $messages = [
            'nombre' => [
                'required'   => 'El campo nombre es obligatorio',
                'min_length' => 'El nombre debe tener al menos 4 caracteres',
                'max_length' => 'El nombre no puede tener más de 50 caracteres',
            ],
            'apellido' => [
                'required'   => 'El campo apellido es obligatorio',
                'min_length' => 'El apellido debe tener al menos 4 caracteres',
                'max_length' => 'El apellido no puede tener más de 50 caracteres',
            ],
            'telefono' => [
                'required'   => 'El campo telefono es obligatorio',
                'numeric'    => 'El campo telefono debe ser numérico',
                'min_length' => 'El telefono debe tener al menos 10 numeros',    
                'max_length' => 'El telefono no puede tener más de 15 numeros',
            ],
            'direccion' => [
                'required'   => 'El campo direccion es obligatorio',
                'min_length' => 'La direccion debe tener al menos 4 caracteres',
                'max_length' => 'La direccion no puede tener más de 50 caracteres',
            ],
        ];

        if ($this->validate($rules, $messages)) { // Pasando los mensajes personalizados
            $data = [
                'nombre'    => $this->request->getPost('nombre'),
                'apellido'  => $this->request->getPost('apellido'),
                'telefono'  => $this->request->getPost('telefono'),
                'direccion' => $this->request->getPost('direccion')
            ];
            $amos_db = new Amos_db();
            if ($amos_db->CargarAmo($data)) { 
                return redirect()->to('/altas#amo-tab')->with('success_amo', 'El Amo ha sido registrado exitosamente.');
            } else {
                return redirect()->to('/altas#amo-tab')->with('error_amo', 'Error al registrar el Amo.');
            }
        } else {
            return redirect()->to('/altas#amo-tab')
                             ->withInput()
                             ->with('validation_amo', $this->validator)
                             ->with('active_tab', 'amo');
        }
    }

    public function alta_mascota()
    {
        $rules = [
            'nombre'  => 'required|min_length[4]|max_length[50]',
            'raza'    => 'required|min_length[4]|max_length[50]',
            'edad'    => 'permit_empty|numeric|max_length[3]',
            'peso'    => 'permit_empty|decimal|max_length[6]', 
            'especie' => 'required',
            'sexo'    => 'required'
        ];
         // Mensajes personalizados para alta de mascota
        $messages = [
            'nombre' => [
                'required'   => 'El campo nombre es obligatorio',
                'min_length' => 'El nombre debe tener al menos 4 caracteres',
                'max_length' => 'El nombre no puede tener más de 50 caracteres',
            ],
            'raza' => [
                'required'   => 'El campo raza es obligatorio',
                'min_length' => 'La raza debe tener al menos 4 caracteres',
                'max_length' => 'La raza no puede tener más de 50 caracteres',
            ],
            'edad' => [
                // 'required'   => 'El campo edad es obligatorio', // Si es opcional, quitar required
                'numeric'    => 'El campo edad debe ser numérico',
                // 'min_length' => 'La edad debe tener al menos 1 numero',    
                'max_length' => 'La edad no puede tener más de 3 numeros',
            ],
            'peso' => [
                // 'required'   => 'El campo peso es obligatorio', // Si es opcional, quitar required
                'decimal'    => 'El campo peso debe ser numérico o decimal (ej: 10.5)',
                // 'min_length' => 'El peso debe tener al menos 1 numero',    
                'max_length' => 'El peso no puede tener más de 6 caracteres (ej: 123.45)',
            ],
            'especie' => [
                'required' => 'El campo especie es obligatorio',
            ],
            'sexo' => [
                'required' => 'El campo sexo es obligatorio',
            ],
        ];

        if ($this->validate($rules, $messages)) { // Pasando los mensajes personalizados
            $data = [
                'nombre'  => $this->request->getPost('nombre'),
                'raza'    => $this->request->getPost('raza'),
                'especie' => $this->request->getPost('especie'),
                'edad'    => $this->request->getPost('edad') ?: null, 
                'peso'    => $this->request->getPost('peso') ?: null, 
                'sexo'    => $this->request->getPost('sexo')
            ];
            $mascotas_db = new Mascotas_db();
            if ($mascotas_db->CargarMascota($data)) { 
                return redirect()->to('/altas#mascota-tab')->with('success_mascota', 'La Mascota ha sido registrada exitosamente.');
            } else {
                return redirect()->to('/altas#mascota-tab')->with('error_mascota', 'Error al registrar la Mascota.');
            }
        } else {
            return redirect()->to('/altas#mascota-tab')
                             ->withInput()
                             ->with('validation_mascota', $this->validator)
                             ->with('active_tab', 'mascota');
        }
    }

    public function alta_veterinario()
    {
        $rules = [
            'nombre'       => 'required|min_length[4]|max_length[50]', 
            'apellido'     => 'required|min_length[4]|max_length[50]',
            'telefono'     => 'required|numeric|min_length[10]|max_length[15]',
            'especialidad' => 'required'
        ];
        // Mensajes personalizados para alta de veterinario
        $messages = [
            'nombre' => [
                'required'   => 'El campo nombre es obligatorio',
                'min_length' => 'El nombre debe tener al menos 4 caracteres',
                'max_length' => 'El nombre no puede tener más de 50 caracteres',
            ],
            'telefono' => [
                'required'   => 'El campo telefono es obligatorio',
                'numeric'    => 'El campo telefono debe ser numérico',
                'min_length' => 'El telefono debe tener al menos 10 numeros',    
                'max_length' => 'El telefono no puede tener más de 15 numeros',
            ],
            'apellido' => [
                'required'   => 'El campo apellido es obligatorio',
                'min_length' => 'El apellido debe tener al menos 4 caracteres',
                'max_length' => 'El apellido no puede tener más de 50 caracteres',
            ],
            'especialidad' => [
                'required' => 'El campo especialidad es obligatorio',
            ],
        ];

        if ($this->validate($rules, $messages)) { // Pasando los mensajes personalizados
            $data = [
                'nombre'       => $this->request->getPost('nombre'), 
                'apellido'     => $this->request->getPost('apellido'),
                'especialidad' => $this->request->getPost('especialidad'),
                'telefono'     => $this->request->getPost('telefono')
            ];
            $veterinarios_db = new Veterinarios_db();
            if ($veterinarios_db->CargarVeterinario($data)) {
                return redirect()->to('/altas#veterinario-tab')->with('success_veterinario', 'El Veterinario ha sido registrado exitosamente.');
            } else {
                return redirect()->to('/altas#veterinario-tab')->with('error_veterinario', 'Error al registrar el Veterinario.');
            }
        } else {
            return redirect()->to('/altas#veterinario-tab')
                             ->withInput()
                             ->with('validation_veterinario', $this->validator)
                             ->with('active_tab', 'veterinario');
        }
    }
}
