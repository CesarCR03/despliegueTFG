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
        Schema::create('coleccion', function (Blueprint $table) {
            // Si quieres usar 'id_coleccion' como clave primaria:
            $table->id('id_coleccion');

            // Campos que faltaban según tu código:
            $table->string('Nombre');
            $table->integer('Año');
            $table->string('imagen_url')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coleccion');
    }
};
