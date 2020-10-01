<?php

namespace App\Providers;

use App\Services\Log\WeblogSortInterface;
use App\Services\Log\WeblogSortService;
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
        $this->app->bind(WeblogSortInterface::class, function () {
            return new WeblogSortService();
        });
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
