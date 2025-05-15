<?php namespace App\Models;
use CodeIgniter\Model;
class RelacionModel extends Model
{ protected $table = 'amo_mascota'; 
    protected $primaryKey = 'id_amo';
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
}
?>  