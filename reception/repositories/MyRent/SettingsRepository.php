<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\Settings;
use reception\repositories\NotFoundException;

class SettingsRepository 
{
    public function get($id): Settings    {
         if (! $settings = Settings::findOne($id)) {
            throw new NotFoundException('Settings is not found.');
        }
    return  $settings;
    }
    
    public function save(Settings  $settings): void
    {
        if (! $settings->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(Settings  $settings): void
    {
        if (! $settings->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

