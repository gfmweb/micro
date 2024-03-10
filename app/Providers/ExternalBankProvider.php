<?php

namespace App\Providers;

use App\Interfaces\ExternalBankInterface;
use App\Services\CBRgetService;
use Illuminate\Support\ServiceProvider;

class ExternalBankProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ExternalBankInterface::class, CBRgetService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
