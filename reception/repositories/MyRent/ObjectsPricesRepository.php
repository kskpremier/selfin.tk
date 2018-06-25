<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\ObjectsPrices;
use reception\repositories\NotFoundException;

class ObjectsPricesRepository 
{
    public function get($id): ObjectsPrices    {
         if (! $objectsPrices = ObjectsPrices::findOne($id)) {
            throw new NotFoundException('ObjectsPrices is not found.');
        }
    return  $objectsPrices;
    }
    
    public function save(ObjectsPrices  $objectsPrices): void
    {
        if (! $objectsPrices->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(ObjectsPrices  $objectsPrices): void
    {
        if (! $objectsPrices->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

