<?php
namespace backend\helpers;

use reception\entities\Apartment\Apartment;
use reception\entities\DoorLock\DoorLock;
use Yii;

class DoorLockHelper
{
    public static function getApartmentList($user)
    {
        if (Yii::$app->user->can('admin'))
            return Apartment::find()->all();
        else return Apartment::find()->forUser($user)->all();
    }

    public static function getApartments($id)
    {
        if (!$id)
            return [];
        else return (DoorLock::find()->where(['id'=>$id])->one())->apartments;
    }

    public static function getDoorlocks($user)
    {
        if (Yii::$app->user->can('admin'))
            return DoorLock::find()->all();
        else return DoorLock::find()->forUser($user)->all();
    }

    public static function getDoorLockName($id) {
         $doorLock = DoorLock::find()->where(['id'=>$id])->one();
        return ($doorLock)? $doorLock->lock_alias : '';
    }

//    public static function getDoorLocksForKeyAdmin($id) {
//        $doorLock = DoorLock::find()->where(['id'=>$id])->one();
//        $doorLock->apartments
//        return ($doorLock)? $doorLock->lock_alias : '';
//    }
}