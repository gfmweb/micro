<?php

namespace App\Jobs;

use App\Interfaces\CurrencyRepositoryInterface;
use App\Interfaces\ExternalBankInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateCurrenciesListJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */

    public function __construct()
    {

    }

    /**
     * Execute the job.
     */
    public function handle(CurrencyRepositoryInterface $repository,ExternalBankInterface $externalBank): void
    {
            $data =$externalBank->Map($externalBank->getBankData(),'object');
            $repository->updateDBCurrenciesList($data->Valute);
    }
}
