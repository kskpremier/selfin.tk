<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\ObjectsPricesNeto;
use reception\repositories\NotFoundException;

class ObjectsPricesNetoRepository 
{
    public function get($id): ObjectsPricesNeto    {
         if (! $objectsPricesNeto = ObjectsPricesNeto::findOne($id)) {
            throw new NotFoundException('ObjectsPricesNeto is not found.');
        }
    return  $objectsPricesNeto;
    }
    
    public function save(ObjectsPricesNeto  $objectsPricesNeto): void
    {
        if (! $objectsPricesNeto->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(ObjectsPricesNeto  $objectsPricesNeto): void
    {
        if (! $objectsPricesNeto->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

