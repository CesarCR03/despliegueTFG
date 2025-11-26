<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class ColeccionSeeder extends Seeder
{
    public function run(): void
    {
        // CORRECCIÓN: Tabla 'coleccion' en minúscula
        DB::table('coleccion')->insert([
            ['id_coleccion' => 1, 'Nombre' => 'Winter 2021','Año' => '2021'],
            ['id_coleccion' => 2, 'Nombre' => 'Winter 2020','Año' => '2020'],
        ]);
    }
}
