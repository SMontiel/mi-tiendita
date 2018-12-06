@extends('template')
@section('title', 'Detalles del pedido')

@section('content')
<div class="mx-16 text-center">
    <div class="flex justify-between items-center my-2">
        <a href="{{route('carrito')}}" class="rounded uppercase tracking-wide bg-primary-lightest hover:bg-primary px-4 py-2 mr-2 no-underline text-soft-black">
            <i class="fa fa-chevron-circle-left"></i> Regresar
        </a>
        <p class="opacity-75 uppercase tracking-wide font-bold text-lg my-4">
            <i class="fa fa-shopping-basket mr-2"></i> Detalles del pedido
        </p>
        <a href="{{route('payment')}}" class="rounded uppercase tracking-wide bg-primary-lightest hover:bg-primary px-4 py-2 ml-2 no-underline text-soft-black">
            Pagar con <i class="fab fa-paypal ml-1"></i>
        </a>
    </div>

    <div class="w-full flex justify-center">
        <div class="flex justify-between w-2/5 rounded shadow-md p-4 bg-grey-lightest">
            <img class="rounded-full shadow w-32 h-32" src="{{Auth::user()->url_foto}}" alt="Usuario">
            <div class="flex flex-col text-left m-4">
                <p class="font-bold text-2xl">{{Auth::user()->name}}</p>
                <p class="font-medium text-soft-black mt-2"><i class="fa fa-envelope mr-2"></i>{{Auth::user()->email}}</p>
                <p class="font-medium text-soft-black mt-2"><i class="fa fa-map-marker-alt mr-2"></i>{{Auth::user()->direccion}}</p>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered">
                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Subtotal </th>
                </tr>
                @foreach($carrito as $item)
                <tr>
                    <td>{{$item['nombre']}}</td>
                    <td>$ {{number_format($item['precio'], 2)}}</td>
                    <td>{{$item['cantidad']}}</td>
                    <td>{{number_format($item['precio'] * $item['cantidad'], 2)}}</td>
                </tr>
                @endforeach
                <tr>
                    <td>Costo de envío</td>
                    <td>$ {{ $envio }}</td>
                    <td>1</td>
                    <td>$ {{ $envio }}</td>
                </tr>
            </table>
            <hr>
            <div class="flex flex-row justify-between">
                <p></p>
                <table class="table table-striped table-hover table-bordered w-2/5">
                    <tr>
                        <td>
                            <h3 class="">
                                <span class="text-base text-sm text-soft-black">Subtotal: </span>
                            </h3>
                        </td>
                        <td>
                            <h3 class="">
                                <span class="text-base text-sm text-soft-black"></span>$ {{number_format($subtotal, 2)}}
                            </h3>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h3 class="">
                                <span class="text-base text-sm text-soft-black">Impuestos (16%): </span>
                            </h3>
                        </td>
                        <td>
                            <h3 class="">
                                <span class="text-base text-sm text-soft-black"></span>$ {{number_format($taxes, 2)}}
                            </h3>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h1 class="py-2">
                                <span class="text-base text-2xl text-sm text-soft-black">Total: </span>
                            </h1>
                        </td>
                        <td>
                            <h1 class="rounded border py-2">
                                <span class="text-base text-2xl text-sm text-soft-black"></span>$ {{number_format($total, 2)}}
                            </h1>
                        </td>
                    </tr>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection
