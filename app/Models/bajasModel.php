<?php namespace App\Models;
use CodeIgniter\Model;
class BajasModel extends Model
{ protected $table = 'bajas'; 
    protected $primaryKey = 'id_baja';
protected $useAutoIncrement = true; protected $returnType = 'array';
protected $useSoftDeletes = false;
protected $allowedFields = ['fecha_baja','id_mascota','motivo'];
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