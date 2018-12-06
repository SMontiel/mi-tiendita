<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Producto;
use App\Categoria;
use Illuminate\Support\Facades\Log;
use App\CategoriaProducto;
use Illuminate\Support\Facades\Session;

class ProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $productos = Producto::all();
        return view('admin.productos.index', compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $cats = Categoria::all();
        $categorias = array();
        foreach($cats as $c) {
            $categorias[$c->id] = $c->nombre;
        }
        return view('admin.productos.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->validate($request, [
            'nombre' => 'required|max:255',
            'descripcion' => 'required|max:255',
            'precio' => 'required',
            'codigo_barras' => 'required|unique:producto|max:255',
            'url_foto' => 'required',
            'categoria' => 'required'
        ]);
        $imageName = time().'.'.$request->file('url_foto')->getClientOriginalExtension();
        $request->file('url_foto')->move(
            base_path() . '/public/images/', $imageName
        );
        $producto = Producto::create([
            'nombre' => $request->get('nombre'),
            'descripcion' => $request->get('descripcion'),
            'precio' => $request->get('precio'),
            'codigo_barras' => $request->get('codigo_barras'),
            'url_foto' => $imageName,
            'id_categoria' => $request->get('categoria')
        ]);
        Session::flash('message', 'Producto creado con éxito!');
        return redirect()->route('productos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $producto = Producto::find($id);
        $cats = Categoria::all();
        $categorias = array();
        foreach($cats as $c) {
            $categorias[$c->id] = $c->nombre;
        }
        return view('admin.productos.edit')
            ->with('producto', $producto)
            ->with('categorias', $categorias);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $this->validate($request, [
            'nombre' => 'required|max:255',
            'descripcion' => 'required|max:255',
            'precio' => 'required',
            'categoria' => 'required'
        ]);
        if ($request->file('url_foto') === null) {
            $producto = Producto::find($id)->update([
                'nombre' => $request->get('nombre'),
                'descripcion' => $request->get('descripcion'),
                'precio' => $request->get('precio'),
                'id_categoria' => $request->get('categoria')
            ]);
        } else {
            $imageName = time().'.'.$request->file('url_foto')->getClientOriginalExtension();
            $request->file('url_foto')->move(
                base_path() . '/public/images/', $imageName
            );
            $producto = Producto::find($id)->update([
                'nombre' => $request->get('nombre'),
                'descripcion' => $request->get('descripcion'),
                'precio' => $request->get('precio'),
                'url_foto' => $imageName,
                'id_categoria' => $request->get('categoria')
            ]);
        }
        Session::flash('message', 'Producto actualizado con éxito!');
        return redirect()->route('productos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        Log::info($id);
        Producto::find($id)->delete();
        Session::flash('message', 'Producto borrado con éxito!');
        return redirect()->route('productos.index');
    }
}
