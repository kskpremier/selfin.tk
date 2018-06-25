<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\ObjectsCancellations;
use reception\repositories\NotFoundException;

class ObjectsCancellationsRepository 
{
    public function get($id): ObjectsCancellations    {
         if (! $objectsCancellations = ObjectsCancellations::findOne($id)) {
            throw new NotFoundException('ObjectsCancellations is not found.');
        }
    return  $objectsCancellations;
    }
    
    public function save(ObjectsCancellations  $objectsCancellations): void
    {
        if (! $objectsCancellations->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(ObjectsCancellations  $objectsCancellations): void
    {
        if (! $objectsCancellations->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

