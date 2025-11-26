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
        Schema::create('detalle_pedidos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pedido_id')->constrained('pedidos')->onDelete('cascade');
            $table->unsignedInteger('producto_id');

            $table->string('nombre_producto');
            $table->decimal('precio_unitario', 10, 2);
            $table->integer('cantidad');
            $table->string('talla', 10);
            $table->timestamps();

            // CORRECCIÓN: Cambiado 'Producto' a 'producto'
            $table->foreign('producto_id')->references('id_producto')->on('producto');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_pedidos');
    }
};
