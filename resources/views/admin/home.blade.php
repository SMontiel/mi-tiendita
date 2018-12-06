@extends('admin.template')

@section('title', 'Dashboard')

@section('content')

    <div>
        <h1><i class="fa fa-rocket"></i> Dashboard - Don Balón</h1>
    </div>
    <h3>Bienvenido(a) {{ Auth::user()->name }} al panel de administración</h3>
    <div>
        <div>
            <i class="fa fa-list"></i>
            <a href="{{ route('categorias.index') }}">Categorías</a>
        </div>
        <div>
            <i class="fa fa-shopping-basket"></i>
            <a href="{{ route('productos.index') }}">Productos</a>
        </div>
    </div>

@endsection
