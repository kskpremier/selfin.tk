<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\RentsLog;
use reception\repositories\NotFoundException;

class RentsLogRepository 
{
    public function get($id): RentsLog    {
         if (! $rentsLog = RentsLog::findOne($id)) {
            throw new NotFoundException('RentsLog is not found.');
        }
    return  $rentsLog;
    }
    
    public function save(RentsLog  $rentsLog): void
    {
        if (! $rentsLog->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(RentsLog  $rentsLog): void
    {
        if (! $rentsLog->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

