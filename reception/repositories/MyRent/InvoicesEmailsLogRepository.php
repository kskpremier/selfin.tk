<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\InvoicesEmailsLog;
use reception\repositories\NotFoundException;

class InvoicesEmailsLogRepository 
{
    public function get($id): InvoicesEmailsLog    {
         if (! $invoicesEmailsLog = InvoicesEmailsLog::findOne($id)) {
            throw new NotFoundException('InvoicesEmailsLog is not found.');
        }
    return  $invoicesEmailsLog;
    }
    
    public function save(InvoicesEmailsLog  $invoicesEmailsLog): void
    {
        if (! $invoicesEmailsLog->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(InvoicesEmailsLog  $invoicesEmailsLog): void
    {
        if (! $invoicesEmailsLog->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

