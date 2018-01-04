<?php

namespace reception\helpers;


use reception\entities\Image\AbstractImage;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use reception\services\MyRent\MyRent;
use Yii;

class ImageHelper
{
    public static function statusList(): array
    {
        return [
                AbstractImage::STATUS_CREATED => "Created",
                AbstractImage::STATUS_RECOGNIZED=> "Recognized",
                AbstractImage::STATUS_NO_FACE=> "No face",
                AbstractImage::STATUS_ERROR=> "Error",
        ];
    }
    public static function statusRecognition($probability): string
    {
        switch ($probability) {
            case ($probability < 0.5):
                $class = 'label label-danger';
                break;
            case ($probability < 0.80):
                $class = 'label label-warning';
                break;
            case ($probability < 0.95):
                $class = 'label label-success';
                break;
            default:
                $class = 'label label-default';
        }
        return Html::tag('span',  $probability, [
            'class' => $class,
        ]);
    }


    public static function statusName($status): string
    {
        return "Active";
        //return ArrayHelper::getValue(self::statusUpdateList(), $status);
    }

    public static function statusUpdate($needToUpdate): string
    {
        return ArrayHelper::getValue(self::statusList(), $needToUpdate);
    }

    public static function statusLabel($status): string
    {
        switch ($status) {
            case AbstractImage::STATUS_CREATED:
                $class = 'label label-default';
                break;
            case AbstractImage::STATUS_RECOGNIZED:
                $class = 'label label-success';
                break;
            case AbstractImage::STATUS_ERROR:
                $class = 'label label-danger';
                break;
            default:
                $class = 'label label-default';
        }

        return Html::tag('span', ArrayHelper::getValue(self::statusList(), $status), [
            'class' => $class,
        ]);
    }
    public static function getMaxProbability($image): array
    {
//        $rolesArray = [];
//        $roles = Yii::$app->authManager->getRolesByUser($user->id);
//        foreach($roles as $role){
//            $rolesArray[] = ArrayHelper::getValue($role, 'name');
//        }
//        return $rolesArray;
    }

}