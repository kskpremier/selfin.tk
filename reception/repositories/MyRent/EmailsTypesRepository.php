<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\EmailsTypes;
use reception\repositories\NotFoundException;

class EmailsTypesRepository 
{
    public function get($id): EmailsTypes    {
         if (! $emailsTypes = EmailsTypes::findOne($id)) {
            throw new NotFoundException('EmailsTypes is not found.');
        }
    return  $emailsTypes;
    }
    
    public function save(EmailsTypes  $emailsTypes): void
    {
        if (! $emailsTypes->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(EmailsTypes  $emailsTypes): void
    {
        if (! $emailsTypes->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

