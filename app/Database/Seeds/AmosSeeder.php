<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class AmosSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create('es_ES');
        for ($i = 0; $i < 30; $i++) {
            $data = [
                'nombre' => $faker->firstName(),
                'apellido' => $faker->lastName(),
                'telefono' => $faker->phoneNumber(),
                'fecha_alta' => $faker->dateTimeBetween('-2 years', 'now')->format('Y-m-d H:i:s'), 
            ];
            $this->db->table('amos')->insert($data);
        }
    }
}
