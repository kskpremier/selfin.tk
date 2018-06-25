<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\Messages;
use reception\repositories\NotFoundException;

class MessagesRepository 
{
    public function get($id): Messages    {
         if (! $messages = Messages::findOne($id)) {
            throw new NotFoundException('Messages is not found.');
        }
    return  $messages;
    }
    
    public function save(Messages  $messages): void
    {
        if (! $messages->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(Messages  $messages): void
    {
        if (! $messages->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

