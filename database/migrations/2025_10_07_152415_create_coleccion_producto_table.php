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
                // 1. Definimos las columnas (tienen que ser del mismo tipo que los IDs padres)
                $table->unsignedBigInteger('id_coleccion');
                $table->unsignedBigInteger('id_producto');

                // 2. Definimos las claves foráneas MANUALMENTE
                // "La columna 'id_coleccion' de esta tabla... apunta a la columna 'id_coleccion' de la tabla 'coleccion'"
                $table->foreign('id_coleccion')
                    ->references('id_coleccion') // Apuntamos a tu ID personalizado
                    ->on('coleccion')            // En la tabla en minúscula
                    ->onDelete('cascade');

                $table->foreign('id_producto')
                    ->references('id_producto')  // Apuntamos a tu ID personalizado
                    ->on('producto')             // En la tabla en minúscula
                    ->onDelete('cascade');

                $table->primary(['id_coleccion', 'id_producto']);
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('coleccion_producto');
    }
};
