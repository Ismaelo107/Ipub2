<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mesa extends Model
{
    /** @use HasFactory<\Database\Factories\MesaFactory> */
    use HasFactory;

    protected $fillable = [
        'estado',
        'aPagar',
        'formaPago'

    ];

    public function comandas()
    {
        return $this->hasMany(Comanda::class);
    }
}
