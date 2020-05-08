@extends('layouts.app')

@section('content')
<div class="row admin-create-edit">
    <div class="col-12">
        <h2 class="card-title my-0">Criar Produto</h2>
        <hr>
    </div>

    <div class="col-12">
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group my-1">
                <label class="col-form-label" for="">Nome do Produto</label>
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
            <div class="form-group my-1">
                <label class="col-form-label" for="">Conteúdo</label>
                <textarea name="body" id="" cols="30" rows="5" class="form-control @error('body') is-invalid @enderror" value="{{ old('body') }}"></textarea>
                @error('body')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group my-1">
                <label class="col-form-label" for="">Preço</label>
                <input type="text" id="price" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}">
                @error('price')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group my-1">
                <label class="col-form-label" for="">Categorias</label>
                <select name="categories[]" id="" class="form-control" multiple>
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group my-1">
                <label class="col-form-label" for="">Fotos do Produto</label>
                <input type="file" name="photos[]" class="form-control @error('photos.*') is-invalid @enderror" multiple>
                @error('photos')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group my-4">
                <button type="submit" class="btn btn-lg btn-primary float-right">Criar Produto</button>
            </div>
        </form>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://cdn.rawgit.com/plentz/jquery-maskmoney/master/dist/jquery.maskMoney.min.js"></script>
<script>
    $('#price').maskMoney({
        prefix: '',
        allowNegative: false,
        thousands: '.',
        decimal: ','
    });
</script>
@endsection