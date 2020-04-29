@extends('layouts.app')

@section('content')

<a href="{{ route('products.create') }}" class="btn btn-lg btn-success">Criar Produto</a>

<table class="table table-hover">
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
            <td class="row">
              <a href="{{ route('products.edit', ['product' => $product->id]) }}" class="btn btn-sm btn-primary">Editar</a>
              <form action="{{ route('products.destroy', ['product' => $product->id]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger">Remover</button>
            </form>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>

{{ $products->links() }}

@endsection