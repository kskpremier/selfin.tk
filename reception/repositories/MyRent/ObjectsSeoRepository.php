<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\ObjectsSeo;
use reception\repositories\NotFoundException;

class ObjectsSeoRepository 
{
    public function get($id): ObjectsSeo    {
         if (! $objectsSeo = ObjectsSeo::findOne($id)) {
            throw new NotFoundException('ObjectsSeo is not found.');
        }
    return  $objectsSeo;
    }
    
    public function save(ObjectsSeo  $objectsSeo): void
    {
        if (! $objectsSeo->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(ObjectsSeo  $objectsSeo): void
    {
        if (! $objectsSeo->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

