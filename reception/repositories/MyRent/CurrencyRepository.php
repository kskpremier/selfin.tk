<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\Currency;
use reception\repositories\NotFoundException;

class CurrencyRepository 
{
    public function get($id): Currency    {
         if (! $currency = Currency::findOne($id)) {
            throw new NotFoundException('Currency is not found.');
        }
    return  $currency;
    }
    
    public function save(Currency  $currency): void
    {
        if (! $currency->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(Currency  $currency): void
    {
        if (! $currency->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

