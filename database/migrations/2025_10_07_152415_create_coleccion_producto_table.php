<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('coleccion_producto', function (Blueprint $table) {
            // Necesitas definir las claves foráneas aquí
            $table->unsignedInteger('id_coleccion');
            $table->unsignedInteger('id_producto');

            // Definir las relaciones
            // NOTA: Asegúrate si tu tabla es 'coleccion' o 'Coleccion' (ver punto 3)
            $table->foreign('id_coleccion')->references('id_coleccion')->on('coleccion')->onDelete('cascade');
            $table->foreign('id_producto')->references('id_producto')->on('producto')->onDelete('cascade');

            // Clave primaria compuesta para evitar duplicados
            $table->primary(['id_coleccion', 'id_producto']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coleccion_producto');
    }
};
