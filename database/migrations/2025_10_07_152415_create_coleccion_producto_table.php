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
        if (!Schema::hasTable('coleccion_producto')) {
            Schema::create('coleccion_producto', function (Blueprint $table) {
                // Definimos las columnas
                $table->unsignedBigInteger('id_coleccion'); // BigInteger para coincidir con id()
                $table->unsignedBigInteger('id_producto');  // BigInteger para coincidir con id()

                // Definimos las relaciones apuntando a 'id'
                $table->foreign('id_coleccion')->references('id')->on('coleccion')->onDelete('cascade');
                $table->foreign('id_producto')->references('id')->on('producto')->onDelete('cascade');

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
