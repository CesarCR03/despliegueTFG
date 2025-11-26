<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Cesta extends Model
{
    protected $table = 'cesta'; // minúscula estándar
    protected $primaryKey = 'id_cesta';

    protected $fillable = ['user_id', 'session_id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function productos(): BelongsToMany
    {
        return $this->belongsToMany(
            Producto::class,
            'cesta_producto', // Asumimos minúscula para la futura tabla pivote
            'cesta_id',
            'id_producto'
        )->withPivot('cantidad', 'talla');
    }
}
