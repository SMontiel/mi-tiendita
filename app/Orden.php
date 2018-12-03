<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orden extends Model
{
    protected $fillable = [
        'subtotal', 'gasto_envio', 'id_usuario',
    ];
}
