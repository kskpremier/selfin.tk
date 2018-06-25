<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\LogError;
use reception\repositories\NotFoundException;

class LogErrorRepository 
{
    public function get($id): LogError    {
         if (! $logError = LogError::findOne($id)) {
            throw new NotFoundException('LogError is not found.');
        }
    return  $logError;
    }
    
    public function save(LogError  $logError): void
    {
        if (! $logError->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(LogError  $logError): void
    {
        if (! $logError->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

