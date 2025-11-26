<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    // COINCIDE CON RAILWAY: P mayúscula
    protected $table = 'producto';

    protected $primaryKey = 'id_producto';
    public $timestamps = false;

    protected $fillable = ['Nombre', 'Descripcion', 'Precio'];

    public function categorias()
    {
        return $this->belongsToMany(
            Categoria::class,
            'categoria_Producto', // Coincide con la foto (Mayúsculas)
            'id_producto',
            'id_categoria'
        );
    }

    public function colecciones()
    {
        return $this->belongsToMany(
            Coleccion::class,
            'coleccion_producto', // En la foto se ve en minúsculas (coleccion_prod...)
            'id_producto',
            'id_coleccion'
        );
    }

    public function imagenes()
    {
        return $this->hasMany(Imagen::class, 'producto_id');
    }

    public function tallas()
    {
        return $this->hasMany(ProductoStock::class, 'id_producto');
    }
}
