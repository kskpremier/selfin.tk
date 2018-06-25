<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\SupportTickets;
use reception\repositories\NotFoundException;

class SupportTicketsRepository 
{
    public function get($id): SupportTickets    {
         if (! $supportTickets = SupportTickets::findOne($id)) {
            throw new NotFoundException('SupportTickets is not found.');
        }
    return  $supportTickets;
    }
    
    public function save(SupportTickets  $supportTickets): void
    {
        if (! $supportTickets->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(SupportTickets  $supportTickets): void
    {
        if (! $supportTickets->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

