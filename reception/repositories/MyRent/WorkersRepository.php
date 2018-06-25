<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\Workers;
use reception\repositories\NotFoundException;

class WorkersRepository 
{
    public function get($id): Workers    {
         if (! $workers = Workers::findOne($id)) {
            throw new NotFoundException('Workers is not found.');
        }
    return  $workers;
    }
    
    public function save(Workers  $workers): void
    {
        if (! $workers->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(Workers  $workers): void
    {
        if (! $workers->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

