<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\ObjectsLeisureActivityType;
use reception\repositories\NotFoundException;

class ObjectsLeisureActivityTypeRepository 
{
    public function get($id): ObjectsLeisureActivityType    {
         if (! $objectsLeisureActivityType = ObjectsLeisureActivityType::findOne($id)) {
            throw new NotFoundException('ObjectsLeisureActivityType is not found.');
        }
    return  $objectsLeisureActivityType;
    }
    
    public function save(ObjectsLeisureActivityType  $objectsLeisureActivityType): void
    {
        if (! $objectsLeisureActivityType->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(ObjectsLeisureActivityType  $objectsLeisureActivityType): void
    {
        if (! $objectsLeisureActivityType->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

