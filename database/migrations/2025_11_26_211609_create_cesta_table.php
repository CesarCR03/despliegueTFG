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
        if (!Schema::hasTable('cesta')) {
            Schema::create('cesta', function (Blueprint $table) {
                $table->id('id_cesta'); // Clave primaria personalizada

                // Si el usuario está logueado
                $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');

                // Si es invitado (por sesión)
                $table->string('session_id')->nullable();

                $table->timestamps();
            });
        }

        // Tabla pivote Cesta_Producto (si no tienes una migración aparte para ella)
        if (!Schema::hasTable('cesta_producto')) {
            Schema::create('cesta_producto', function (Blueprint $table) {
                $table->unsignedBigInteger('cesta_id');
                $table->unsignedBigInteger('id_producto');
                $table->integer('cantidad')->default(1);
                $table->string('talla', 10);

                $table->foreign('cesta_id')->references('id_cesta')->on('cesta')->onDelete('cascade');
                $table->foreign('id_producto')->references('id_producto')->on('producto')->onDelete('cascade');

                $table->primary(['cesta_id', 'id_producto', 'talla']);
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('cesta_producto');
        Schema::dropIfExists('cesta');
    }
};
