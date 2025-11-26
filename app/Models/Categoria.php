<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    // COINCIDE CON RAILWAY: C mayúscula
    protected $table = 'Categoria';

    protected $primaryKey = 'id_categoria';
    public $timestamps = false;

    protected $fillable = ['Nombre'];

    public function productos()
    {
        return $this->belongsToMany(
            Producto::class,
            'Categoria_Producto', // En Railway sale con Mayúsculas
            'id_categoria',
            'id_producto'
        );
    }
}
