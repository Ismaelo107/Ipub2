<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Categoria;

class Stock extends Model
{

    protected $fillable = [
        'categoria_id',
        'nombre',
        'unidades',
        'precio_venta',
        'precio_compra',
        'descripcion',
    ];

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class);
    }

}
