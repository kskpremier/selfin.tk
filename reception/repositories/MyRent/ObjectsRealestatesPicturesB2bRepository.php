<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\ObjectsRealestatesPicturesB2b;
use reception\repositories\NotFoundException;

class ObjectsRealestatesPicturesB2bRepository 
{
    public function get($id): ObjectsRealestatesPicturesB2b    {
         if (! $objectsRealestatesPicturesB2b = ObjectsRealestatesPicturesB2b::findOne($id)) {
            throw new NotFoundException('ObjectsRealestatesPicturesB2b is not found.');
        }
    return  $objectsRealestatesPicturesB2b;
    }
    
    public function save(ObjectsRealestatesPicturesB2b  $objectsRealestatesPicturesB2b): void
    {
        if (! $objectsRealestatesPicturesB2b->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(ObjectsRealestatesPicturesB2b  $objectsRealestatesPicturesB2b): void
    {
        if (! $objectsRealestatesPicturesB2b->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

