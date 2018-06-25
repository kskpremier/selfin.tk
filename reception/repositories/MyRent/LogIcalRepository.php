<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\LogIcal;
use reception\repositories\NotFoundException;

class LogIcalRepository 
{
    public function get($id): LogIcal    {
         if (! $logIcal = LogIcal::findOne($id)) {
            throw new NotFoundException('LogIcal is not found.');
        }
    return  $logIcal;
    }
    
    public function save(LogIcal  $logIcal): void
    {
        if (! $logIcal->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(LogIcal  $logIcal): void
    {
        if (! $logIcal->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

