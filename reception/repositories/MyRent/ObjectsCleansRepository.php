<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\ObjectsCleans;
use reception\repositories\NotFoundException;

class ObjectsCleansRepository 
{
    public function get($id): ObjectsCleans    {
         if (! $objectsCleans = ObjectsCleans::findOne($id)) {
            throw new NotFoundException('ObjectsCleans is not found.');
        }
    return  $objectsCleans;
    }
    
    public function save(ObjectsCleans  $objectsCleans): void
    {
        if (! $objectsCleans->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(ObjectsCleans  $objectsCleans): void
    {
        if (! $objectsCleans->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

