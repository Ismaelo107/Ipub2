<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Comanda extends Model
{
    protected $fillable = [
        'mesa_id',
        'stock_id',
        'cantidad',
        'precio',
        //'estado',
        'notas'
    ];

    public function mesa(): BelongsTo
    {
        return $this->belongsTo(Mesa::class);
    }

    public function stock(): BelongsTo
    {
        return $this->BelongsTo(Stock::class);
    }
}
