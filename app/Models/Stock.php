<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $table = 'stocks';

    protected $fillable = [
        //'category_id',
        'nombre',
        'unidades',
        'precio_venta',
        'precio_compra',
        'descripcion',
    ];

}
