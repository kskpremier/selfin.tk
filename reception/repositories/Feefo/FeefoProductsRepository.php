<?php

namespace reception\repositories\Feefo;

use reception\entities\Feefo\FeefoProducts;
use reception\repositories\NotFoundException;

class FeefoProductsRepository
{
    public function get($id): FeefoProducts    {
        if (! $feefoProducts = FeefoProducts::findOne($id)) {
            throw new NotFoundException('FeefoProducts is not found.');
        }
        return  $feefoProducts;
    }

    public function getProductID($id)   {
        if ($feefoProducts = FeefoProducts::find()->where(["object_id"=>$id])->one()) {
            return  $feefoProducts;
        }
        return  false;
    }

    public function save(FeefoProducts  $feefoProducts): void
    {
        if (! $feefoProducts->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function remove(FeefoProducts  $feefoProducts): void
    {
        if (! $feefoProducts->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}