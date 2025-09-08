<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{



    public function mesa()
    {
        return $this->belongsTo(Mesa::class);
    }

    public function comandas()
    {
        return $this->hasMany(Comanda::class);
    }

}
