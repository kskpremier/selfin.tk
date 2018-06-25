<?php

namespace reception\repositories\Feefo;

use reception\entities\MyRent\FeefoSchedule;
use reception\repositories\NotFoundException;

class FeefoScheduleRepository
{
    public function get($id)   {
        if (! $feefoSchedule = FeefoSchedule::findOne($id)) {
           return false;
        }
        return  $feefoSchedule;
    }

    public function getByKey($id)   {
        if ($feefoSchedule = FeefoSchedule::find()->where(["object_id"=>$id])->one()) {
            return  $feefoSchedule;
        }
        return  false;
    }

    public function save(FeefoSchedule  $feefoSchedule): void
    {
        if (! $feefoSchedule->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }
    public function getObjectsIDs ($date){
        return  FeefoSchedule::find()->select('object_id')->andFilterWhere(['and',['<=','from',$date],['>=','to',$date]])->all();
    }

    public function remove(FeefoSchedule  $feefoSchedule): void
    {
        if (! $feefoSchedule->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}
