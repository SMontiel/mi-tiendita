@extends('template')
@section('title', 'Detalles del pedido')

@section('content')
<div class="container text-center">
    <div class="page-header">
        <h1><i class="fa fa-shopping-cart"></i>Detalle del pedido</h1>
    </div>

    <div class="w-full flex justify-center">
        <div class="flex flex-row w-2/5 rounded shadow p-4 bg-grey-lighter">
                <img class="rounded-full shadow w-32 h-32" src="{{Auth::user()->url_foto}}" alt="Usuario">
                <div class="flex flex-col justify-center align-left m-4">
                    <p class="font-bold text-2xl">{{Auth::user()->name}}</p>
                    <p class="font-medium text-grey-darker">{{Auth::user()->email}}</p>
                </div>
            </div>
    </div>

    <div class="page">
        <div class="table-responsive">
            <h3>Datos del usuario</h3>

            <table class="table table-striped table-hover table-bordered">
                <tr>
                    <td>Nombre: </td>
                    <td>{{Auth::user()->name}}</td>
                </tr>
                <tr>
                    <td>Dirección: </td>
                    <td>{{Auth::user()->address}}</td>
                </tr>
                <tr>
                    <td>Email: </td>
                    <td>{{Auth::user()->email}}</td>
                </tr>
            </table>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered">
                <h3>Datos del pedido</h3>
                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Subtotal </th>
                </tr>
                @foreach($carrito as $item)
                <tr>
                    <td>{{$item['nombre']}}</td>
                    <td>{{number_format($item['precio'], 2)}}</td>
                    <td>{{$item['cantidad']}}</td>
                    <td>{{number_format($item['precio'] * $item['cantidad'], 2)}}</td>
                </tr>
                @endforeach
            </table>
            <hr>
            <h3>
                <span class="label label-success">
                    Total: ${{number_format($total, 2)}}
                </span>
            </h3>
            <hr>
            <p>
                <a href="{{route('carrito')}}" class="btn btn-primary"><i class="fa fa-chevron-circle-left"></i> Regresar</a>
                <a href="{{route('payment')}}" class="btn btn-warning">Pagar con <i class="fa fa-paypal"></i></a>
            </p>
        </div>
    </div>
</div>
@endsection
