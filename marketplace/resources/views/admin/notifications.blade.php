@extends('layouts.app')

@section('content')

@if($unreadNotifications->count())
<div class="row mt-3">
  <div class="col-12">
    <a href="{{ route('notifications.readAll') }}" class="btn btn-lg btn-success">Marcar todas como lidas</a>
    <hr>
  </div>
</div>
@endif

<table class="table table-hover mt-2">
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
          <a href="{{ route('notifications.read', ['notification' => $n->id ]) }}" class="btn btn-sm btn-primary">Marcar como lida</a>
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

@endsection