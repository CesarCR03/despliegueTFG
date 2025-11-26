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
        if (!Schema::hasTable('producto')) {
            Schema::create('producto', function (Blueprint $table) {
                // USAMOS TU ID PERSONALIZADO
                $table->id('id_producto');

                $table->string('Nombre');
                $table->text('Descripcion');
                $table->decimal('Precio', 8, 2);
                $table->integer('Stock')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('producto'); // Minúscula
    }
};
