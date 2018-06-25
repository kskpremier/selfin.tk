<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\ObjectsLeisureActivity;
use reception\repositories\NotFoundException;

class ObjectsLeisureActivityRepository 
{
    public function get($id): ObjectsLeisureActivity    {
         if (! $objectsLeisureActivity = ObjectsLeisureActivity::findOne($id)) {
            throw new NotFoundException('ObjectsLeisureActivity is not found.');
        }
    return  $objectsLeisureActivity;
    }
    
    public function save(ObjectsLeisureActivity  $objectsLeisureActivity): void
    {
        if (! $objectsLeisureActivity->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(ObjectsLeisureActivity  $objectsLeisureActivity): void
    {
        if (! $objectsLeisureActivity->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

