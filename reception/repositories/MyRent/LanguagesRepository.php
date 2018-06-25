<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\Languages;
use reception\repositories\NotFoundException;

class LanguagesRepository 
{
    public function get($id): Languages    {
         if (! $languages = Languages::findOne($id)) {
            throw new NotFoundException('Languages is not found.');
        }
    return  $languages;
    }
    
    public function save(Languages  $languages): void
    {
        if (! $languages->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(Languages  $languages): void
    {
        if (! $languages->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

