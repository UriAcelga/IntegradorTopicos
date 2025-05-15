<?php namespace App\Models;
use CodeIgniter\Model;
class VeterinarioModel extends Model
{ protected $table = 'veterinario'; 
    protected $primaryKey = 'id_veterinario';
protected $useAutoIncrement = true; protected $returnType = 'array';
protected $useSoftDeletes = false;
protected $allowedFields = ['id_veterinario','nombre','apellido','especialidad','fecha_ingreso','fecha_egreso'];
protected $useTimestamps = false; // Dates
protected $dateFormat = 'datetime';
protected $createdField = 'created_at';
protected $updatedField = 'updated_at';
protected $deletedField = 'deleted_at';
protected $validationRules = []; // Validation
protected $validationMessages = [];
protected $skipValidation = false;
protected $cleanValidationRules = true;
}
?>  