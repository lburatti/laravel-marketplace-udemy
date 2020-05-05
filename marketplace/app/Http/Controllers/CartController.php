<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->has('cart') ? session()->get('cart') : [];
        return view('cart', compact('cart'));
    }

    public function add(Request $request)
    {
        $productData = $request->get('product');

        $product = \App\Product::whereSlug($productData['slug']);

        // se não tiver produto com esse slug ou quantidade igual a 0
        if(!$product->count() || $productData['amount'] <= 0) 
            return redirect()->route('home');

        // comparando dados vindos do form x banco de dados
        $product = $product->first(['id', 'name', 'price', 'store_id'])->toArray();
        $product = array_merge($productData, $product); // 2º parâmetro sobrescreve

        // verificando se existe sessão para produtos
        if (session()->has('cart')) {
            // todos os produtos da session
            $products = session()->get('cart');
            // pegando o slug desses produtos
            $productsSlugs = array_column($products, 'slug');
            
            if(in_array($product['slug'], $productsSlugs)) {
                // produtos iguais -> incrementando quantidade
                $products = $this->productIncrement($product['slug'], $product['amount'], $products);
                session()->put('cart', $products);
            } else {
                // adicionar novos produtos na sessão
            session()->push('cart', $product);
            }
        } else {
            // criar sessão e adicionar produto
            $products[] = $product;
            session()->put('cart', $products);
        }

        flash('Produto adicionado no carrinho')->success();
        // return redirect()->route('product.single', ['slug' => $product['slug']]);
        return redirect()->route('cart.index');
    }

    public function remove($slug)
    {
        if (!session()->has('cart')) {
            return redirect()->route('cart.index');
        }

        $products = session()->get('cart');
        // array_filter($array a ser filtrado, function p/ condições desses filtros)
        // filtrando slugs que não sejam iguais ao passado na url
        $products = array_filter($products, function ($line) use ($slug) {
            return $line['slug'] != $slug;
        });

        session()->put('cart', $products);
        return redirect()->route('cart.index');
    }

    public function cancel()
    {
        session()->forget('cart');

        flash('Compra cancelada com sucesso')->success();
        return redirect()->route('cart.index');
    }

    private function productIncrement($slug, $amount, $products)
    {
        $products = array_map(function ($line) use ($slug, $amount) {
            // quando a line do slug passado = slug da session, aumentar quantidade (amount)
            if ($slug == $line['slug']) {
                $line['amount'] += $amount;
            }
            return $line;
        }, $products);

        return $products;
    }
}
