<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\EmailsTemplates;
use reception\repositories\NotFoundException;

class EmailsTemplatesRepository 
{
    public function get($id): EmailsTemplates    {
         if (! $emailsTemplates = EmailsTemplates::findOne($id)) {
            throw new NotFoundException('EmailsTemplates is not found.');
        }
    return  $emailsTemplates;
    }
    
    public function save(EmailsTemplates  $emailsTemplates): void
    {
        if (! $emailsTemplates->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(EmailsTemplates  $emailsTemplates): void
    {
        if (! $emailsTemplates->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

