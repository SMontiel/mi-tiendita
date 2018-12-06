@extends('admin.template')

@section('title', 'Dashboard')

@section('content')

    <div class="text-center mx-16 my-4">
        <p class="opacity-75 uppercase tracking-wide font-bold text-lg"><i class="fa fa-rocket"></i> Dashboard - Don Balón</p>
    </div>
    <h3 class="text-center mx-16 my-4">Bienvenido(a) {{ Auth::user()->name }} al panel de administración</h3>
    <div class="w-full flex flex-row justify-center">
        <div class="text-center w-1/3">
            <div class="flex flex-row justify-around">
                <a href="{{ route('categorias.index') }}" class="no-underline bg-tertiary px-4 py-2 rounded text-white hover:bg-red">
                    <i class="fa fa-list mr-1"></i>Categorías
                </a>
                <a href="{{ route('productos.index') }}" class="no-underline bg-tertiary px-4 py-2 rounded text-white hover:bg-red">
                    <i class="fa fa-shopping-basket mr-1"></i>Productos
                </a>
            </div>
        </div>
    </div>

@endsection
