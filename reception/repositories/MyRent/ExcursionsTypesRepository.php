<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\ExcursionsTypes;
use reception\repositories\NotFoundException;

class ExcursionsTypesRepository 
{
    public function get($id): ExcursionsTypes    {
         if (! $excursionsTypes = ExcursionsTypes::findOne($id)) {
            throw new NotFoundException('ExcursionsTypes is not found.');
        }
    return  $excursionsTypes;
    }
    
    public function save(ExcursionsTypes  $excursionsTypes): void
    {
        if (! $excursionsTypes->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(ExcursionsTypes  $excursionsTypes): void
    {
        if (! $excursionsTypes->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

