<?php

namespace App\Services;

use App\Exceptions\getBankDataException;
use App\Interfaces\ExternalBankInterface;
use Illuminate\Support\Facades\Http;

class CBRgetService implements ExternalBankInterface
{
    private $bankResponse;
    public function getBankData():ExternalBankInterface
    {
        try {
            $response = Http::get(config('externalAPIpoints.cbrf'));
        }
        catch (\Exception ) {
            throw new getBankDataException('Не удалось связаться с Центральным Банком');
        }
        $this->bankResponse =  $response->body();
        return $this;
    }

    public function Map(ExternalBankInterface $bankData, string $format = 'parent'):mixed
    {
        $xml = simplexml_load_string($bankData->bankResponse);
        if($format === 'json') return json_encode($xml,256);
        elseif ($format === 'object') return json_decode(json_encode($xml,256));
        elseif($format === 'array') return json_decode(json_encode($xml,256));
        return $bankData->bankResponse;
    }
}
