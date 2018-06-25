<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\CurrencyExchange;
use reception\repositories\NotFoundException;

class CurrencyExchangeRepository 
{
    public function get($id): CurrencyExchange    {
         if (! $currencyExchange = CurrencyExchange::findOne($id)) {
            throw new NotFoundException('CurrencyExchange is not found.');
        }
    return  $currencyExchange;
    }
    
    public function save(CurrencyExchange  $currencyExchange): void
    {
        if (! $currencyExchange->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(CurrencyExchange  $currencyExchange): void
    {
        if (! $currencyExchange->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

