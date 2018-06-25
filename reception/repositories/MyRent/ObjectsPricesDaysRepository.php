<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\ObjectsPricesDays;
use reception\repositories\NotFoundException;

class ObjectsPricesDaysRepository 
{
    public function get($id): ObjectsPricesDays    {
         if (! $objectsPricesDays = ObjectsPricesDays::findOne($id)) {
            throw new NotFoundException('ObjectsPricesDays is not found.');
        }
    return  $objectsPricesDays;
    }
    
    public function save(ObjectsPricesDays  $objectsPricesDays): void
    {
        if (! $objectsPricesDays->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(ObjectsPricesDays  $objectsPricesDays): void
    {
        if (! $objectsPricesDays->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

