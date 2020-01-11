<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Repositories\ProductRepositoryInterface',
            'App\Repositories\ProductRepository'
        );
        $this->app->bind(
            'App\Repositories\ShoppingListRepositoryInterface',
            'App\Repositories\ShoppingListRepository'
        );
        $this->app->bind(
            'App\Repositories\ShoppingListProductsRepositoryInterface',
            'App\Repositories\ShoppingListProductsRepository'
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
