@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-12 orders-notifications pt-3">
    <h2 class="card-title my-0">Notificações de Pedidos Recebidos</h2>
    @if($unreadNotifications->count())
      <a href="{{ route('notifications.readAll') }}" class="btn btn-lg btn-primary float-right">Marcar todas como lidas</a>
    @endif
  </div>

  <div class="col-12">
  <hr>

    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">Notificação</th>
          <th scope="col">Criado em:</th>
          <th scope="col">Ações</th>
        </tr>
      </thead>
      <tbody>
        @forelse($unreadNotifications as $n)
        <tr>
          <td scope="row">{{ $n->data['message'] }}</td>
          <td>{{ $n->created_at->format('d/m/Y H:i:s') }}</td>
          <td>
            <div class="btn-group">
              <a href="{{ route('notifications.read', ['notification' => $n->id ]) }}" class="btn btn-sm btn-primary">
                <i class="fa fa-check"></i>
              </a>
            </div>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="3">
            <div class="alert alert-warning">Nenhuma notificação encontrada.</div>
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
<hr>

@endsection