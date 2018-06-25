<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\AmenitiesB2b;
use reception\repositories\NotFoundException;

class AmenitiesB2bRepository 
{
    public function get($id): AmenitiesB2b    {
         if (! $amenitiesB2b = AmenitiesB2b::findOne($id)) {
            throw new NotFoundException('AmenitiesB2b is not found.');
        }
    return  $amenitiesB2b;
    }
    
    public function save(AmenitiesB2b  $amenitiesB2b): void
    {
        if (! $amenitiesB2b->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(AmenitiesB2b  $amenitiesB2b): void
    {
        if (! $amenitiesB2b->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

