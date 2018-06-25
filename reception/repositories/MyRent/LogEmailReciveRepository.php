<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\LogEmailRecive;
use reception\repositories\NotFoundException;

class LogEmailReciveRepository 
{
    public function get($id): LogEmailRecive    {
         if (! $logEmailRecive = LogEmailRecive::findOne($id)) {
            throw new NotFoundException('LogEmailRecive is not found.');
        }
    return  $logEmailRecive;
    }
    
    public function save(LogEmailRecive  $logEmailRecive): void
    {
        if (! $logEmailRecive->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(LogEmailRecive  $logEmailRecive): void
    {
        if (! $logEmailRecive->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

