<?php

namespace App\Database\Seeds\Basic;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class VeterinariosSeeder extends Seeder
{
    public function run()
    {

        $faker = Factory::create('es_ES');
        $especialidades = ['interno', 'cirugía', 'dermatología', 'cardiología', 'oftalmología', 'oncología'];
        $fecha_egreso = ($faker->boolean(30)) ? $faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d H:i:s') : null;
        for ($i = 0; $i < 15; $i++) {
            $data = [
                'nombre' => $faker->firstName(),
                'apellido' => $faker->lastName(),
                'especialidad' => $faker->randomElement($especialidades),
                'fecha_ingreso' => $faker->dateTimeBetween('-3 years', '-1 year')->format('Y-m-d H:i:s'),
                'fecha_egreso' => $fecha_egreso
            ];
            $this->db->table('veterinario')->insert($data);
        }
    }
}
