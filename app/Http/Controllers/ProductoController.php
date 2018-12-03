<?php

namespace App\Http\Controllers;

use App\Producto;
use App\Http\Controllers\Controller;

class ProductoController extends Controller {
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function all() {
        return view('productos', ['productos' => Producto::all()]);
    }

    public function showProduct($id) {
        return view('detalle-producto', ['producto' => Producto::find($id)]);
    }
}
