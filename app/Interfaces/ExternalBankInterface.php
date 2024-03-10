<?php

namespace App\Interfaces;

interface ExternalBankInterface
{
    public function getBankData():ExternalBankInterface;
    public function Map(ExternalBankInterface $bankData, string $format = 'parent'):mixed;
}
