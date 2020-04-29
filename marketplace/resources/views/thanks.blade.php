@extends('layouts.front')

@section('content')
    <h2 class="alert-success">
        Muito obrigado por sua compra!
    </h2>
    <h3>
        Seu pedido foi processado. O código do seu pedido é: {{request()->get('order')}}
    </h3>

@endsection