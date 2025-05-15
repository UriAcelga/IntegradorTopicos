<?php

namespace App\Controllers;

use App\Models\Amos_mascotas_db;
use App\Models\Amos_db;
use App\Models\Mascotas_db;
use App\Models\Veterinarios_db;
use App\Models\BajasModel; // Asegúrate que este modelo exista y esté configurado si lo usas.

class BajasController extends BaseController
{
    public function __construct(){
        helper(['form', 'url', 'text']); // Añadido text helper para esc()
    }

    public function index()
    {
        $amoModel = new Amos_db();
        $veterinariosModel = new Veterinarios_db();
        
        // Amos que tienen al menos una mascota activa
        $amos = $amoModel->distinct()
                         ->select('amos.*')
                         ->join('amo_mascota', 'amos.id_amo = amo_mascota.id_amo') 
                         ->where('amo_mascota.es_actual', 1)
                         ->orderBy('amos.apellido', 'ASC')->orderBy('amos.nombre', 'ASC') // Opcional: ordenar
                         ->findAll();
        
        // Veterinarios activos (sin fecha de egreso)
        $veterinarios = $veterinariosModel->where('fecha_egreso IS NULL', null) // Mejor forma de chequear NULL
                                       ->orderBy('apellido', 'ASC')->orderBy('nombre', 'ASC') // Opcional: ordenar
                                       ->findAll();
        $data = [
            'veterinarios' => $veterinarios,
            'amos' => $amos,
            'active_tab' => session()->getFlashdata('active_tab') ?? 'baja-mascota-amo', // Para mantener la pestaña activa
        ];
        
        return view('bajas', $data);
    }

    public function eleccion(){
        $amoId = $this->request->getPost('amo');

        // Validar que amoId se recibió
        if (empty($amoId)) {
            return redirect()->to('/bajas#baja-mascota-amo-tab')->with('error', 'Debe seleccionar un amo primero.');
        }

        $mascotasModel = new Mascotas_db();
        $amoModel = new Amos_db();
        $veterinariosModel = new Veterinarios_db();
        
        $amos = $amoModel->distinct()
                         ->select('amos.*')
                         ->join('amo_mascota', 'amos.id_amo = amo_mascota.id_amo') 
                         ->where('amo_mascota.es_actual', 1)
                         ->orderBy('amos.apellido', 'ASC')->orderBy('amos.nombre', 'ASC')
                         ->findAll();
        
        $veterinarios = $veterinariosModel->where('fecha_egreso IS NULL', null)->orderBy('apellido', 'ASC')->orderBy('nombre', 'ASC')->findAll();
        
        $mascotas = $mascotasModel->select('mascotas.*')
                                  ->join('amo_mascota', 'mascotas.nro_registro = amo_mascota.id_mascota')
                                  ->where('amo_mascota.id_amo', $amoId)
                                  ->where('amo_mascota.es_actual', 1)
                                  ->orderBy('mascotas.nombre', 'ASC')
                                  ->findAll();
        $data = [
            'mascotas' => $mascotas,
            'amoId' => $amoId,  
            'amos' => $amos,
            'veterinarios' => $veterinarios,
            'active_tab' => 'baja-mascota-amo', // Mantener esta pestaña activa
        ];
        return view('bajas', $data);
    }

    public function baja(){
        $amoId = $this->request->getPost('amo');
        $mascotaId = $this->request->getPost('mascota');
        $motivo = $this->request->getPost('motivo-baja');

        // Validación básica de los datos recibidos
        if (empty($amoId) || empty($mascotaId) || empty($motivo)) {
            log_message('error', 'Intento de baja de relación con datos incompletos. AmoID: '.$amoId.', MascotaID: '.$mascotaId.', Motivo: '.$motivo);
            return redirect()->to('/bajas#baja-mascota-amo-tab')->withInput()->with('error', 'Datos incompletos para la baja de relación.');
        }

        $fechaActual = date('Y-m-d');
        log_message('debug', 'Intentando actualizar relacion para Amo ID: ' . $amoId . ' y Mascota ID: ' . $mascotaId . ' con motivo: ' . $motivo);

        $db = \Config\Database::connect();
        $db->transStart(); // Iniciar transacción

        // 1. Actualizar fecha de defunción si es el motivo
        if ($motivo === "fallecimiento") {
            $mascotasModel = new Mascotas_db();
            $dataf = ['fecha_defuncion' => $fechaActual];
            if (!$mascotasModel->update($mascotaId, $dataf)) {
                $db->transRollback();
                log_message('error', 'Error al actualizar fecha_defuncion para mascota ID: '.$mascotaId.'. Errores: '.print_r($mascotasModel->errors(), true));
                return redirect()->to('/bajas#baja-mascota-amo-tab')->withInput()->with('error', 'Error al actualizar datos de la mascota.');
            }
        }

        // 2. Insertar en la tabla de bajas
        $bajaModel = new BajasModel(); // Renombrada variable para evitar conflicto
        $datab = [
            'fecha_baja' => $fechaActual,
            'id_mascota' => $mascotaId,
            'motivo' => $motivo,
        ];
        if (!$bajaModel->insert($datab)) {
            $db->transRollback();
            log_message('error', 'Error al insertar en tabla bajas para mascota ID: '.$mascotaId.'. Errores: '.print_r($bajaModel->errors(), true));
            return redirect()->to('/bajas#baja-mascota-amo-tab')->withInput()->with('error', 'Error al registrar la baja.');
        }

        // 3. Actualizar la tabla amo_mascota
        $builder = $db->table('amo_mascota');
        $builder->where('id_amo', $amoId)
                ->where('id_mascota', $mascotaId)
                ->where('es_actual', 1); // Asegurarse de que solo se actualiza una relación activa

        $updateResult = $builder->update(['es_actual' => 0]); // update() devuelve true/false o affected_rows según driver

        // Verificar si la actualización fue exitosa (affected_rows es más fiable)
        if ($db->affectedRows() > 0) {
            $db->transComplete();
            if ($db->transStatus() === false) {
                log_message('error', 'Falló la transacción al dar de baja la relación. Amo ID: ' . $amoId . ', Mascota ID: ' . $mascotaId);
                return redirect()->to('/bajas#baja-mascota-amo-tab')->withInput()->with('error', 'Error en la transacción al dar de baja la relación.');
            }
            return redirect()->to('/bajas#baja-mascota-amo-tab')->with('success', 'Baja de relación realizada con éxito.');
        } else {
            $db->transRollback();
            log_message('debug', 'No se afectaron filas al intentar dar de baja la relación amo_mascota. Amo ID: ' . $amoId . ', Mascota ID: ' . $mascotaId . '. ¿Ya estaba dada de baja o los IDs son incorrectos?');
            return redirect()->to('/bajas#baja-mascota-amo-tab')->withInput()->with('error', 'No se pudo actualizar la relación. Verifique los datos o puede que ya estuviera dada de baja.');
        }
    }
    
    public function bajaVeterinario(){
        $veterinariosModel = new Veterinarios_db(); // Renombrada la instancia
        $id_veterinario = $this->request->getPost('veterinario_id'); // Corregido el nombre del campo

        // Validación básica
        if (empty($id_veterinario)) {
            log_message('error', 'Intento de baja de veterinario sin ID.');
            return redirect()->to('/bajas#baja-veterinario-tab')->with('error', 'Debe seleccionar un veterinario.');
        }

        $fechaActual = date('Y-m-d');
        $data = [
            'fecha_egreso' => $fechaActual,
        ];

        // Usar el método update del modelo. Este método espera la clave primaria como primer argumento.
        if ($veterinariosModel->update($id_veterinario, $data)) {
            // Verificar si realmente se afectó alguna fila, ya que update() puede devolver true incluso si no hay coincidencia.
            if ($veterinariosModel->db->affectedRows() > 0) {
                 return redirect()->to('/bajas#baja-veterinario-tab')->with('success', 'Baja de veterinario realizada con éxito.');
            } else {
                log_message('debug', 'No se afectaron filas al intentar dar de baja al veterinario ID: '.$id_veterinario.'. ¿ID incorrecto o ya dado de baja?');
                return redirect()->to('/bajas#baja-veterinario-tab')->with('error', 'No se pudo dar de baja al veterinario. Verifique el ID o puede que ya estuviera dado de baja.');
            }
        } else {
            log_message('error', 'Error del modelo al dar de baja al veterinario ID: '.$id_veterinario.'. Errores: '.print_r($veterinariosModel->errors(), true));
            return redirect()->to('/bajas#baja-veterinario-tab')->with('error', 'Error al procesar la baja del veterinario.');
        }
    }
}
