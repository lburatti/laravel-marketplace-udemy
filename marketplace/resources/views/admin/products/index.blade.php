@extends('layouts.app')

@section('content')

<div class="row">
  <div class="col-12 orders-notifications pt-3">
    <h2 class="card-title my-0">Meus Produtos</h2>
    <a href="{{ route('products.create') }}" class="btn btn-lg btn-primary">Criar Produto</a>
  </div>

  <div class="col-12">
    <hr>
    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Produto</th>
          <th scope="col">Preço</th>
          <th scope="col">Loja</th>
          <th scope="col">Ações</th>
        </tr>
      </thead>
      <tbody>
        @foreach($products as $product)
        <tr>
          <td scope="row">{{ $product->id }}</td>
          <td>{{ $product->name }}</td>
          <td>R$ {{ number_format($product->price, 2, ',', '.') }}</td>
          <td>{{ $product->store->name }}</td>
          <td class="edit-remove row mr-1">
            <a href="{{ route('products.edit', ['product' => $product->id]) }}" class="btn btn-sm btn-primary mx-1">
              <i class="fa fa-edit"></i>
            </a>
            <form action="{{ route('products.destroy', ['product' => $product->id]) }}" method="POST">
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
<hr>
{{ $products->links() }}

@endsection