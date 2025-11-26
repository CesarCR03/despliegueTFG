<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    public function run(): void
    {
        // CORRECCIÓN: Tabla 'categoria' en minúscula
        DB::table('categoria')->insert([
            ['id_categoria' => 1, 'Nombre' => 'Superiores'],
            ['id_categoria' => 2, 'Nombre' => 'Pantalones'],
            ['id_categoria' => 3, 'Nombre' => 'Accesorios'],
        ]);
    }
}
