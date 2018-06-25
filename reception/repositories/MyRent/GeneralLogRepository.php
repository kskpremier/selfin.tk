<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\GeneralLog;
use reception\repositories\NotFoundException;

class GeneralLogRepository 
{
    public function get($id): GeneralLog    {
         if (! $generalLog = GeneralLog::findOne($id)) {
            throw new NotFoundException('GeneralLog is not found.');
        }
    return  $generalLog;
    }
    
    public function save(GeneralLog  $generalLog): void
    {
        if (! $generalLog->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(GeneralLog  $generalLog): void
    {
        if (! $generalLog->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

