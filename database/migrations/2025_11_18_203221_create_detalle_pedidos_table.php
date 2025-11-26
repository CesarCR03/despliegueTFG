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
        if (!Schema::hasTable('detalle_pedidos')) {
            Schema::create('detalle_pedidos', function (Blueprint $table) {
                $table->id();

                // Relación con Pedidos (usamos foreignId que ya es BigInteger)
                $table->foreignId('pedido_id')->constrained('pedidos')->onDelete('cascade');

                // CORRECCIÓN IMPORTANTE: Cambiado a unsignedBigInteger
                $table->unsignedBigInteger('producto_id');

                // Datos del detalle
                $table->string('nombre_producto');
                $table->decimal('precio_unitario', 10, 2);
                $table->integer('cantidad');
                $table->string('talla', 10);
                $table->timestamps();

                // Clave foránea apuntando a 'producto' (minúscula) y 'id_producto'
                $table->foreign('producto_id')
                    ->references('id_producto')
                    ->on('producto'); // Tabla en minúscula
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_pedidos');
    }
};
