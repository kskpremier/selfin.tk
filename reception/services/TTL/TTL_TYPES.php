<?php
/**
 * Created by PhpStorm.
 * User: superbrodyaga
 * Date: 9/29/17
 * Time: 3:40 PM
 */
namespace reception\services\TTL;


class TTL_TYPES {
    const TTL_Single=1; // password (ONCE)
    const TTL_Permanent=2; // (PERMANENT)
    const TTL_Deadline=3;// (PERIOD)
    const TTL_Delete =4 ; //(DELETE)
    const TTL_WEEKENDREPETUAL = 5; //cycle weekend
    const TTL_Daily = 6; //cycle (DAILYREP)
    const TTL_Workday = 7;// cycle (WORKDAYREP)
    const TTL_Monday= 8; //cycle (MONDAYREP)
    const TTL_Tuesday=9; // cycle (TUESDAYREP)
    const TTL_Wednesday = 10; //cycle (WEDNESDAYREP)
    const TTL_Thursday= 11; //cycle (THURSDAYREP)
    const TTL_Friday= 12;//cycle (FRIDAYREP)
    const TTL_Saturday =13; // (SATURDAYREP)
    const TTL_Weekday= 14; //Circulation (SUNDAYREP)

    public static function type($type)
    {
        switch ($type) {
            case 1:
                return "Single";
            //case 5: return "Cycle";
            case 3:
                return "Period";
            case 2:
                return "Permanent";
            case 4:
                return "Delete "; //4 ; //(DELETE)
            case 5:
                return "Weekend Repeating"; // 5; //cycle weekend
            case 6:
                return "Daily Repeating"; // 6; //cycle (DAILYREP)
            case 7:
                return "Workday Repeating"; // 7;// cycle (WORKDAYREP)
            case 8:
                return "Monday Repeating"; // 8; //cycle (MONDAYREP)
            case 9:
                return "Tuesday Repeating"; //9; // cycle (TUESDAYREP)
            case 10:
                return "Wednesday Repeating"; // 10; //cycle (WEDNESDAYREP)
            case 11:
                return "Thursday Repeating"; // 11; //cycle (THURSDAYREP)
            case 12:
                return "Friday Repeating"; // 12;//cycle (FRIDAYREP)
            case 13:
                return "Saturday Repeating"; //13; // (SATURDAYREP)
            case 14:
                return "Weekday Repeating"; // 14; //Circulation (SUNDAYREP)

            default:
                return "Unknown";
        }
    }
}