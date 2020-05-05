@extends('layouts.front')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h2 class="card-title py-3 alert alert-success">
            Muito obrigado por sua compra!
        </h2>
        <hr>
        <h3 class="card-subtitle p-2">
            Seu pedido foi processado. O código do seu pedido é: <strong>{{request()->get('order')}}</strong>
        </h3>
    </div>

</div>

@endsection