<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\LogUnitsFis;
use reception\repositories\NotFoundException;

class LogUnitsFisRepository 
{
    public function get($id): LogUnitsFis    {
         if (! $logUnitsFis = LogUnitsFis::findOne($id)) {
            throw new NotFoundException('LogUnitsFis is not found.');
        }
    return  $logUnitsFis;
    }
    
    public function save(LogUnitsFis  $logUnitsFis): void
    {
        if (! $logUnitsFis->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(LogUnitsFis  $logUnitsFis): void
    {
        if (! $logUnitsFis->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

