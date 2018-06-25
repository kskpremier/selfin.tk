<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\ObjectsRealestatesDescriptionsB2b;
use reception\repositories\NotFoundException;

class ObjectsRealestatesDescriptionsB2bRepository 
{
    public function get($id): ObjectsRealestatesDescriptionsB2b    {
         if (! $objectsRealestatesDescriptionsB2b = ObjectsRealestatesDescriptionsB2b::findOne($id)) {
            throw new NotFoundException('ObjectsRealestatesDescriptionsB2b is not found.');
        }
    return  $objectsRealestatesDescriptionsB2b;
    }
    
    public function save(ObjectsRealestatesDescriptionsB2b  $objectsRealestatesDescriptionsB2b): void
    {
        if (! $objectsRealestatesDescriptionsB2b->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(ObjectsRealestatesDescriptionsB2b  $objectsRealestatesDescriptionsB2b): void
    {
        if (! $objectsRealestatesDescriptionsB2b->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

