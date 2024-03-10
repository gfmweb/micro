<?php

namespace App\Interfaces;
use Illuminate\Database\Eloquent\Collection;

interface CurrencyRepositoryInterface
{
    public function checkRedisCurrenciesList():bool;
    public function checkDBCurrenciesList():bool;
    public function getCurrenciesList():mixed;
    public function getRedisCurrenciesList():array;
    public function getDBCurrenciesList():Collection;
    public function setRedisCurrenciesList(Collection $collection):void;
    public function updateDBCurrenciesList(array $collection):void;
}
