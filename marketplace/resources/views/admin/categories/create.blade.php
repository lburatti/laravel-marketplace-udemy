@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <h2 class="card-title my-0">Criar Categoria</h2>
        <hr>
    </div>

    <div class="col-12">
        <form action="{{ route('categories.store') }}" method="POST">
            @csrf
            <div class="form-group my-1">
                <label class="col-form-label" for="">Nome da Categoria</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}">
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group my-1">
                <label class="col-form-label" for="">Descrição</label>
                <input type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}">
                @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group my-4">
                <button type="submit" class="btn btn-lg btn-primary float-right">Criar Categoria</button>
            </div>
        </form>
    </div>
</div>

        @endsection