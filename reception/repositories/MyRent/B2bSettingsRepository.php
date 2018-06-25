<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\B2bSettings;
use reception\repositories\NotFoundException;

class B2bSettingsRepository 
{
    public function get($id): B2bSettings    {
         if (! $b2bSettings = B2bSettings::findOne($id)) {
            throw new NotFoundException('B2bSettings is not found.');
        }
    return  $b2bSettings;
    }
    
    public function save(B2bSettings  $b2bSettings): void
    {
        if (! $b2bSettings->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(B2bSettings  $b2bSettings): void
    {
        if (! $b2bSettings->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

