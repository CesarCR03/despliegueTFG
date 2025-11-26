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
        // CAMBIO: 'producto' (minúscula)
        Schema::create('producto', function (Blueprint $table) {
            // CAMBIO: Usamos id() para que sea BigInteger compatible con Laravel moderno
            $table->id('id_producto');
            $table->string('Nombre');
            $table->text('Descripcion');
            $table->decimal('Precio', 8, 2);
            $table->integer('Stock')->nullable(); // Ponemos nullable por si acaso
            $table->timestamps(); // ¡Faltaban los timestamps!
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('producto'); // Minúscula
    }
};
