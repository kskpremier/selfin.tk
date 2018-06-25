<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\LogSms;
use reception\repositories\NotFoundException;

class LogSmsRepository 
{
    public function get($id): LogSms    {
         if (! $logSms = LogSms::findOne($id)) {
            throw new NotFoundException('LogSms is not found.');
        }
    return  $logSms;
    }
    
    public function save(LogSms  $logSms): void
    {
        if (! $logSms->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(LogSms  $logSms): void
    {
        if (! $logSms->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

