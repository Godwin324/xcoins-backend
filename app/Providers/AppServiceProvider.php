<?php

namespace App\Providers;

use App\Models\ExchangeRate;
use TCG\Voyager\Facades\Voyager;
use App\Observers\ExchangeRateObserver;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $this->app->singleton('VoyagerGuard', function () {
            return 'admin';
        });

        ExchangeRate::observe(ExchangeRateObserver::class);

    }
}
