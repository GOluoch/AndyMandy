<?php

namespace App\Providers;
use App\Article;

use Illuminate\Support\ServiceProvider;
use View;

class ComposerServiceProvider extends ServiceProvider
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
       View::composer(['partials.meta_dynamic','layouts.nav'], function($view){
           $view->with('articles', Article::where('status',1)->latest()->get());
       }); 
    }
}
