<?php

namespace reception\repositories\Feefo;

use reception\entities\Feefo\FeefoSales;
use reception\repositories\NotFoundException;

class FeefoSalesRepository
{
    public function get($id):FeefoSales    {
        if (! $feefoSales = FeefoSales::findOne($id)) {
            throw new NotFoundException('FeefoSales is not found.');
        }
        return  $feefoSales;
    }

    public function getByBookingID($id)    {
        if ($feefoSales = FeefoSales::find()->where(["rent_id"=>$id])->one()) {
            return  $feefoSales;
        }
        return  false;
    }

    public function getRentsIDs() {

            return  FeefoSales::find()->select('rent_id')->all();

    }

    public function save(FeefoSales  $feefoSales): void
    {
        if (! $feefoSales->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function remove(FeefoSales  $feefoSales): void
    {
        if (! $feefoSales->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}

