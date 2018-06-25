<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\LogSysJobs;
use reception\repositories\NotFoundException;

class LogSysJobsRepository 
{
    public function get($id): LogSysJobs    {
         if (! $logSysJobs = LogSysJobs::findOne($id)) {
            throw new NotFoundException('LogSysJobs is not found.');
        }
    return  $logSysJobs;
    }
    
    public function save(LogSysJobs  $logSysJobs): void
    {
        if (! $logSysJobs->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(LogSysJobs  $logSysJobs): void
    {
        if (! $logSysJobs->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

