<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\SupportTicketMessages;
use reception\repositories\NotFoundException;

class SupportTicketMessagesRepository 
{
    public function get($id): SupportTicketMessages    {
         if (! $supportTicketMessages = SupportTicketMessages::findOne($id)) {
            throw new NotFoundException('SupportTicketMessages is not found.');
        }
    return  $supportTicketMessages;
    }
    
    public function save(SupportTicketMessages  $supportTicketMessages): void
    {
        if (! $supportTicketMessages->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(SupportTicketMessages  $supportTicketMessages): void
    {
        if (! $supportTicketMessages->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

