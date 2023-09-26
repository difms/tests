<?php

namespace App\Providers;

use App\Services\CategoryFilter;
use App\Contracts\iCategoryFilter;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->bindClasses();
    }

    private function bindClasses(): void
    {
        $this->app->bind(iCategoryFilter::class, CategoryFilter::class);
    }
}
