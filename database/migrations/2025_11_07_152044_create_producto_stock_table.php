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
        Schema::create('producto_stock', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('id_producto');
            $table->string('talla', 10);
            $table->integer('stock');
            $table->timestamps();

            // CORRECCIÓN: Cambiado 'Producto' a 'producto'
            $table->foreign('id_producto')
                ->references('id_producto')->on('producto')
                ->onDelete('cascade');

            $table->unique(['id_producto', 'talla']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('producto_stock');
    }
};
