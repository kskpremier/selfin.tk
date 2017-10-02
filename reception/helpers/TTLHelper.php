<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 13.07.17
 * Time: 10:43
 */
namespace reception\helpers;

class TTLHelper{
//When the keyboard password version is 4:00,
// the time granularity is valid only accurate to the hour,
// that is only the start time and end time is the whole point;
// maximum time span in which the deadline password can not exceed one year.
    public const TTL_KEY_PERIOD_TYPE = 0;
    public const TTL_KEYBOARD_PERIOD_TYPE = 3;

    public static function getKeyboardPwdTypeName($type) : string
    {
        switch ($type) {
            case "1":
                return "ONCE";
            case "5":
                return "WEEKENDREPETUAL";
            case "3":
                return "PERIOD";
            case "4":
                return "DELETE";
            case "2":
                return "PERMANENT";
            case "6":
                return "DAILYREP";
            case "7":
                return "WORKDAYREP";
            case "8":
                return "MONDAYREP";
            case "9":
                return "TUESDAYREP";
            case "10":
                return "WEDNESDAYREP";
            case "11":
                return "THURSDAYREP";
            case "12":
                return "FRIDAYREP";
            case "13":
                return "SATURDAYREP";
            case "14":
                return "SUNDAYREP";
            case "":
                return "PERMANENT"; // by default Permanent
            case null:
                return "PERMANENT"; // by default Permanent
            default:
                return ""; //if something else - wrong type

        }
    }
    public static function getKeyboardPwdType($type)
    {
        if ($type==null||$type=='')
            return 2;
        elseif ($type>=0 && $type<=14)
            return $type;
    }

    public static function getKeyTypeName($type) : string
    {
        switch ($type) {
            case "0":
                return "PERIOD";
            case "2":
                return "PERMANENT";
        }
    }
    public static function getKeyTypeList():array
    {
        return [
            "2"=>"Permanent",
            "0"=>"Period"
            ];
    }
     public static function getKeyboardPwdTypeNameList():array
     {
        return [
            "1"=>"One-time",
            "2"=>"Permanent",
            "3"=>"Period",
            "4"=>"Delete",
            "5"=>"No peripheral repeat",
            "6"=>"Daily repeat",
            "7"=>"Working day repeat",
            "8"=>"Monday repeat",
            "9"=>"Tuesday repeat",
            "10"=>"Wednesday repeat",
            "11"=>"Thursday repeat",
            "12"=>"Friday repeat",
            "13"=>"Saturday repeat",
            "14"=>"Sunday repeat"
        ];
     }

}