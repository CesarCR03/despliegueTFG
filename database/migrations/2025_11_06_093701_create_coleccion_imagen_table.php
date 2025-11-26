<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        // Recomendación: Usa minúsculas para el nombre de la tabla también: 'coleccion_imagen'
        if (!Schema::hasTable('coleccion_imagen')) {
            Schema::create('coleccion_imagen', function (Blueprint $table) {
                $table->unsignedInteger('id_coleccion');
                $table->unsignedBigInteger('id_imagen');

                // CORRECCIÓN: Referencias en minúscula
                $table->foreign('id_coleccion')->references('id_coleccion')->on('coleccion')->onDelete('cascade');

                // CORRECCIÓN: Referencias en minúscula
                $table->foreign('id_imagen')->references('id_imagen')->on('imagen')->onDelete('cascade');

                $table->primary(['id_coleccion', 'id_imagen']);
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('coleccion_imagen');
    }
};
