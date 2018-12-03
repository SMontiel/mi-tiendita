<?php

namespace App\Http\Controllers;

use App\Producto;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class CarritoController extends Controller {

    public function __construct(){
        //$this->middleware('auth');
        if(!\Session::has('carrito')) \Session::put('carrito', array());
    }

    public function show(){
        $carrito = \Session::get('carrito');
        $total = $this->total();
        return view('carrito', compact('carrito', 'total'));
    }

    public function add(Producto $producto) {
        $carrito = \Session::get('carrito');
        $producto->cantidad=1;
        $carrito[$producto->id] = $producto;
        \Session::put('carrito', $carrito);

        return redirect()->route('carrito');
    }

    public function remove(Producto $producto){
        $carrito=\Session::get('carrito');
        $indice=$producto->id;
        unset($carrito[$indice]);
        \Session::put('carrito', $carrito);
        \Session::get('carrito');
        return redirect()->route('carrito');
    }

    public function removeAll(){
        \Session::forget('carrito');
        return redirect()->route('carrito');
    }

    public function update(Producto $producto, $cantidad){
        Log::info($producto);
        $carrito=\Session::get('carrito');
        $carrito[$producto->id]->cantidad = $cantidad;
        \Session::put('carrito', $carrito);

        return redirect()->route('carrito');
    }

    private function total(){
        $carrito = \Session::get('carrito');
        $total = 0;
        foreach($carrito as $item){
            $total += $item->precio * $item->cantidad;
        }

        return $total;
    }
}
