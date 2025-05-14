<?php namespace App\Models;
use CodeIgniter\Model;
class Veterinarios_db extends Model

{ protected $table = 'veterinario'; 
    protected $primaryKey = 'id_veterinario';
protected $useAutoIncrement = true; protected $returnType = 'array';
protected $useSoftDeletes = false;
protected $allowedFields = ['nombre', 'apellido', 'id_veterinario', 'especialidad', 'fecha_ingreso', 'fecha_egreso'];
protected $useTimestamps = true; // Dates
protected $dateFormat = 'date';
protected $createdField = 'fecha_ingreso';
protected $updatedField = 'updated_at';
protected $deletedField = 'deleted_at';
protected $validationRules = []; // Validation
protected $validationMessages = [];
protected $skipValidation = false;
protected $cleanValidationRules = true;



public function CargarVeterinario($veterinario)
{
    $this->insert($veterinario);
}

public function TraerVeterinarioEspecifico($id_veterinario)
{
    return $this->where('id_veterinario', $id_veterinario)->findAll();

    
}

public function TraerVeterinarios()
{
    return $this->findAll();
}

public function TraerVeterinarioSelect(){
    $query = $this->db->query("SELECT id_veterinario, nombre, apellido FROM veterinario");
    $result = $query->getResultArray();
    return $result;
}
}