<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\ObjectsPricesDiscounts;
use reception\repositories\NotFoundException;

class ObjectsPricesDiscountsRepository 
{
    public function get($id): ObjectsPricesDiscounts    {
         if (! $objectsPricesDiscounts = ObjectsPricesDiscounts::findOne($id)) {
            throw new NotFoundException('ObjectsPricesDiscounts is not found.');
        }
    return  $objectsPricesDiscounts;
    }
    
    public function save(ObjectsPricesDiscounts  $objectsPricesDiscounts): void
    {
        if (! $objectsPricesDiscounts->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(ObjectsPricesDiscounts  $objectsPricesDiscounts): void
    {
        if (! $objectsPricesDiscounts->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

