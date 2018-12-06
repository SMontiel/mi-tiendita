@extends('template')

@section('title', 'Carrito de compra')

@section('content')
<div class="">
    <div class="flex justify-between items-center mx-16 my-2">
        <p class="opacity-75 uppercase tracking-wide font-bold"><i class="fa fa-shopping-cart mr-2"></i> Productos en el carrito</p>
        <a href="{{route('carrito-vaciar')}}" class="no-underline bg-tertiary px-4 py-2 rounded text-white hover:bg-red">
            <i class="fa fa-trash-alt mr-1"></i>Vaciar
        </a>
    </div>
    <div class="mx-16">
        @if(count($carrito))
        <div class="table-responsive text-center">
            <table class="table table-black table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th>Imagen</th>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Precio Total</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($carrito as $item)
                    <tr>
                        <td><img class="w-24 h-24" src="/images/{{$item->url_foto}}"></td>
                        <td>{{$item->nombre}}</td>
                        <td>{{number_format($item->precio, 2)}}</td>
                        <!--                        <td>{{$item->cantidad}}</td>-->
                        <td>
                        <input type="number" min="1" max="100" value="{{$item->cantidad}}" id="producto_{{$item->id}}">

                            <a href="#" class="btn btn-warning btn-update-item" data-href="{{route('carrito-actualizar', $item)}}" data-id="{{$item->id}}">
                                <i class="fa fa-sync-alt"></i>
                            </a>
                        </td>
                        <td>{{number_format($item->precio * $item->cantidad, 2)}}</td>
                        <td class="">
                            <a href="{{route('carrito-borrar', $item->id)}}" class="btn btn-dangers" id="btn-dangerss">
                                <i class="fa fa-trash-alt"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <h1 class="rounded border py-2">
                <span class="text-base text-2xl text-sm text-soft-black">Total: </span>${{number_format($total, 2)}}
            </h1>
        </div>
        @else
        <h1 class="text-center my-8"><span class="label label-warning">No existen productos añadidos :'(</span></h1>
        @endif

    </div>
    <div class="text-center mt-4">
        <a href="{{route('index')}}" class="rounded bg-primary px-4 py-2 mr-2 no-underline text-soft-black">
            <i class="fa fa-chevron-circle-left"></i> Seguir comprando
        </a>
        <a href="{{route('orden-detalle')}}" class="rounded bg-primary px-4 py-2 ml-2 no-underline text-soft-black">
            Continuar <i class="fa fa-chevron-circle-right"></i>
        </a>
    </div>
</div>
@endsection
