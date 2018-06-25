<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\SysJobs;
use reception\repositories\NotFoundException;

class SysJobsRepository 
{
    public function get($id): SysJobs    {
         if (! $sysJobs = SysJobs::findOne($id)) {
            throw new NotFoundException('SysJobs is not found.');
        }
    return  $sysJobs;
    }
    
    public function save(SysJobs  $sysJobs): void
    {
        if (! $sysJobs->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(SysJobs  $sysJobs): void
    {
        if (! $sysJobs->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

