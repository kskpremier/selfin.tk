<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\ReportsTypes;
use reception\repositories\NotFoundException;

class ReportsTypesRepository 
{
    public function get($id): ReportsTypes    {
         if (! $reportsTypes = ReportsTypes::findOne($id)) {
            throw new NotFoundException('ReportsTypes is not found.');
        }
    return  $reportsTypes;
    }
    
    public function save(ReportsTypes  $reportsTypes): void
    {
        if (! $reportsTypes->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(ReportsTypes  $reportsTypes): void
    {
        if (! $reportsTypes->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

