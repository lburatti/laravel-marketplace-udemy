@extends('layouts.app')

@section('content')

  @if(!$store)
    <a href="{{ route('stores.create') }}" class="btn btn-lg btn-success">Criar Loja</a>
  @else
  <table class="table table-hover">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Loja</th>
          <th scope="col">Total de produtos</th>
          <th scope="col">Ações</th>
        </tr>
      </thead>
      <tbody>
          <tr>
              <td scope="row">{{ $store->id }}</td>
              <td>{{ $store->name }}</td>
              <td>{{ $store->products->count() }}</td>
              <td class="row">
                <a href="{{ route('stores.edit', ['store' => $store->id]) }}" class="btn btn-sm btn-primary">Editar</a>
                <form action="{{ route('stores.destroy', ['store' => $store->id]) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-sm btn-danger">Remover</button>
              </form>
              </td>
          </tr>
      </tbody>
    </table>
  @endif
@endsection