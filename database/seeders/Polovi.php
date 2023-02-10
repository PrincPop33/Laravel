<?php

namespace Database\Seeders;

use App\Models\Pol;
use Illuminate\Database\Seeder;

class Polovi extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pol::create([
            'pol' => 'Zenski'
        ]);

        Pol::create([
            'pol' => 'Muski'
        ]);

    }
}
