<?php
/**
 * Created by PhpStorm.
 * User: superbrodyaga
 * Date: 2/7/18
 * Time: 9:27 PM
 */

namespace backend\helpers;

use backend\models\Objects;
use reception\entities\Apartment\Apartment;
use reception\entities\User\User;
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
           610=>"Gajac"    ,
           607=>"Cervar"   ,
           612=>"Savudrija",
           609=>"Zaglav"   ,
           608=>"Barbariga",
           606=>"Mareda"
        ];
    }

    public static function getReception($user_id){
            $user = User::findOne($user_id);
            if ($user) $id = $user->external_id; else $id=$user_id;
        $list = [
            611=>"Kvarner"  ,
            610=>"Gajac"    ,
            607=>"Cervar"   ,
            612=>"Savudrija",
            609=>"Zaglav"   ,
            608=>"Barbariga",
            606=>"Mareda"
            ];
            return ($id)?$list[$id]:"Kvarner";
    }

    public static function getUserId($reception){
        $list = [
            "Kvarner"  =>611,
            "Gajac"    =>610,
            "Cervar"   =>607,
            "Savudrija"=>612,
            "Zaglav"   =>609,
            "Barbariga"=>608,
            "Mareda"   =>612
        ];
        return $list[$reception];
    }

    public static function getApartments()
    {
       return  Objects::find()->where(['user_id'=>[611, 607, 610, 606, 608, 609, 612]])->all();
    }

}