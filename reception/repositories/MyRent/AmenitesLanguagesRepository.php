<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\AmenitesLanguages;
use reception\repositories\NotFoundException;

class AmenitesLanguagesRepository 
{
    public function get($id): AmenitesLanguages    {
         if (! $amenitesLanguages = AmenitesLanguages::findOne($id)) {
            throw new NotFoundException('AmenitesLanguages is not found.');
        }
    return  $amenitesLanguages;
    }
    
    public function save(AmenitesLanguages  $amenitesLanguages): void
    {
        if (! $amenitesLanguages->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(AmenitesLanguages  $amenitesLanguages): void
    {
        if (! $amenitesLanguages->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

