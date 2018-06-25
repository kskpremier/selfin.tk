<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\Objects;
use reception\repositories\NotFoundException;

class ObjectsRepository 
{
    public function get($id): Objects    {
         if (! $objects = Objects::findOne($id)) {
            throw new NotFoundException('Objects is not found.');
        }
    return  $objects;
    }
    
    public function save(Objects  $objects): void
    {
        if (! $objects->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(Objects  $objects): void
    {
        if (! $objects->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

