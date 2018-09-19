<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
       view()->composer('layouts.categories', function($view) {
            $view->with('categories',  \App\Category::all());
       });

       view()->composer('videos.upload', function($view) {
        $view->with('categories',  \App\Category::all());
        });

        view()->composer('videos.index', function($view) {
            $view->with('videos',  \App\Video::all());
            });
    

    
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
