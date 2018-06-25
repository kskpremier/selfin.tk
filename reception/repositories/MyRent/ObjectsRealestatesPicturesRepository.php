<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\ObjectsRealestatesPictures;
use reception\repositories\NotFoundException;

class ObjectsRealestatesPicturesRepository 
{
    public function get($id): ObjectsRealestatesPictures    {
         if (! $objectsRealestatesPictures = ObjectsRealestatesPictures::findOne($id)) {
            throw new NotFoundException('ObjectsRealestatesPictures is not found.');
        }
    return  $objectsRealestatesPictures;
    }
    
    public function save(ObjectsRealestatesPictures  $objectsRealestatesPictures): void
    {
        if (! $objectsRealestatesPictures->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(ObjectsRealestatesPictures  $objectsRealestatesPictures): void
    {
        if (! $objectsRealestatesPictures->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

