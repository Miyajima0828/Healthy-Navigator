<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Meal\getMealService;
use App\Services\Meal\getMealServiceInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            getMealServiceInterface::class,
            getMealService::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
