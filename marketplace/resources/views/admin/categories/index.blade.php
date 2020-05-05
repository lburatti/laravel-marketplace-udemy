@extends('layouts.app')

@section('content')

<div class="row">
  <div class="col-12 orders-notifications pt-3">
    <h2 class="card-title my-0">Categorias</h2>
    <a href="{{ route('categories.create') }}" class="btn btn-lg btn-primary">Criar Categoria</a>
  </div>

  <div class="col-12">
    <hr>
    <table class="table table-striped">
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
          <td class="edit-remove px-0">
            <a href="{{ route('categories.edit', ['category' => $category->id]) }}" class="btn btn-sm btn-primary mx-1">
              <i class="fa fa-edit"></i>
            </a>
            <form action="{{ route('categories.destroy', ['category' => $category->id]) }}" method="POST">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-sm btn-danger mx-1">
                <i class="fa fa-trash"></i>
              </button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

{{ $categories->links() }}

@endsection