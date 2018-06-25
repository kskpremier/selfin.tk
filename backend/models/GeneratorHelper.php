<?php
/**
 * Created by PhpStorm.
 * User: superbrodyaga
 * Date: 5/31/18
 * Time: 2:38 PM
 */
namespace backend\models;

class GeneratorHelper
{
    public static function to_class_name_case($str) {
        $str[0] = strtoupper($str[0]);
        return $str;
    }

    public static function to_camel_case($str) {
        $str[0] = strtolower($str[0]);
        return $str;
    }
}