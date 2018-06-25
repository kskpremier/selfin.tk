<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\Resellers;
use reception\repositories\NotFoundException;

class ResellersRepository 
{
    public function get($id): Resellers    {
         if (! $resellers = Resellers::findOne($id)) {
            throw new NotFoundException('Resellers is not found.');
        }
    return  $resellers;
    }
    
    public function save(Resellers  $resellers): void
    {
        if (! $resellers->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(Resellers  $resellers): void
    {
        if (! $resellers->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

