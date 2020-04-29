@extends('layouts.app')

@section('content')

    <h1>Atualizar Categoria</h1>
    <form action="{{ route('categories.update', ['category' => $category->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="">Nome da Loja</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $category->name }}">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="">Descrição</label>
            <input type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ $category->description }}">
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-lg btn-primary">Atualizar Categoria</button>
        </div>
    </form> 

@endsection

