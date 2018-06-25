<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\ObjectsRealestates;
use reception\repositories\NotFoundException;

class ObjectsRealestatesRepository 
{
    public function get($id): ObjectsRealestates    {
         if (! $objectsRealestates = ObjectsRealestates::findOne($id)) {
            throw new NotFoundException('ObjectsRealestates is not found.');
        }
    return  $objectsRealestates;
    }
    
    public function save(ObjectsRealestates  $objectsRealestates): void
    {
        if (! $objectsRealestates->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(ObjectsRealestates  $objectsRealestates): void
    {
        if (! $objectsRealestates->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

