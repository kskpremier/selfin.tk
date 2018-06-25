<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\Laundries;
use reception\repositories\NotFoundException;

class LaundriesRepository 
{
    public function get($id): Laundries    {
         if (! $laundries = Laundries::findOne($id)) {
            throw new NotFoundException('Laundries is not found.');
        }
    return  $laundries;
    }
    
    public function save(Laundries  $laundries): void
    {
        if (! $laundries->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(Laundries  $laundries): void
    {
        if (! $laundries->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

