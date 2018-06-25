<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\SlowLog;
use reception\repositories\NotFoundException;

class SlowLogRepository 
{
    public function get($id): SlowLog    {
         if (! $slowLog = SlowLog::findOne($id)) {
            throw new NotFoundException('SlowLog is not found.');
        }
    return  $slowLog;
    }
    
    public function save(SlowLog  $slowLog): void
    {
        if (! $slowLog->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(SlowLog  $slowLog): void
    {
        if (! $slowLog->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

