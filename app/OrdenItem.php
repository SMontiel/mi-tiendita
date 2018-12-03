<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrdenItem extends Model
{
    protected $fillable = [
        'cantidad', 'precio', 'id_producto', 'id_orden',
    ];
}
