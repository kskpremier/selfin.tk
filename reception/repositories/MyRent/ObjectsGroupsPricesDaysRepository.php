<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\ObjectsGroupsPricesDays;
use reception\repositories\NotFoundException;

class ObjectsGroupsPricesDaysRepository 
{
    public function get($id): ObjectsGroupsPricesDays    {
         if (! $objectsGroupsPricesDays = ObjectsGroupsPricesDays::findOne($id)) {
            throw new NotFoundException('ObjectsGroupsPricesDays is not found.');
        }
    return  $objectsGroupsPricesDays;
    }
    
    public function save(ObjectsGroupsPricesDays  $objectsGroupsPricesDays): void
    {
        if (! $objectsGroupsPricesDays->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(ObjectsGroupsPricesDays  $objectsGroupsPricesDays): void
    {
        if (! $objectsGroupsPricesDays->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

