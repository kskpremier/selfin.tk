<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\LogEmail;
use reception\repositories\NotFoundException;

class LogEmailRepository 
{
    public function get($id): LogEmail    {
         if (! $logEmail = LogEmail::findOne($id)) {
            throw new NotFoundException('LogEmail is not found.');
        }
    return  $logEmail;
    }
    
    public function save(LogEmail  $logEmail): void
    {
        if (! $logEmail->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(LogEmail  $logEmail): void
    {
        if (! $logEmail->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

