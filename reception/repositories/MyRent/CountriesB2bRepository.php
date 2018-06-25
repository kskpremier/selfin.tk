<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\CountriesB2b;
use reception\repositories\NotFoundException;

class CountriesB2bRepository 
{
    public function get($id): CountriesB2b    {
         if (! $countriesB2b = CountriesB2b::findOne($id)) {
            throw new NotFoundException('CountriesB2b is not found.');
        }
    return  $countriesB2b;
    }
    
    public function save(CountriesB2b  $countriesB2b): void
    {
        if (! $countriesB2b->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(CountriesB2b  $countriesB2b): void
    {
        if (! $countriesB2b->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

