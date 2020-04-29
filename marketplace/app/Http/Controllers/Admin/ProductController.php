<?php

namespace App\Http\Controllers\Admin;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Traits\UploadTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    use UploadTrait;

    private $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function index()
    {
        $user = auth()->user();

        if (!$user->store()->exists()) {
            flash('Você deve criar sua loja para cadastrar os produtos')->warning();
            return redirect()->route('stores.index');
        }

        $products = $user->store->products()->paginate(10);

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = \App\Category::all(['id', 'name']);

        return view('admin.products.create', compact('categories'));
    }

    public function store(ProductRequest $request)
    {
        // DADOS
        $data = $request->all();
        $categories = $request->get('categories', null);

        $data['price'] = formatePriceToDatabase($data['price']);

        // acessando loja do usuário autenticado
        $store = auth()->user()->store;
        // criando produto para essa loja
        $product = $store->products()->create($data);
        // adicionando categorias a ese produto
        $product->categories()->sync($categories);

        // FOTOS
        if ($request->hasFile('photos')) {
            $images = $this->imageUpload($request->file('photos'), 'image');
            // inserindo imagens/referência na base
            $product->photos()->createMany($images);
        }

        flash('Produto criado com sucesso')->success();
        return redirect()->route('products.index');
    }

    public function edit($product)
    {
        $categories = \App\Category::all('id', 'name');
        $product = $this->product->findOrFail($product);

        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(ProductRequest $request, $product)
    {
        $data = $request->all();
        $categories = $request->get('categories', null);

        $data['price'] = formatePriceToDatabase($data['price']);

        $product = $this->product->find($product);
        $product->update($data);

        if (!is_null($categories)) {
            $product->categories()->sync($categories);
        }

        // FOTOS
        if ($request->hasFile('photos')) {
            $images = $this->imageUpload($request->file('photos'), 'image');
            // inserindo imagens/referência na base
            $product->photos()->createMany($images);
        }

        flash('Produto atualizado com sucesso')->success();
        return redirect()->route('products.index');
    }

    public function destroy($product)
    {
        $product = $this->product->find($product);
        $product->delete();

        flash('Produto removido com sucesso')->success();
        return redirect()->route('products.index');
    }
}
