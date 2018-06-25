<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\ObjectsDoorsLocks;
use reception\repositories\NotFoundException;

class ObjectsDoorsLocksRepository 
{
    public function get($id): ObjectsDoorsLocks    {
         if (! $objectsDoorsLocks = ObjectsDoorsLocks::findOne($id)) {
            throw new NotFoundException('ObjectsDoorsLocks is not found.');
        }
    return  $objectsDoorsLocks;
    }
    
    public function save(ObjectsDoorsLocks  $objectsDoorsLocks): void
    {
        if (! $objectsDoorsLocks->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(ObjectsDoorsLocks  $objectsDoorsLocks): void
    {
        if (! $objectsDoorsLocks->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

