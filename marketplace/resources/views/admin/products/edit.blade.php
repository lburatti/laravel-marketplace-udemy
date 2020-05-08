@extends('layouts.app')

@section('content')
<div class="row admin-create-edit">
    <div class="col-12">
        <h2 class="card-title my-0">Atualizar Produto</h2>
        <hr>
    </div>

    <div class="col-12">
        <form action="{{ route('products.update', ['product' => $product->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group my-1">
                <label class="col-form-label" for="">Nome do Produto</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $product->name }}">
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group my-1">
                <label class="col-form-label" for="">Descrição</label>
                <input type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ $product->description }}">
                @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group my-1">
                <label class="col-form-label" for="">Conteúdo</label>
                <textarea name="body" id="" cols="30" rows="5" class="form-control @error('body') is-invalid @enderror" value="{{ $product->body }}"></textarea>
                @error('body')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group my-1">
                <label class="col-form-label" for="">Preço</label>
                <input type="text" id="price" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ $product->price }}">
                @error('price')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group my-1">
                <label class="col-form-label" for="">Categorias</label>
                <select name="categories[]" id="" class="form-control @error('categories') is-invalid @enderror" value="{{ $product->categories }}" multiple>
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @if($product->categories->contains($category)) selected @endif
                        >{{ $category->name }}</option>
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
                <button type="submit" class="btn btn-lg btn-primary float-right">Atualizar Produto</button>
            </div>
        </form>
    </div>
</div>
<div class="row my-3">
    <hr>
    @foreach ($product->photos as $photo)
    <div class="col-4 text-center img-products">
        <img src="{{ asset('storage/'.$photo->image) }}" alt="" class="img-fluid">
        <form action="{{ route('photo.remove', ['photoName' => $photo->image]) }}" method="POST">
            @csrf
            <input type="hidden" name="photoName" value="{{ $photo->image }}">
            <button type="submit" class="btn btn-sm btn-danger">
                <i class="fa fa-trash"></i>
            </button>
        </form>
    </div>
    @endforeach
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