<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\Profiles;
use reception\repositories\NotFoundException;

class ProfilesRepository 
{
    public function get($id): Profiles    {
         if (! $profiles = Profiles::findOne($id)) {
            throw new NotFoundException('Profiles is not found.');
        }
    return  $profiles;
    }
    
    public function save(Profiles  $profiles): void
    {
        if (! $profiles->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(Profiles  $profiles): void
    {
        if (! $profiles->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

