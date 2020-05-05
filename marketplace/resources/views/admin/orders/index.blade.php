@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <h2 class="card-title pt-3">Pedidos Recebidos</h2>
        <hr>
    </div>
    <div class="col-12 pt-3">
        <div>
            @forelse($orders as $key => $order)
            <div class="card">
                <div class="card-header">
                    <div class="row my-orders">
                        <h6 class="mb-0 px-3"><strong>Pedido nº: {{$order->reference}}</strong></h6>
                        <h6 class="mb-0 px-1">Data: {{$order->created_at->format('d/m/Y H:i:s')}}</h6>
                    </div>
                </div>

                <div>
                    <div class="card-body">
                        <ul class="px-3">
                            @php $items = unserialize($order->items); @endphp
                            @foreach(filterItemsByStoreId($items, auth()->user()->store->id) as $item)
                            <li>
                                <strong>Produto: {{$item['name']}}</strong>
                                <br>
                                Preço: R$ {{number_format($item['price'], 2, ',', '.')}}
                                <br>
                                Quantidade: {{ $item['amount']}}
                                <br>
                                <strong>Total: R$ {{number_format(($item['price'] * $item['amount']), 2, ',', '.')}}</strong>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            @empty
            <div class="alert alert-warning">Nenhum pedido recebido</div>
            @endforelse
        </div>
        <hr>
        <div class="col-12">
            {{ $orders->links() }}
        </div>
    </div>
</div>
@endsection