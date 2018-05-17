<?php
/**
 * Created by PhpStorm.
 * User: superbrodyaga
 * Date: 2/7/18
 * Time: 9:27 PM
 */

namespace myrent\helpers;

use yii\helpers\Html;

class RentsHelper
{
//    public static function statusList($model): array
//    {
//        return $model->rentStatus->name;
//    }
//
//    public static function statusName($status, $model): string
//    {
//        return ArrayHelper::getValue(self::statusList($model), $status);
//    }

    public static function statusLabel($model): string
    {
        $name = "";
        if ($model->rentsStatus) {
            $name = $model->rentsStatus->name;
            switch ($model->rentsStatus->name) {
                case "Blocked":
                    $class = 'label label-danger';
                    break;
                case "Confirm":
                    $class = 'label label-success';
                    break;
                case "Confirmed":
                    $class = 'label label-success';
                    break;
//            case Booking::STATUS_WARNING:
//                $class = 'label label-danger';
//                break;
                default:
                    $class = 'label label-default';
                    $name = "";

            }
        }
        else $class="";
        return Html::tag('span', $name , [
            'class' => $class,
        ]);
    }

    public static function getPrice($model): string
    {
        return ($model->currency)? $model->price. " ". $model->currency->label: $model->price ;
    }

    public static function getSource($model): string
    {
        return ($model->rentsSources)? "<div class='row'>". Html::tag('span', $model->rentsSources->name,['style'=>'background-color :'.$model->rentsSources->color]). "</div><div class='row'>".$model->erp_id."</div>": "";
    }
    public static function getReceptionList() {

        return [
//           [611, 607, 610, 606, 608, 609, 612]
           ''=> "All",
           611=>"Kvarner"  ,
           607=>"Gajac"    ,
           610=>"Cervar"   ,
           606=>"Savudrija",
           608=>"Zaglav"   ,
           609=>"Barbariga",
           612=>"Mareda"
        ];
    }

    public static function getReception($user_id){
            $list = [
                611=>"Kvarner"  ,
                607=>"Gajac"    ,
                610=>"Cervar"   ,
                606=>"Savudrija",
                608=>"Zaglav"   ,
                609=>"Barbariga",
                612=>"Mareda"
            ];
            return $list[$user_id];
    }

    public static function getUserId($reception){
        $list = [
            "Kvarner"  =>611,
            "Gajac"    =>607,
            "Cervar"   =>610,
            "Savudrija"=>606,
            "Zaglav"   =>608,
            "Barbariga"=>609,
            "Mareda"   =>612
        ];
        return $list[$reception];
    }

}