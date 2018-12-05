<?php

namespace App\Http\Controllers;

use App\Producto;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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

    public function verFactura() {
        return Storage::disk('public')->download('/invoices/'.Auth::user()->id.'.pdf');
    }
}
