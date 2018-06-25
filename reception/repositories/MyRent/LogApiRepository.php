<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\LogApi;
use reception\repositories\NotFoundException;

class LogApiRepository 
{
    public function get($id): LogApi    {
         if (! $logApi = LogApi::findOne($id)) {
            throw new NotFoundException('LogApi is not found.');
        }
    return  $logApi;
    }
    
    public function save(LogApi  $logApi): void
    {
        if (! $logApi->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(LogApi  $logApi): void
    {
        if (! $logApi->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

