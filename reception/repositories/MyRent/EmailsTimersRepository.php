<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\EmailsTimers;
use reception\repositories\NotFoundException;

class EmailsTimersRepository 
{
    public function get($id): EmailsTimers    {
         if (! $emailsTimers = EmailsTimers::findOne($id)) {
            throw new NotFoundException('EmailsTimers is not found.');
        }
    return  $emailsTimers;
    }
    
    public function save(EmailsTimers  $emailsTimers): void
    {
        if (! $emailsTimers->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(EmailsTimers  $emailsTimers): void
    {
        if (! $emailsTimers->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

