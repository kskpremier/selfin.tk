<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\InvoicesLog;
use reception\repositories\NotFoundException;

class InvoicesLogRepository 
{
    public function get($id): InvoicesLog    {
         if (! $invoicesLog = InvoicesLog::findOne($id)) {
            throw new NotFoundException('InvoicesLog is not found.');
        }
    return  $invoicesLog;
    }
    
    public function save(InvoicesLog  $invoicesLog): void
    {
        if (! $invoicesLog->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(InvoicesLog  $invoicesLog): void
    {
        if (! $invoicesLog->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

