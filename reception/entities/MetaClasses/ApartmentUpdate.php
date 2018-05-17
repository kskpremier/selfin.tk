<?php
/**
 * Created by PhpStorm.
 * User: superbrodyaga
 * Date: 4/29/18
 * Time: 12:28 PM
 */

namespace MetaClasses;


use EntityUpdateInterface;
use reception\services\MyRent\MyRent;

class ApartmentUpdate implements EntityUpdateInterface
{

    public function getListForUpdate($function,$call_user_func_array)
    {
        $rents = MyRent::getApartmentsForUser($id);
        return $rents;
    }

    public function update($list, $repository)
    {
        foreach ($list as $rent) {
            $apartment = $repository->get(id);
            if ($apartment)
                $apartment->edit($rent);
            else $apartment->create($rent);
            $repository->save($apartment);
        }
    }
}