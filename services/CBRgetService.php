<?php

namespace services;

use Illuminate\Support\Facades\Http;

class CBRgetService
{
    private $cbrResponse;

    public function __construct()
    {

    }
    public function getCBRValues():array
    {
        $this->cbrResponse = Http::get('http://www.cbr.ru/scripts/XML_daily.asp');
        return ['cbrRow'=>$this->cbrResponse];
    }
}
