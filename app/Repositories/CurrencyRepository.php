<?php

namespace App\Repositories;

use App\Events\UpdateCurrenciesListEvent;
use App\Exceptions\CurrencyRepositoryException;
use App\Interfaces\CurrencyRepositoryInterface;
use App\Models\Currency;
use Illuminate\Support\Facades\Redis;
use Illuminate\Database\Eloquent\Collection;

class CurrencyRepository implements CurrencyRepositoryInterface
{

    private $redis;

    public function __construct()
    {
        $this->redis = Redis::connection();
    }

    /**
     * @return bool
     * Проверяет содержаться ли валюты в РЕДИСЕ
     */

    public function checkRedisCurrenciesList(): bool
    {
        return $this->redis->command('EXISTS',['currencies']);
    }

    /**
     * @return bool
     * Проверяет содержаться ли валюты в БД
     */
    public function checkDBCurrenciesList(): bool
    {
        return  Currency::exists();
    }

    /**
     * @return mixed
     * Возвращает список валют, вызывает обновление списков в Редисе и в БД
     *
     */
    public function getCurrenciesList(): mixed
    {
        if(!$this->checkRedisCurrenciesList()){
              if(!$this->checkDBCurrenciesList()) {
                  event(new UpdateCurrenciesListEvent());
                  throw new CurrencyRepositoryException('Обновляется список доступных валют. Повторите запрос позже');
              }
              else{
                    $this->setRedisCurrenciesList($this->getDBCurrenciesList());
                    return $this->getRedisCurrenciesList();
              }
        }
        return $this->getRedisCurrenciesList();
    }

    /**
     * @return array
     * Возвращает список валют из редиса
     */
    public function getRedisCurrenciesList(): array
    {
        return json_decode($this->redis->command('GET',['currencies']),true);
    }

    /**
     * @param array $collection
     * @return void
     * Записывает в редис список валют
     */
    public function setRedisCurrenciesList(Collection $collection): void
    {
        $redisData = [];
        foreach ($collection as $currency)
        {
            $redisData[] = [
                'id'        =>  $currency->id,
                'NumCode'   =>  $currency->NumCode,
                'CharCode'  =>  $currency->CharCode,
                'Name'      =>  $currency->Name
            ];
        }
        $this->redis->command('SET',['currencies',json_encode($redisData,256)]);

    }

    /**
     * @param array $collection
     * @return void
     * Добавляет в список валют новую запись в БД
     */
    public function updateDBCurrenciesList(array $collection): void
    {
        foreach ($collection as $element){
           $currency = Currency::firstOrNew(
                [
                    'NumCode'=>$element->NumCode,
                    'CharCode'=>$element->CharCode,
                    'Name'=>$element->Name,
                ]
            );
           $currency->save();
        }
    }

    /**
     * @return array
     * Получает список валют из базы данных
     */
    public function getDBCurrenciesList():Collection
    {
        return Currency::all();
    }


}
