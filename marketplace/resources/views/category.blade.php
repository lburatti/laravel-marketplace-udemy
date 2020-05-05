@extends('layouts.front')

@section('content')

<!-- PRODUTOS -->
<div class="row">
    <div class="col-12">
        <h2 class="card-title pt-3">{{ $category->name }}</h2>
        <hr>
    </div>
    @if($category->products->count())
    @foreach($category->products as $key => $product)
    <div class="col-md-4 front-row card-category-single">
        <div class="card" style="width: 100%;">
            @if($product->photos->count())
            <img src="{{ asset('storage/'.$product->photos->first()->image) }}" class="card-img-top" alt="...">
            @else
            <img src="{{ asset('assets/img/no-photo.jpg') }}" class="card-img-top" alt="...">
            @endif
            <div class="card-body">
                <h5 class="card-title">{{ $product->name }}</h5>
                <p class="card-text">{{ $product->description }}</p>
                <h3 class="card-subtitle">R$ {{ number_format($product->price, 2, ',', '.') }}</h3>
                <div class="row">
                    <a href="{{ route('product.single', ['slug' => $product->slug]) }}" class="btn btn-primary btn-product col-md-5">Ver produto</a>
                    <form class="col-md-5" action="{{ route('cart.add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product[name]" value="{{ $product->name }}">
                        <input type="hidden" name="product[price]" value="{{ $product->price }}">
                        <input type="hidden" name="product[slug]" value="{{ $product->slug }}">
                        <input type="hidden" name="product[amount]" value="1">
                        <button class="btn btn-success btn-product">Comprar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @if(($key + 1) % 3 == 0) <div class="row"></div> @endif
    @endforeach
    @else
    <div class="col-12">
        <h3 class="alert alert-warning">Nenhum produto encontrado para essa categoria.</h3>
    </div>
    @endif
</div>

@endsection