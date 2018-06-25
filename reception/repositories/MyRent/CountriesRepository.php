<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\Countries;
use reception\repositories\NotFoundException;

class CountriesRepository 
{
    public function get($id): Countries    {
         if (! $countries = Countries::findOne($id)) {
            throw new NotFoundException('Countries is not found.');
        }
    return  $countries;
    }
    
    public function save(Countries  $countries): void
    {
        if (! $countries->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(Countries  $countries): void
    {
        if (! $countries->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

