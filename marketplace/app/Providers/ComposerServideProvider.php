<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ComposerServideProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // $categories = \App\Category::all(['name', 'slug']);

        // view()->share('categories', $categories); // Método share() -> todas as views

        // view()->composer(['*'], function($view) use($categories) { // Método composer() -> pode definir quais views
        //     $view->with('categories', $categories);
        // });

        // MELHOR FORMA, COM CLASSE SEPARADA
        view()->composer('layouts.front', 'App\Http\Views\CategoryViewComposer@compose'); // Método composer() -> isolando function numa classe
    }
}
