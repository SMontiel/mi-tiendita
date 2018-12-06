@extends('admin.template')

@section('title', 'Crear Producto - Admin')

@section('content')

    <h1>
        Agregar producto
    </h1>
    {{ Html::ul($errors->all()) }}
    <div>
        <div>
            {!! Form::open(['route' => 'productos.store', 'files' => true]) !!}
                <div>
                    <label for="nombre">Nombre</label>
                    {!! Form::text('nombre', null, array(
                        'class' => 'form-control',
                        'placeholder' => 'Ingresa el nombre'
                    )) !!}
                </div>
                <div>
                    <label for="descripcion">Descripción</label>
                    {!! Form::text('descripcion', null, array(
                        'class' => 'form-control',
                        'placeholder' => 'Ingresa la descripción'
                    )) !!}
                </div>
                <div>
                    <label for="codigo_barras">Código de barras</label>
                    {!! Form::text('codigo_barras', null, array(
                        'class' => 'form-control',
                        'placeholder' => 'Ingresa el código barras'
                    )) !!}
                </div>
                <div>
                    <label for="precio">Precio</label>
                    {!! Form::text('precio', null, array(
                        'class' => 'form-control',
                        'placeholder' => 'Ingresa el Precio'
                    )) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('Imagen del producto') !!}
                    {!! Form::file('url_foto', null) !!}
                </div>
                <div>
                    <label for="categoria">Categoría</label>
                    {!! Form::select('categoria', $categorias, array(
                        'class' => 'form-control'
                    )) !!}
                </div>
                <div>
                    {!! Form::submit('Guardar', array(
                        'class' => 'btn btn-primary'
                    )) !!}
                    <a href="{{ route('productos.index') }}">Cancelar</a>
                </div>
            {!! Form::close() !!}
        </div>
    </div>

@endsection
