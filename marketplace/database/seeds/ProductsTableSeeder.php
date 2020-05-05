<?php

use App\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product1 = Product::create([
            'store_id' => 1,
            'name' => 'O senhor dos anéis',
            'description' => 'O senhor dos anéis',
            'body' => 'Livro: O senhor dos anéis',
            'price' => 29.90,
        ]);

        $product2 = Product::create([
            'store_id' => 1,
            'name' => 'Como eu era antes de você',
            'description' => 'Como eu era antes de você',
            'body' => 'Livro: Como eu era antes de você',
            'price' => 25.60,
        ]);

        $product3 = Product::create([
            'store_id' => 1,
            'name' => 'Marley e eu',
            'description' => 'Marley e eu',
            'body' => 'Livro: Marley e eu',
            'price' => 19.80,
        ]);

        $product4 = Product::create([
            'store_id' => 2,
            'name' => 'Fone de ouvido',
            'description' => 'Fone de ouvido',
            'body' => 'Produto: Fone de ouvido',
            'price' => 48.90,
        ]);

        $product5 = Product::create([
            'store_id' => 2,
            'name' => 'Notebook',
            'description' => 'Notebook ...',
            'body' => 'Produto: Notebook',
            'price' => 2400.00,
        ]);

        $product6 = Product::create([
            'store_id' => 2,
            'name' => 'Celular',
            'description' => 'Celular...',
            'body' => 'Produto: Celular',
            'price' => 1099.99,
        ]);
    }
}
