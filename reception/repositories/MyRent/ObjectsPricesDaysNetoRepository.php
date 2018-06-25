<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\ObjectsPricesDaysNeto;
use reception\repositories\NotFoundException;

class ObjectsPricesDaysNetoRepository 
{
    public function get($id): ObjectsPricesDaysNeto    {
         if (! $objectsPricesDaysNeto = ObjectsPricesDaysNeto::findOne($id)) {
            throw new NotFoundException('ObjectsPricesDaysNeto is not found.');
        }
    return  $objectsPricesDaysNeto;
    }
    
    public function save(ObjectsPricesDaysNeto  $objectsPricesDaysNeto): void
    {
        if (! $objectsPricesDaysNeto->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(ObjectsPricesDaysNeto  $objectsPricesDaysNeto): void
    {
        if (! $objectsPricesDaysNeto->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

