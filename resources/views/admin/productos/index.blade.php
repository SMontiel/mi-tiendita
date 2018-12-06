@extends('admin.template')

@section('title', 'Productos - Admin')

@section('content')

    <h1>Vista principal de Productos</h1>
    <a href="{{ route('productos.create') }}" class="rounded bg-primary px-4 py-2">
        Nuevo<i class="fa fa-plus-circle ml-1"></i>
    </a>

    <table class="table table-striped table-hover table-bordered">
        <thead>
            <tr>
                <th scope="col">Código</th>
                <th scope="col">Nombre</th>
                <th scope="col">Descripción</th>
                <th scope="col">Precio</th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
          @foreach ($productos as $producto)
            <tr>
                <th scope="row">{{ $producto->codigo_barras }}</th>
                <td>{{ $producto->nombre }}</td>
                <td>{{ $producto->descripcion }}</td>
                <td>$ {{ $producto->precio }}</td>
                <td>
                    <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-danger">
                        <i class="fa fa-edit text-blue"></i>
                    </a>
                </td>
                <td>
                    {!! Form::open(array('url' => 'admin/productos/' . $producto->id, 'class' => 'pull-right')) !!}
                    {!! Form::hidden('_method', 'DELETE') !!}

                    <button type="submit" class="btn btn-danger">
                        <i class="fa fa-trash-alt text-red"></i>
                    </button>
                    {!! Form::close() !!}
                </td>
            </tr>
          @endforeach
        </tbody>
    </table>
@endsection
