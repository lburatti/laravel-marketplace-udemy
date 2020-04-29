<?php

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
        $stores = App\Store::all();
        // buscando todas as stores, e para cada store serão criados products
        foreach($stores as $store) {
            $store->products()->save(factory(App\Product::class)->make());
        }
    }
}
