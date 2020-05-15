@extends('layouts.front')

@section('content')

<!-- PRODUTOS -->
<div class="row">
    @foreach($products as $key => $product)
    <div class="col-md-4 front-row">
        <div class="card" style="width: 100%;">
            @if($product->photos->count())
            <img src="{{ asset('storage/' . $product->photos->first()->image) }}" class="card-img-top" alt="{{ $product->name }}">
            @else
            <img src="{{ asset('assets/img/no-photo.jpg') }}" class="card-img-top" alt="Produto sem foto">
            @endif
            <div class="card-body">
                <h5 class="card-title">{{ $product->name }}</h5>
                <p class="card-text">{{ $product->description }}</p>
                <h3 class="card-subtitle">R$ {{ number_format($product->price, 2, ',', '.') }}</h3>
                <div class="row">
                    <a href="{{ route('product.single', ['slug' => $product->slug]) }}" class="btn btn-primary btn-product col-5">Ver produto</a>
                    <form class="col-5" action="{{ route('cart.add') }}" method="POST">
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

    @if(($key + 1) % 3 == 0)
    <div class="row"></div>
    @endif
    @endforeach

</div>

<!-- LOJAS -->
<div class="row mt-5 pages-margin">
    <div class="col-12 pt-2">
        <h2 class="card-title">Lojas em Destaque</h2>
        <hr>
    </div>

    <div id="myCarousel" class="carousel slide col-12" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            @foreach($stores as $store)
            <div class="carousel-item {{ $loop->first ? 'active' : '' }} carousel-image" style="background-size: cover;">
                <div class="">
                    @if($store->logo)
                    <img src="{{ asset('storage/' . $store->logo) }}" alt="{{ $store->name }}" class="img-fluid">
                    @else
                    <img src="{{ asset('assets/img/no-logo.png') }}" class="img-fluid" alt="Loja sem logo...">
                    @endif
                </div>
                <div class="card-store px-0">
                    <h3 class="card-subtitle pt-3">{{ $store->name }}</h3>
                    <a href="{{ route('store.single', ['slug' => $store->slug]) }}" class="btn btn-sm btn-primary">Ir para Loja</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>


</div>

@endsection