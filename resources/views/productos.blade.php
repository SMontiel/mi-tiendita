@extends('template')

@section('title', 'Home')

@section('content')
    <div class="ex1 px-16 py-4 flex flex-wrap justify-around">
        @foreach ($productos as $prod)
            <div class="bump w-64 h-18 m-1 p-2 rounded shadow-md border bg-white">
                <div class="flex justify-center">
                    <a class="block">
                        <img class="block h-48 rounded" src="/images/{{ $prod->url_foto }}" alt="">
                    </a>
                </div>
                <p class="text-soft-black">{{ $prod->nombre }}</p>
                <div class="flex justify-around items-center h-10">
                    <a href="" class="rounded no-underline bg-secondary px-2 py-1 text-black border-2 border-secondary hover:bg-white hover:text-black">Agregar al carrito</a>
                    <a href="/images/{{ $prod->url_foto }}" class="rounded no-underline bg-tertiary px-2 py-1 text-white border-2 border-tertiary hover:bg-white hover:text-black">Ver más</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
