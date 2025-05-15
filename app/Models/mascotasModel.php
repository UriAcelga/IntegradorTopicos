<?php namespace App\Models;
use CodeIgniter\Model;
class MascotasModel extends Model
{ protected $table = 'mascotas'; 
    protected $primaryKey = 'nro_registro';
protected $useAutoIncrement = true; protected $returnType = 'array';
protected $useSoftDeletes = false;
protected $allowedFields = ['nro_registro','nombre','especie','raza','fecha_alta','fecha_defuncion'];
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