<?php
/**
 * Created by PhpStorm.
 * User: superbrodyaga
 * Date: 5/13/18
 * Time: 6:45 PM
 */

namespace reception\helpers;


use class_with_method_named_empty;

class MyRentHelper {
    
    
    public static function getGuidForReception($myRentUserId){
        switch ($myRentUserId) {
            case 606:
                return "11f838d3-2b11-11e7-b171-0050563c3009";
            case 607:
                return "3b057fef-2b11-11e7-b171-0050563c3009";
            case 608:
                return "555d208a-2b11-11e7-b171-0050563c3009";
            case 609:
                return "68e7ba9d-2b11-11e7-b171-0050563c3009";
            case 610:
                return "8900c86d-2b11-11e7-b171-0050563c3009";
            case 611:
                return "bc8da49e-2b11-11e7-b171-0050563c3009";
            case 612:
                return "d9ddc81c-2b11-11e7-b171-0050563c3009";
        }
    }

    public static function getType($class, $attribute) {
        $model = new $class() ;
        $dbType = $model->getTableSchema()->columns[$attribute]->dbType;
            $phpType = $model->getTableSchema()->columns[$attribute]->phpType;
            $type = $model->getTableSchema()->columns[$attribute]->type;
           return $dbType;//$model->getTableSchema()->columns[$attribute]->type;
    }
    
}
