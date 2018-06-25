<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\RentsGroupsRents;
use reception\repositories\NotFoundException;

class RentsGroupsRentsRepository 
{
    public function get($id): RentsGroupsRents    {
         if (! $rentsGroupsRents = RentsGroupsRents::findOne($id)) {
            throw new NotFoundException('RentsGroupsRents is not found.');
        }
    return  $rentsGroupsRents;
    }
    
    public function save(RentsGroupsRents  $rentsGroupsRents): void
    {
        if (! $rentsGroupsRents->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(RentsGroupsRents  $rentsGroupsRents): void
    {
        if (! $rentsGroupsRents->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

