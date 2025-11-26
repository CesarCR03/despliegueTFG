<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Nombre estándar en minúsculas: categoria_producto
        Schema::create('categoria_producto', function (Blueprint $table) {
            // Usamos foreignId para que coincida con el tipo BigInteger de las tablas principales
            $table->foreignId('id_categoria')->constrained('categoria', 'id_categoria')->onDelete('cascade');
            $table->foreignId('id_producto')->constrained('producto', 'id_producto')->onDelete('cascade');

            $table->primary(['id_categoria', 'id_producto']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categoria_producto');
    }
};
