<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imagen extends Model
{
    use HasFactory;

    // COINCIDE CON RAILWAY: I mayúscula
    protected $table = 'imagen';

    protected $primaryKey = 'id_imagen';
    public $timestamps = false;
    protected $fillable = ['URL', 'producto_id'];

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }

    public function colecciones()
    {
        return $this->belongsToMany(
            Coleccion::class,
            'coleccion_Imagen', // En la foto se ve con Mayúsculas (Coleccion_Imag...)
            'id_imagen',
            'id_coleccion'
        );
    }
}
