<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repository\Book\BookInterface;
use App\Repository\Book\BookRepository;

class BookServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind(BookInterface::class,BookRepository::class);
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




