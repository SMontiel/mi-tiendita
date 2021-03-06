@extends('template')

@section('title', 'Home')

@section('content')

    @if (session('message'))
        <div id="app">
            <alert></alert>
        </div>
    @endif

    <div class="ex1 px-16 py-4 flex flex-wrap justify-around">
        @foreach ($productos as $prod)
            <div class="bump w-64 h-auto m-1 p-2 rounded shadow hover:shadow-md border bg-white">
                <div class="flex justify-center">
                    <a class="block">
                        <img class="block h-48 rounded" src="/images/{{ $prod->url_foto }}" alt="">
                    </a>
                </div>
                <p class="text-soft-black mt-2">{{ $prod->nombre }}</p>
                <p class="text-3xl my-2">$ {{ $prod->precio }}</p>
                <div class="flex justify-around items-center h-12 border-t">
                    <a href="{{route('carrito-agregar', $prod->id)}}" class="rounded no-underline bg-secondary px-2 py-1 text-black border-2 border-secondary hover:bg-white hover:text-black">
                        Agregar al <i class="fas fa-cart-plus"></i>
                    </a>
                    <a href="/detalles-producto/{{ $prod->id }}" class="rounded no-underline bg-tertiary px-2 py-1 text-white border-2 border-tertiary hover:bg-white hover:text-black">
                        Ver <i class="fa fa-sm fa-plus"></i>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
