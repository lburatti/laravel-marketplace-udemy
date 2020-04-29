@extends('layouts.app')

@section('content')

    <h1>Criar Categoria</h1>
    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="">Nome da Categoria</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="">Descrição</label>
            <input type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}">
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-lg btn-primary">Criar Categoria</button>
        </div>
    </form> 

@endsection

