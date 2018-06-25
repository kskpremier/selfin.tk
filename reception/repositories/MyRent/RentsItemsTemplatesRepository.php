<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\RentsItemsTemplates;
use reception\repositories\NotFoundException;

class RentsItemsTemplatesRepository 
{
    public function get($id): RentsItemsTemplates    {
         if (! $rentsItemsTemplates = RentsItemsTemplates::findOne($id)) {
            throw new NotFoundException('RentsItemsTemplates is not found.');
        }
    return  $rentsItemsTemplates;
    }
    
    public function save(RentsItemsTemplates  $rentsItemsTemplates): void
    {
        if (! $rentsItemsTemplates->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(RentsItemsTemplates  $rentsItemsTemplates): void
    {
        if (! $rentsItemsTemplates->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

