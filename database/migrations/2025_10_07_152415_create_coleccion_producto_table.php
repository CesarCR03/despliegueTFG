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
        // Comprobamos si la tabla YA existe antes de intentar crearla
        if (!Schema::hasTable('coleccion_producto')) {
            Schema::create('coleccion_producto', function (Blueprint $table) {
                $table->unsignedInteger('id_coleccion');
                $table->unsignedInteger('id_producto');

                // Definir las relaciones (Asegúrate que los nombres coinciden con tus tablas 'coleccion' y 'producto')
                $table->foreign('id_coleccion')->references('id')->on('coleccion')->onDelete('cascade');
                $table->foreign('id_producto')->references('id')->on('producto')->onDelete('cascade');

                // Clave primaria compuesta
                $table->primary(['id_coleccion', 'id_producto']);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coleccion_producto');
    }
};
