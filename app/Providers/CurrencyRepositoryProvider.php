<?php

namespace App\Providers;

use App\Interfaces\CurrencyRepositoryInterface;
use App\Repositories\CurrencyRepository;
use Illuminate\Support\ServiceProvider;

class CurrencyRepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(CurrencyRepositoryInterface::class, CurrencyRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
