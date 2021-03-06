<?php

use App\Store;
use Illuminate\Database\Seeder;

class StoreTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $store1 = Store::create([
            'user_id' => 3,
            'name' => 'Livraria',
            'description' => 'Loja de livros com diversas opções',
            'phone' => '1122332233',
            'mobile_phone' => '11988558855',
        ]);

        $store2 = Store::create([
            'user_id' => 4,
            'name' => 'Produtos eletrônicos',
            'description' => 'Loja de produtos eletrônicos diversos',
            'phone' => '1155446655',
            'mobile_phone' => '11989988998',
        ]);

        $store2 = Store::create([
            'user_id' => 6,
            'name' => 'Presentes',
            'description' => 'Loja de presentes',
            'phone' => '1145451212',
            'mobile_phone' => '1198659865',
        ]);
        

        // $stores = App\Store::all();
        // // buscando todas as stores, e para cada store serão criados products
        // foreach($stores as $store) {
        //     $store->products()->save(factory(App\Product::class)->make());
        // }
    }
}
