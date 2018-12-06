@extends('admin.template')

@section('title', 'Categorías - Admin')

@section('content')

    <div class="flex justify-between items-center mx-16 my-4">
        <p class="opacity-75 uppercase tracking-wide font-bold text-lg"><i class="fa fa-list"></i> Vista principal de Categorías</p>
        <a href="{{route('categorias.create')}}" class="no-underline bg-tertiary px-4 py-2 rounded text-white hover:bg-red">
            Nueva<i class="fa fa-plus-circle ml-1"></i>
        </a>
    </div>

    <div class="mx-16 my-8">
      <table class="table table-striped table-hover table-bordered">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
          @foreach ($categorias as $categoria)
            <tr>
                <th scope="row">{{ $categoria->id }}</th>
                <td>{{ $categoria->nombre }}</td>
                <td>
                    <a href="{{ route('categorias.edit', $categoria->id) }}" class="btn btn-danger">
                        <i class="fa fa-edit text-blue"></i>
                    </a>
                </td>
                <td>
                    {{ Form::open(array('url' => 'admin/categorias/' . $categoria->id, 'class' => 'pull-right')) }}
                    {{ Form::hidden('_method', 'DELETE') }}

                    <button type="submit" class="btn btn-danger">
                        <i class="fa fa-trash-alt text-red"></i>
                    </button>
                    {{ Form::close() }}
                </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>

@endsection
