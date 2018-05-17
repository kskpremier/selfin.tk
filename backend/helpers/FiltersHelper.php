<?php
/**
 * Created by PhpStorm.
 * User: superbrodyaga
 * Date: 2/7/18
 * Time: 9:27 PM
 */

namespace backend\helpers;



use backend\models\Objects;
use yii\helpers\ArrayHelper;

class FiltersHelper
{


    public static function getNames($array): string
    {
        $string ='';
       $names = ArrayHelper::getColumn(Objects::find()->where(['id'=>$array])->all(), 'name');
       foreach ($names as $name){
           $string .= $name.', '.'<br/>' ;
       }
       return  $string;
    }
    public static function getReceptionName($id):string
    {

    }

}