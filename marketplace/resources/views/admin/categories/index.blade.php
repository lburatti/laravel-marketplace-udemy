@extends('layouts.app')

@section('content')

<a href="{{ route('categories.create') }}" class="btn btn-lg btn-success">Criar Categoria</a>

<table class="table table-hover">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Categoria</th>
        <th scope="col">Ações</th>
      </tr>
    </thead>
    <tbody>
        @foreach($categories as $category)
        <tr>
            <td scope="row">{{ $category->id }}</td>
            <td>{{ $category->name }}</td>
            <td class="row">
              <a href="{{ route('categories.edit', ['category' => $category->id]) }}" class="btn btn-sm btn-primary">Editar</a>
              <form action="{{ route('categories.destroy', ['category' => $category->id]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger">Remover</button>
            </form>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>

{{ $categories->links() }}

@endsection