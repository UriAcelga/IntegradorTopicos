<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class MascotasSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create('es_ES');
        $especies = ['perro', 'gato', 'conejo', 'caballo', 'cerdo'];
        $razas = [
            'perro' => ['labrador', 'bulldog', 'beagle', 'poodle'],
            'gato' => ['persa', 'siames', 'bengala'],
            'conejo' => ['enano', 'angora', 'holandes'],
            'caballo' => ['pura sangre', 'andaluz', 'mustang'],
            'cerdo' => ['ibérico', 'duroc', 'landrace']
        ];
        for ($i = 0; $i < 55; $i++) {
            $fecha_defuncion = ($faker->boolean(30)) ? $faker->dateTimeBetween('-6 months', 'now')->format('Y-m-d H:i:s') : null;
            $especie = $faker->randomElement($especies);
            $raza = $faker->randomElement($razas[$especie]);
            $data = [
                'nombre' => $faker->word(),
                'especie' => $especie,
                'raza' => $raza,
                'edad' => $faker->numberBetween(1, 20),
                'fecha_alta' => $faker->dateTimeBetween('-2 years', '-6 months')->format('Y-m-d H:i:s'),
                'fecha_defuncion' => $fecha_defuncion,
            ];
            $this->db->table('mascotas')->insert($data);
        }
    }
}
