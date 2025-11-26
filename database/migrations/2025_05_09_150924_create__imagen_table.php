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
        if (!Schema::hasTable('imagen')) {
            Schema::create('imagen', function (Blueprint $table) {
                $table->id('id_imagen');
                $table->string('URL');

                // Clave foránea apuntando a 'id_producto'
                $table->unsignedBigInteger('producto_id')->nullable();
                $table->foreign('producto_id')->references('id_producto')->on('producto')->onDelete('cascade');

                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('imagen');
    }
};
