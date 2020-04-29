@extends('layouts.app')

@section('content')

    <h1>Atualizar Loja</h1>
    <form action="{{ route('stores.update', ['store' => $store->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="">Nome da Loja</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $store->name }}">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="">Descrição</label>
            <input type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ $store->description }}">
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="">Telefone</label>
            <input type="text" id="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $store->phone }}">
            @error('phone')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="">Celular/Whatsapp</label>
            <input type="text" id="mobile_phone" class="form-control @error('mobile_phone') is-invalid @enderror" name="mobile_phone" value="{{ $store->mobile_phone }}">
            @error('mobile_phone')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <p>
                <img src="{{ asset('storage/'.$store->logo) }}" alt="">
            </p>
            <label for="">Logo</label>
            <input type="file" name="logo" class="form-control @error('logo') is-invalid @enderror" multiple>
            @error('logo')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-lg btn-primary">Atualizar Loja</button>
        </div>
    </form> 

@endsection

@section('scripts')
    <script>
        let imPhone = new Inputmask("(99) 9999-9999");
        imPhone.mask(document.getElementById('phone'));

        let imMobilePhone = new Inputmask("(99) 99999-9999");
        imMobilePhone.mask(document.getElementById('mobile_phone'));
    </script>
@endsection