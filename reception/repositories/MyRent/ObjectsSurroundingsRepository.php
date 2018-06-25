<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\ObjectsSurroundings;
use reception\repositories\NotFoundException;

class ObjectsSurroundingsRepository 
{
    public function get($id): ObjectsSurroundings    {
         if (! $objectsSurroundings = ObjectsSurroundings::findOne($id)) {
            throw new NotFoundException('ObjectsSurroundings is not found.');
        }
    return  $objectsSurroundings;
    }
    
    public function save(ObjectsSurroundings  $objectsSurroundings): void
    {
        if (! $objectsSurroundings->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(ObjectsSurroundings  $objectsSurroundings): void
    {
        if (! $objectsSurroundings->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

