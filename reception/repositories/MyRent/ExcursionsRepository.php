<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\Excursions;
use reception\repositories\NotFoundException;

class ExcursionsRepository 
{
    public function get($id): Excursions    {
         if (! $excursions = Excursions::findOne($id)) {
            throw new NotFoundException('Excursions is not found.');
        }
    return  $excursions;
    }
    
    public function save(Excursions  $excursions): void
    {
        if (! $excursions->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(Excursions  $excursions): void
    {
        if (! $excursions->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

