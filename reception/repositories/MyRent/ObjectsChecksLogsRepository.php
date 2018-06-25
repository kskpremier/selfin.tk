<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\ObjectsChecksLogs;
use reception\repositories\NotFoundException;

class ObjectsChecksLogsRepository 
{
    public function get($id): ObjectsChecksLogs    {
         if (! $objectsChecksLogs = ObjectsChecksLogs::findOne($id)) {
            throw new NotFoundException('ObjectsChecksLogs is not found.');
        }
    return  $objectsChecksLogs;
    }
    
    public function save(ObjectsChecksLogs  $objectsChecksLogs): void
    {
        if (! $objectsChecksLogs->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(ObjectsChecksLogs  $objectsChecksLogs): void
    {
        if (! $objectsChecksLogs->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

