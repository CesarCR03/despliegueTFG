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
        if (!Schema::hasTable('coleccion')) {
            Schema::create('coleccion', function (Blueprint $table) {
                // USAMOS TU ID PERSONALIZADO
                $table->id('id_coleccion');

                $table->string('Nombre');
                $table->integer('Año');
                $table->string('imagen_url')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coleccion');
    }
};
