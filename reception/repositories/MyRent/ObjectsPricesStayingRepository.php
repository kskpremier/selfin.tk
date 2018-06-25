<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\ObjectsPricesStaying;
use reception\repositories\NotFoundException;

class ObjectsPricesStayingRepository 
{
    public function get($id): ObjectsPricesStaying    {
         if (! $objectsPricesStaying = ObjectsPricesStaying::findOne($id)) {
            throw new NotFoundException('ObjectsPricesStaying is not found.');
        }
    return  $objectsPricesStaying;
    }
    
    public function save(ObjectsPricesStaying  $objectsPricesStaying): void
    {
        if (! $objectsPricesStaying->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(ObjectsPricesStaying  $objectsPricesStaying): void
    {
        if (! $objectsPricesStaying->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

