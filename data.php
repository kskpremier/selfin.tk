<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 24.05.17
 * Time: 17:12
 */

echo time()*1000;
echo PHP_EOL;
//echo date_timezone_get();
//echo PHP_EOL;
//
//echo date("Y-m-d H:i:s", 1510634800);
//echo PHP_EOL;
//
echo date_default_timezone_get ();
echo PHP_EOL;
echo date("O");
echo PHP_EOL;
echo date("I",time());
echo PHP_EOL;
$dateTimeZone = new DateTimeZone(date_default_timezone_get ());
$date = new DateTime(null, new DateTimeZone(date_default_timezone_get ()));
$offset = $dateTimeZone->getOffset($date);
echo $offset;
echo PHP_EOL;
//
echo (strtotime("2017-11-15 20:30:00")+$offset)*1000;
echo PHP_EOL;
echo (strtotime("2017-11-16 20:30:00")+$offset)*1000;
echo PHP_EOL;
////echo date('y-m-d H:i:s', 1720044000);
////echo time();
////echo PHP_EOL;
//echo date('y-m-d H:i:s', "1507757400");
////echo PHP_EOL;
////
////echo PHP_EOL;
//echo strtotime("11/16/17 05:35 PM");
//echo PHP_EOL;
////echo strtotime("‎2017-10-11");
//echo PHP_EOL;
//echo time()+60*60*24;
//echo PHP_EOL;
//echo time()+60*60*24*4;
//echo PHP_EOL;
//echo password_hash("demo",1,['cost'=>13]);
//echo PHP_EOL;
//echo time();
//echo PHP_EOL;
//
//echo PHP_EOL;
