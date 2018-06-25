<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\ObjectsRealestatesDescriptions;
use reception\repositories\NotFoundException;

class ObjectsRealestatesDescriptionsRepository 
{
    public function get($id): ObjectsRealestatesDescriptions    {
         if (! $objectsRealestatesDescriptions = ObjectsRealestatesDescriptions::findOne($id)) {
            throw new NotFoundException('ObjectsRealestatesDescriptions is not found.');
        }
    return  $objectsRealestatesDescriptions;
    }
    
    public function save(ObjectsRealestatesDescriptions  $objectsRealestatesDescriptions): void
    {
        if (! $objectsRealestatesDescriptions->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(ObjectsRealestatesDescriptions  $objectsRealestatesDescriptions): void
    {
        if (! $objectsRealestatesDescriptions->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

