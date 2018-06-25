<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\ExcursionsPictures;
use reception\repositories\NotFoundException;

class ExcursionsPicturesRepository 
{
    public function get($id): ExcursionsPictures    {
         if (! $excursionsPictures = ExcursionsPictures::findOne($id)) {
            throw new NotFoundException('ExcursionsPictures is not found.');
        }
    return  $excursionsPictures;
    }
    
    public function save(ExcursionsPictures  $excursionsPictures): void
    {
        if (! $excursionsPictures->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(ExcursionsPictures  $excursionsPictures): void
    {
        if (! $excursionsPictures->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

