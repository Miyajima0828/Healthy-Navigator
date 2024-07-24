<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Meal\GetMealService;
use App\Services\Meal\GetMealServiceInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            GetMealServiceInterface::class,
            GetMealService::class
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
