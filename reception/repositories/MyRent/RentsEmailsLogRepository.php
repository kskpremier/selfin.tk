<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\RentsEmailsLog;
use reception\repositories\NotFoundException;

class RentsEmailsLogRepository 
{
    public function get($id): RentsEmailsLog    {
         if (! $rentsEmailsLog = RentsEmailsLog::findOne($id)) {
            throw new NotFoundException('RentsEmailsLog is not found.');
        }
    return  $rentsEmailsLog;
    }
    
    public function save(RentsEmailsLog  $rentsEmailsLog): void
    {
        if (! $rentsEmailsLog->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(RentsEmailsLog  $rentsEmailsLog): void
    {
        if (! $rentsEmailsLog->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

