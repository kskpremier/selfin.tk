<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\ObjectsTravelTime;
use reception\repositories\NotFoundException;

class ObjectsTravelTimeRepository 
{
    public function get($id): ObjectsTravelTime    {
         if (! $objectsTravelTime = ObjectsTravelTime::findOne($id)) {
            throw new NotFoundException('ObjectsTravelTime is not found.');
        }
    return  $objectsTravelTime;
    }
    
    public function save(ObjectsTravelTime  $objectsTravelTime): void
    {
        if (! $objectsTravelTime->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(ObjectsTravelTime  $objectsTravelTime): void
    {
        if (! $objectsTravelTime->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

