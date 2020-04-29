@extends('layouts.app')

@section('content')

    <h1>Atualizar Produto</h1>
    <form action="{{ route('products.update', ['product' => $product->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="">Nome do Produto</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $product->name }}">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="">Descrição</label>
            <input type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ $product->description }}">
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="">Conteúdo</label>
            <textarea name="body" id="" cols="30" rows="5" class="form-control @error('body') is-invalid @enderror" value="{{ $product->body }}"></textarea>
            @error('body')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="">Preço</label>
            <input type="text" id="price" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ $product->price }}">
            @error('price')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="">Categorias</label>
            <select name="categories[]" id="" class="form-control @error('categories') is-invalid @enderror" value="{{ $product->categories }}" multiple>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        @if($product->categories->contains($category)) selected @endif
                        >{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="">Fotos do Produto</label>
            <input type="file" name="photos[]" class="form-control @error('photos.*') is-invalid @enderror" multiple>
            @error('photos')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-lg btn-primary">Atualizar Produto</button>
        </div>
    </form> 
    <hr>
    <div class="row">
        @foreach ($product->photos as $photo)
        <div class="col-4 text-center">
            <img src="{{ asset('storage/'.$photo->image) }}" alt="" class="img-fluid">
            <form action="{{ route('photo.remove', ['photoName' => $photo->image]) }}" method="POST">
                @csrf
                <input type="hidden" name="photoName" value="{{ $photo->image }}">
                <button type="submit" class="btn btn-lg btn-danger">REMOVER</button>
            </form>
        </div>
        @endforeach
    </div>

@endsection

@section('scripts')
    <script src="https://cdn.rawgit.com/plentz/jquery-maskmoney/master/dist/jquery.maskMoney.min.js"></script>
    <script>
        $('#price').maskMoney({prefix: '', allowNegative: false, thousands: '.', decimal: ','});
    </script>
@endsection