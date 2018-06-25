<?php

namespace reception\repositories\MyRent;

use reception\entities\MyRent\Rents;
use reception\repositories\NotFoundException;

class RentsRepository 
{
    public function get($id): Rents    {
         if (! $rents = Rents::findOne($id)) {
            throw new NotFoundException('Rents is not found.');
        }
    return  $rents;
    }
    
    public function save(Rents  $rents): void
    {
        if (! $rents->save()) {
            throw new \RuntimeException('Saving error.');
         }
    }
    
    public function remove(Rents  $rents): void
    {
        if (! $rents->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
    public function getCheckedInForObjectsOnDate($date,$objectsId): array
    {
        if (!$rents = Rents::find()->active()->checkedIn($date)->withContactData()->forObject($objectsId)->all()) {
            return [];
        }
        return $rents;
    }
    public function getCheckedInForUserOnDate($date,$user_id): array
    {
        if (!$rent = Rents::find()->active()->checkedIn($date)->forUser($user_id)->all()) {
            return [];
        }
        return $rents;
    }
}

