@extends('template')

@section('title', 'Producto')

@section('content')
    <div class="flex justify-centers px-16 py-4">
        <div class="w-1/3 flex justify-center">
            <div class="rounded border">
                <img src="/images/{{ $producto->url_foto }}" class="w-64 h-64" alt="Imagen de {{ $producto->nombre }}">
            </div>
        </div>
        <div class="w-2/3 flex flex-col p-4">
            <h2 class="text-soft-black font-normal">{{ $producto->nombre }}</h2>
            <h1 class="text-blue mt-2">$ {{ $producto->precio }}</h1>
            <p class="text-grey-dark text-lg pt-4">{{ $producto->descripcion }}</p>
            <div class="mt-8">
                <a href="{{route('carrito-agregar', $producto->id)}}" class="rounded no-underline bg-secondary px-2 py-1 text-black border-2 border-secondary hover:bg-white hover:text-black">
                    <i class="fas fa-cart-plus"></i> Agregar al carrito
                </a>
            </div>

        </div>
    </div>
@endsection
