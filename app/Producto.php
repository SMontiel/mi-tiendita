<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = [
        'nombre', 'codigo_barras', 'descripcion', 'url_foto', 'precio', 'id_categoria',
    ];

    protected $table = 'producto';
}
