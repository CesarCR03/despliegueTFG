<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coleccion extends Model
{
    // COINCIDE CON RAILWAY: c minúscula
    protected $table = 'coleccion';
    protected $primaryKey = 'id_coleccion';

    public $timestamps = false;

    protected $fillable = ['Nombre', 'Año', 'imagen_url'];

    public function productos()
    {
        return $this->belongsToMany(
            Producto::class,
            'coleccion_producto', // Minúsculas según la foto
            'id_coleccion',
            'id_producto'
        );
    }

    public function imagenes()
    {
        return $this->belongsToMany(
            Imagen::class,
            'coleccion_imagen', // Mayúsculas según la foto
            'id_coleccion',
            'id_imagen'
        )->orderBy('id_imagen', 'desc');
    }
}
