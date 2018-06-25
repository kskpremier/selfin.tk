<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\LogB2b;
use reception\repositories\NotFoundException;

class LogB2bRepository 
{
    public function get($id): LogB2b    {
         if (! $logB2b = LogB2b::findOne($id)) {
            throw new NotFoundException('LogB2b is not found.');
        }
    return  $logB2b;
    }
    
    public function save(LogB2b  $logB2b): void
    {
        if (! $logB2b->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(LogB2b  $logB2b): void
    {
        if (! $logB2b->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

