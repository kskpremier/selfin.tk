<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\UsersSettings;
use reception\repositories\NotFoundException;

class UsersSettingsRepository 
{
    public function get($id): UsersSettings    {
         if (! $usersSettings = UsersSettings::findOne($id)) {
            throw new NotFoundException('UsersSettings is not found.');
        }
    return  $usersSettings;
    }
    
    public function save(UsersSettings  $usersSettings): void
    {
        if (! $usersSettings->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(UsersSettings  $usersSettings): void
    {
        if (! $usersSettings->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

