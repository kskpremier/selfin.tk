<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\Amenities;
use reception\repositories\NotFoundException;

class AmenitiesRepository 
{
    public function get($id): Amenities    {
         if (! $amenities = Amenities::findOne($id)) {
            throw new NotFoundException('Amenities is not found.');
        }
    return  $amenities;
    }
    
    public function save(Amenities  $amenities): void
    {
        if (! $amenities->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(Amenities  $amenities): void
    {
        if (! $amenities->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

