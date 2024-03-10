<?php

namespace App\UseCases;

use App\Interfaces\CurrencyRepositoryInterface;

class Currencies
{
   private $repository;
   public function __construct(CurrencyRepositoryInterface $repository)
   {
        $this->repository = $repository;
   }

   public function getCurenciesList():array
   {
        return $this->repository->getCurrenciesList();
   }


}
