<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 24.07.17
 * Time: 11:36
 */


namespace reception\repositories\Rent;

use backend\models\Rents;
use reception\repositories\NotFoundException;

class RentsRepository
{
    public function get($id): Rents
    {
        if (!$rent = Rents::findOne($id)) {
            throw new NotFoundException('Rents is not found.');
        }
        return $rent;
    }
    
    public function save(Rents $rent): void
    {
        if (!$rent->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function remove(Rents $rent): void
    {
        if (!$rent->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }

    public function removeById (int $id) {
        $rent = $this->get ($id);
        if ($rent) {
            if (!$rent->delete()) {
                throw new \RuntimeException('Removing error.');
            }
        }
    }
}