<?php

namespace reception\helpers;

use reception\entities\Booking\Booking;
use reception\entities\User\User;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use Yii;

class BookingHelper
{
    public static function statusList(): array
    {
        return [
            Booking::STATUS_ACTIVE  => 'Active',
            Booking::STATUS_CANCELLED => 'Cancel',
            Booking::STATUS_REGISTERED => 'Registered',
            Booking::STATUS_WARNING => 'Warning'
            ];
    }

    public static function statusName($status): string
    {
        return ArrayHelper::getValue(self::statusList(), $status);
    }

    public static function statusLabel($status): string
    {
        switch ($status) {
            case Booking::STATUS_CANCELLED:
                $class = 'label label-default';
                break;
            case Booking::STATUS_ACTIVE:
                $class = 'label label-primary';
                break;
            case Booking::STATUS_REGISTERED:
                $class = 'label label-success';
                break;
            case Booking::STATUS_WARNING:
                $class = 'label label-danger';
                break;
            default:
                $class = 'label label-default';
        }

        return Html::tag('span', ArrayHelper::getValue(self::statusList(), $status), [
            'class' => $class,
        ]);
    }

    public static function getBookingsForUser(User $user) {
        $ids= ArrayHelper::getColumn($user->parentUsers,'id');
        $ids[]=$user->id;
        return Booking::find()->joinWith('apartment')->joinWith('apartment.doorLocks')
            ->where(['apartment.user_id'=>$ids,'door_lock.user_id'=>$ids])->fromNow()->active()->all();
    }

}