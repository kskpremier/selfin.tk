<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 05.07.17
 * Time: 16:25
 */

namespace reception\repositories\Apartment;

use reception\entities\Apartment\Apartment;
use reception\repositories\NotFoundException;

class ApartmentRepository
{
    public function get($id): Apartment
    {
        if (!$apartment = Apartment::findOne($id)) {
            throw new NotFoundException('Apartment is not found.');
        }
        return $apartment;
    }
    public function getAllbyIds($ids): array
    {
        $apartments = [];
        if(isset($ids))
        $apartments = Apartment::find()->where(['id'=>$ids])->all();

        return $apartments;
    }

    public function save(Apartment $apartment): void
    {
        if (!$apartment->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function findByMyRentId($id)
    {
        if (!$apartment = Apartment::findOne(['external_id' => $id])) {
            return null;
        }
        return $apartment;
    }

    public function findByUserId($user_id)
    {
        if (!$apartment = Apartment::find()->where(['user_id' => $user_id])->all()) {
            return null;
        }
        return $apartment;
    }

    public function remove(Apartment $apartment): void
    {
        if (!$apartment->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}