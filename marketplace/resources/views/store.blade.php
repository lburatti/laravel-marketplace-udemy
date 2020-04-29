@extends('layouts.front')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-4">
            @if($store->logo)
            <img src="{{ asset('storage/'.$store->logo) }}" alt="Logo da loja: {{ $store->name }}" class="img-fluid">
            @else
            <img src="{{ asset('assets/img/no-logo.png') }}" class="img-fluid" alt="Loja sem logo...">
            @endif
        </div>
        <div class="col-8">
            <h2>{{ $store->name }}</h2>
            <p>{{ $store->description }}</p>
            <p>
                <strong>Contatos:</strong>
                <span>{{ $store->phone }}</span> | <span>{{ $store->mobile_phone }}</span>
            </p>
        </div>
    </div>
    <div class="col-12">
        <hr>
        <h3>Produtos dessa loja:</h3>
        <hr>
    </div>
    @if($store->products->count())
    @foreach($store->products as $key => $product)
    <div class="col-md-4 front-row">
        <div class="card" style="width: 100%;">
            @if($product->photos->count())
            <img src="{{ asset('storage/'.$product->photos->first()->image) }}" class="card-img-top" alt="...">
            @else
            <img src="{{ asset('assets/img/no-photo.jpg') }}" class="card-img-top" alt="...">
            @endif
            <div class="card-body">
                <h5 class="card-title">{{ $product->name }}</h5>
                <p class="card-text">{{ $product->description }}</p>
                <h3>R$ {{ number_format($product->price, 2, ',', '.') }}</h3>
                <a href="{{ route('product.single', ['slug' => $product->slug]) }}" class="btn btn-success">Ver produto</a>
            </div>
        </div>
    </div>
    @if(($key + 1) % 3 == 0) <div class="row"></div> @endif
    @endforeach
    @else
    <div class="col-12">
        <h3 class="alert alert-warning">Nenhum produto encontrado para essa loja.</h3>
    </div>
    @endif
</div>

@endsection