<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repository\Donate\DonateInterface;
use App\Repository\Donate\DonateRepository;

class DonateServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind(DonateInterface::class,DonateRepository::class);
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




