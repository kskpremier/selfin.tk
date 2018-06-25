<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\CityTaxes;
use reception\repositories\NotFoundException;

class CityTaxesRepository 
{
    public function get($id): CityTaxes    {
         if (! $cityTaxes = CityTaxes::findOne($id)) {
            throw new NotFoundException('CityTaxes is not found.');
        }
    return  $cityTaxes;
    }
    
    public function save(CityTaxes  $cityTaxes): void
    {
        if (! $cityTaxes->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(CityTaxes  $cityTaxes): void
    {
        if (! $cityTaxes->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

