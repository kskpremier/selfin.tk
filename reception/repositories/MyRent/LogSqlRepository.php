<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\LogSql;
use reception\repositories\NotFoundException;

class LogSqlRepository 
{
    public function get($id): LogSql    {
         if (! $logSql = LogSql::findOne($id)) {
            throw new NotFoundException('LogSql is not found.');
        }
    return  $logSql;
    }
    
    public function save(LogSql  $logSql): void
    {
        if (! $logSql->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(LogSql  $logSql): void
    {
        if (! $logSql->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

