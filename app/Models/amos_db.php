<?php namespace App\Models;
use CodeIgniter\Model;
class Amos_db extends Model

{ protected $table = 'amos'; 
    protected $primaryKey = 'id_amo';
protected $useAutoIncrement = true; protected $returnType = 'array';
protected $useSoftDeletes = false;
protected $allowedFields = ['nombre', 'apellido', 'telefono', 'id_amo', 'fecha_alta', 'direccion_amo'];
protected $useTimestamps = true; // Dates
protected $dateFormat = 'date';
protected $createdField = 'fecha_alta';
protected $updatedField = '';
protected $deletedField = '';
protected $validationRules = []; // Validation
protected $validationMessages = [];
protected $skipValidation = false;
protected $cleanValidationRules = true;



public function CargarAmo($amo)
{
    $this->insert($amo);
}

public function TraerAmoEspecifico($id_amo)
{
    return $this->where('id_amo', $id_amo)->findAll();

    
}

public function TraerAmos()
{
    return $this->findAll();
}

public function TraerAmoporMascota($id_mascota){
    $query = $this->db->query("SELECT a.id_amo, a.nombre, a.apellido, a.telefono, a.fecha_alta FROM amos a INNER JOIN amo_mascota am ON am.id_amo = a.id_amo WHERE am.id_mascota = ?", [$id_mascota]);
    $result = $query->getResultArray();
    return $result;
}

// Alternativa en app/Models/Amos_db.php
public function getAmosForSelect()
{
    return $this->select('id_amo, nombre, apellido')
                ->orderBy('apellido', 'ASC')
                ->orderBy('nombre', 'ASC')
                ->findAll();
}
}