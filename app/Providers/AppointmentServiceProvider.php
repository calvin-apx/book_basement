<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repository\Appointment\AppointmentInterface;
use App\Repository\Appointment\AppointmentRepository;

class AppointmentServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind(AppointmentInterface::class,AppointmentRepository::class);
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




