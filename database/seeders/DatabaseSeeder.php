<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
     { 
         $this->call(Proizvodjaci::class);
        $this->call(Polovi::class);
        $this->call(Satovi::class);
        $this->call(Users::class); 
    } 
}
