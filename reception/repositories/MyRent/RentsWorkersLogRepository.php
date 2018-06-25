<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\RentsWorkersLog;
use reception\repositories\NotFoundException;

class RentsWorkersLogRepository 
{
    public function get($id): RentsWorkersLog    {
         if (! $rentsWorkersLog = RentsWorkersLog::findOne($id)) {
            throw new NotFoundException('RentsWorkersLog is not found.');
        }
    return  $rentsWorkersLog;
    }
    
    public function save(RentsWorkersLog  $rentsWorkersLog): void
    {
        if (! $rentsWorkersLog->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(RentsWorkersLog  $rentsWorkersLog): void
    {
        if (! $rentsWorkersLog->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

