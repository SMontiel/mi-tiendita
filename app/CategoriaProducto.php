<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoriaProducto extends Model
{
    protected $fillable = [
        'id_categoria', 'id_producto',
    ];

    protected $table = 'categoria_producto';
}
