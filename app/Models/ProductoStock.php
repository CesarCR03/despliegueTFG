<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductoStock extends Model
{
    protected $table = 'producto_stock'; // minúscula

    protected $fillable = ['id_producto', 'talla', 'stock'];
    public $timestamps = true;

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto');
    }
}
