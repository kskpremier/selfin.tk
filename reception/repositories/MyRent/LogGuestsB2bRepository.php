<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\LogGuestsB2b;
use reception\repositories\NotFoundException;

class LogGuestsB2bRepository 
{
    public function get($id): LogGuestsB2b    {
         if (! $logGuestsB2b = LogGuestsB2b::findOne($id)) {
            throw new NotFoundException('LogGuestsB2b is not found.');
        }
    return  $logGuestsB2b;
    }
    
    public function save(LogGuestsB2b  $logGuestsB2b): void
    {
        if (! $logGuestsB2b->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(LogGuestsB2b  $logGuestsB2b): void
    {
        if (! $logGuestsB2b->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

