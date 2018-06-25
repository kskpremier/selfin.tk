<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\CountriesSettlments;
use reception\repositories\NotFoundException;

class CountriesSettlmentsRepository 
{
    public function get($id): CountriesSettlments    {
         if (! $countriesSettlments = CountriesSettlments::findOne($id)) {
            throw new NotFoundException('CountriesSettlments is not found.');
        }
    return  $countriesSettlments;
    }
    
    public function save(CountriesSettlments  $countriesSettlments): void
    {
        if (! $countriesSettlments->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(CountriesSettlments  $countriesSettlments): void
    {
        if (! $countriesSettlments->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

