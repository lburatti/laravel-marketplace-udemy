<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category1 = Category::create([
            'name' => 'Livros',
            'description' => 'Livros diversos',
        ]);

        $category2 = Category::create([
            'name' => 'Fones',
            'description' => 'Fones diversos',
        ]);

        $category3 = Category::create([
            'name' => 'Notebooks',
            'description' => 'Notebooks diversos',
        ]);

        $category4 = Category::create([
            'name' => 'Celulares',
            'description' => 'Celulares diversos',
        ]);
    }
}
