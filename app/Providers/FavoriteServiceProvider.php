<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repository\Favorite\FavoriteInterface;
use App\Repository\Favorite\FavoriteRepository;

class FavoriteServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind(FavoriteInterface::class,FavoriteRepository::class);
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




