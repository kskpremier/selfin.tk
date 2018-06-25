<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\ObjectRealstateMailDescription;
use reception\repositories\NotFoundException;

class ObjectRealstateMailDescriptionRepository 
{
    public function get($id): ObjectRealstateMailDescription    {
         if (! $objectRealstateMailDescription = ObjectRealstateMailDescription::findOne($id)) {
            throw new NotFoundException('ObjectRealstateMailDescription is not found.');
        }
    return  $objectRealstateMailDescription;
    }
    
    public function save(ObjectRealstateMailDescription  $objectRealstateMailDescription): void
    {
        if (! $objectRealstateMailDescription->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(ObjectRealstateMailDescription  $objectRealstateMailDescription): void
    {
        if (! $objectRealstateMailDescription->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

