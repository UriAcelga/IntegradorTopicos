<?php namespace App\Models;
use CodeIgniter\Model;
class Amos_mascotas_db extends Model

{ protected $table = 'amo_mascota'; 
//protected $primaryKey = '';
protected $useAutoIncrement = true; protected $returnType = 'array';
protected $useSoftDeletes = false;
protected $allowedFields = ['id_amo', 'id_mascota', 'es_actual'];
protected $useTimestamps = false; // Dates
protected $dateFormat = 'datetime';
protected $createdField = 'created_at';
protected $updatedField = 'updated_at';
protected $deletedField = 'deleted_at';
protected $validationRules = []; // Validation
protected $validationMessages = [];
protected $skipValidation = false;
protected $cleanValidationRules = true;


public function CargarAmoMascota($data){
        // Usa Query Builder para evitar problemas con clave compuesta
        $db = \Config\Database::connect();
        $builder = $db->table($this->table);
        $result = $builder->insert($data);
        return $result ? true : false;
}

public function TraerAmoMascotaEspecifico($id_amo, $id_mascota)
{
    return $this->where('id_amo', $id_amo)->where('id_mascota', $id_mascota)->findAll();
}

public function getMascotasForSelect_porAmo($id_amo)
{
    return $this->select('m.nro_registro, m.nombre, m.especie, m.raza, m.edad, m.sexo')
                ->join('mascotas m', 'm.nro_registro = amo_mascota.id_mascota')
                ->where('amo_mascota.id_amo', $id_amo)
                ->orderBy('m.especie', 'ASC')
                ->orderBy('m.raza', 'ASC')
                ->orderBy('m.edad', 'ASC')
                ->orderBy('m.sexo', 'ASC')
                ->findAll();
}

 public function desactivarAsociacionesActivasAnteriores(int $idMascota): bool
    {
        // Usamos el Query Builder del modelo.
        // Esto buscará filas donde id_mascota coincida Y es_actual sea 1.
        // Luego, establecerá es_actual a 0 para esas filas.
        return $this->where('id_mascota', $idMascota)
                    ->where('es_actual', 1) // Solo nos interesan las que están actualmente activas
                    ->set(['es_actual' => 0])
                    ->update();

        // El método update() sin un ID en el segundo parámetro actualizará
        // todas las filas que coincidan con las condiciones del 'where'.
        // Devuelve true en caso de éxito, false en caso de error.
        // Si no hay filas que cumplan la condición, no hace nada y generalmente devuelve true (ningún error).
    }
}