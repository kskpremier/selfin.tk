<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\ObjectsEvisitor;
use reception\repositories\NotFoundException;

class ObjectsEvisitorRepository 
{
    public function get($id): ObjectsEvisitor    {
         if (! $objectsEvisitor = ObjectsEvisitor::findOne($id)) {
            throw new NotFoundException('ObjectsEvisitor is not found.');
        }
    return  $objectsEvisitor;
    }
    
    public function save(ObjectsEvisitor  $objectsEvisitor): void
    {
        if (! $objectsEvisitor->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(ObjectsEvisitor  $objectsEvisitor): void
    {
        if (! $objectsEvisitor->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

