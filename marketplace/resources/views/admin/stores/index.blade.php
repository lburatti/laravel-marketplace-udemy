@extends('layouts.app')

@section('content')

<div class="row">
  <div class="col-12 orders-notifications pt-3">
    <h2 class="card-title my-0">Minha Loja</h2>
    @if(!$store)
    <a href="{{ route('stores.create') }}" class="btn btn-lg btn-primary">Criar Loja</a>
    @else
  </div>

  <div class="col-12">
    <hr>
    <table class="table table-striped">
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
          <td class="edit-remove px-0">
            <a href="{{ route('stores.edit', ['store' => $store->id]) }}" class="btn btn-sm btn-primary mx-1">
              <i class="fa fa-edit"></i>
            </a>
            <form action="{{ route('stores.destroy', ['store' => $store->id]) }}" method="POST">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-sm btn-danger mx-1">
                <i class="fa fa-trash"></i>
              </button>
            </form>
          </td>
        </tr>
      </tbody>
    </table>
    @endif
  </div>
</div>
<hr>

@endsection