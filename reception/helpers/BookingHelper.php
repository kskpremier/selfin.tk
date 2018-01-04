<?php

namespace reception\helpers;

use reception\entities\Booking\Booking;
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

}