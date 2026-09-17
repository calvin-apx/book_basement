<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repository\Cartlist\CartListInterface;
use App\Repository\Cartlist\CartListRepository;

class CartListServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind(CartListInterface::class,CartListRepository::class);
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




