<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\Owners;
use reception\repositories\NotFoundException;

class OwnersRepository 
{
    public function get($id): Owners    {
         if (! $owners = Owners::findOne($id)) {
            throw new NotFoundException('Owners is not found.');
        }
    return  $owners;
    }
    
    public function save(Owners  $owners): void
    {
        if (! $owners->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(Owners  $owners): void
    {
        if (! $owners->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

