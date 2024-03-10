<?php

namespace App\Listeners;

use App\Events\UpdateCurrenciesListEvent;
use App\Interfaces\CurrencyRepositoryInterface;
use App\Interfaces\ExternalBankInterface;
use App\Jobs\UpdateCurrenciesListJob;
use App\Repositories\CurrencyRepository;
use App\Services\CBRgetService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateCurrenciesListListener
{
    /**
     * Create the event listener.
     */

    public function __construct()
    {

    }

    /**
     * Handle the event.
     */
    public function handle(UpdateCurrenciesListEvent $event): void
    {
        dispatch(new UpdateCurrenciesListJob());
    }
}
