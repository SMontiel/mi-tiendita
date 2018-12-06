@extends('admin.template')

@section('title', 'Crear Categoría - Admin')

@section('content')

    <h1>
        Agregar categoría
    </h1>
    {{ Html::ul($errors->all()) }}
    <div>
        <div>
            {!! Form::open(['route' => 'categorias.store']) !!}
                <div>
                    <label for="nombre">Nombre</label>
                    {!! Form::text('nombre', null, array(
                        'class' => 'form-control',
                        'placeholder' => 'Ingresa el nombre'
                    )) !!}
                </div>
                <div>
                    {!! Form::submit('Guardar', array(
                        'class' => 'btn btn-primary'
                    )) !!}
                    <a href="{{ route('categorias.index') }}">Cancelar</a>
                </div>
            {!! Form::close() !!}
        </div>
    </div>

@endsection
