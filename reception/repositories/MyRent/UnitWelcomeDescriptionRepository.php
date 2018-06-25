<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\UnitWelcomeDescription;
use reception\repositories\NotFoundException;

class UnitWelcomeDescriptionRepository 
{
    public function get($id): UnitWelcomeDescription    {
         if (! $unitWelcomeDescription = UnitWelcomeDescription::findOne($id)) {
            throw new NotFoundException('UnitWelcomeDescription is not found.');
        }
    return  $unitWelcomeDescription;
    }
    
    public function save(UnitWelcomeDescription  $unitWelcomeDescription): void
    {
        if (! $unitWelcomeDescription->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(UnitWelcomeDescription  $unitWelcomeDescription): void
    {
        if (! $unitWelcomeDescription->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

