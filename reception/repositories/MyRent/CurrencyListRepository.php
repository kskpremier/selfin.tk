<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\CurrencyList;
use reception\repositories\NotFoundException;

class CurrencyListRepository 
{
    public function get($id): CurrencyList    {
         if (! $currencyList = CurrencyList::findOne($id)) {
            throw new NotFoundException('CurrencyList is not found.');
        }
    return  $currencyList;
    }
    
    public function save(CurrencyList  $currencyList): void
    {
        if (! $currencyList->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(CurrencyList  $currencyList): void
    {
        if (! $currencyList->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

