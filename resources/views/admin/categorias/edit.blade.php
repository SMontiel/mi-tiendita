@extends('admin.template')

@section('title', 'Editar Categoría - Admin')

@section('content')

    <h1>
        Editar categoría
    </h1>
    {{ Html::ul($errors->all()) }}
    <div>
        <div>
            {!! Form::open(['route' => array('categorias.update', $categoria->id),
                'method' => 'PUT']) !!}
                <div>
                    <label for="nombre">Nombre</label>
                    {!! Form::text('nombre', $categoria->nombre, array(
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
