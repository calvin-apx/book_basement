<?php

namespace App\Providers;

use App\Repository\BuyBook\BuyBookInterface;
use App\Repository\BuyBook\BuyBookRepository;
use Illuminate\Support\ServiceProvider;

class BuyBookServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind(BuyBookInterface::class,BuyBookRepository::class);
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




