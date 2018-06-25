<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\ProfilesOtas;
use reception\repositories\NotFoundException;

class ProfilesOtasRepository 
{
    public function get($id): ProfilesOtas    {
         if (! $profilesOtas = ProfilesOtas::findOne($id)) {
            throw new NotFoundException('ProfilesOtas is not found.');
        }
    return  $profilesOtas;
    }
    
    public function save(ProfilesOtas  $profilesOtas): void
    {
        if (! $profilesOtas->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(ProfilesOtas  $profilesOtas): void
    {
        if (! $profilesOtas->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

