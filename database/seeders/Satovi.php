<?php

namespace Database\Seeders;

use App\Models\Sat;
use Illuminate\Database\Seeder;

class Satovi extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 25; $i++){
            Sat::create([
                'proizvodjacID' => $faker->numberBetween(1,5),
                'model' => $faker->firstName(),
                'polID' => $faker->numberBetween(1,2),
                'cena' => $faker->numberBetween(5000,30000)
            ]);
        }
    }
}
