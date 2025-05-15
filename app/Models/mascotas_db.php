<?php namespace App\Models;
use CodeIgniter\Model;
class Mascotas_db extends Model

{ protected $table = 'mascotas'; 
    protected $primaryKey = 'nro_registro';
protected $useAutoIncrement = true; protected $returnType = 'array';
protected $useSoftDeletes = false;
protected $allowedFields = ['nombre', 'nro_registro', 'especie', 'raza', 'edad', 'fecha_alta', 'fecha_defuncion', 'peso', 'sexo'];
protected $useTimestamps = true; // Dates
protected $dateFormat = 'date';
protected $createdField = 'fecha_alta';
protected $updatedField = '';
protected $deletedField = '';
protected $validationRules = []; // Validation
protected $validationMessages = [];
protected $skipValidation = false;
protected $cleanValidationRules = true;

public function CargarMascota($mascota)
{
    $this->insert($mascota);
}

public function TraerMascotaEspecifica($id_mascota)
{
    return $this->where('nro_registro', $id_mascota)->findAll();

    
}

public function TraerMascotas()
{
    return $this->findAll();
}

public function TraerMascotaporAmo($id_amo){
    $query = $this->db->query("SELECT m.nro_registro, m.nombre, m.raza, m.especie, m.edad, m.fecha_alta, m.peso, m.sexo FROM mascotas m INNER JOIN amo_mascota am ON am.id_mascota = m.nro_registro WHERE am.id_amo = ?", [$id_amo]);
    $result = $query->getResultArray();
    return $result;
}


public function getMascotasForSelect()
{
    return $this->select('nro_registro, nombre, especie, raza, edad, sexo, fecha_alta')
                ->orderBy('fecha_alta', 'ASC')
                ->orderBy('raza', 'ASC')
                ->orderBy('edad', 'ASC')
                ->orderBy('sexo', 'ASC')
                ->orderBy('apellido', 'ASC')
                ->orderBy('nombre', 'ASC')
                ->findAll();
}

 public function getMascotasDisponiblesParaAsociacion()
    {
        $builder = $this->db->table('mascotas m');
        $builder->select('m.nro_registro, m.nombre, m.especie, m.raza, m.fecha_alta'); // Ajusta los campos que necesites mostrar en el select

        // Subconsulta para encontrar las mascotas que SÍ tienen una asociación activa (es_actual = 1)
        // Es importante usar un alias diferente para la tabla en la subconsulta si es la misma
        // que la consulta principal, aunque aquí 'amo_mascota' es diferente de 'mascotas'.
        $subQuery = $this->db->table('amo_mascota am_active')
                             ->select('am_active.id_mascota')
                             ->where('am_active.es_actual', 1);

        // Condición 1: Mascotas cuyo nro_registro NO ESTÉ en la lista de mascotas con asociación activa
        $builder->whereNotIn('m.nro_registro', $subQuery);
        
        // Condición 2: Mascotas que NO tengan fecha de defunción (están vivas)
        $builder->where('m.fecha_defuncion IS NULL');
        
        $builder->orderBy('m.nombre', 'ASC');

        return $builder->get()->getResultArray();
    }

}