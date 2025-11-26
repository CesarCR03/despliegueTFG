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
        Schema::create('imagen', function (Blueprint $table) {
            $table->id('id_imagen');
            $table->string('URL');

            // IMPORTANTE: Relación con producto (si cada imagen es de un producto)
            // Si no la tienes aquí, asegúrate de tenerla en algún lado.
            // Si usas la tabla pivote 'coleccion_imagen', esto está bien.

            // Añadimos la FK hacia producto si es necesaria (veo en tu código original que sí)
            $table->foreignId('producto_id')->nullable()->constrained('producto', 'id_producto')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('imagen');
    }
};
