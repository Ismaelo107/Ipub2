<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Categoria;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Stock extends Model
{

    use HasFactory;
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

    public function comanda(): HasMany
    {
        return $this->HasMany(Comanda::class);
    }


}
