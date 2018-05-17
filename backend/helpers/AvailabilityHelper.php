<?php
/**
 * Created by PhpStorm.
 * User: superbrodyaga
 * Date: 2/14/18
 * Time: 6:04 PM
 */

namespace backend\helpers;

use function strtotime;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class AvailabilityHelper
{
    public $partlyBookedList=[];
    public $bookedObjectList=[];

    public static function getElementClass($free){
        return ($free) ? "<div class='col-lg-1'><span>1</span></div>" : "<div class='col-lg-1'><span>0</span></div>" ;
    }

    public static function getRow( $object, $start, $until ){
       $result=[]; $row="";

        $from = $current = strtotime($start);
        $to = strtotime($until);
        $day = 24*60*60;
        $days =  (integer) (($to - $from) / $day) ;
        for ($i=0;$i<$days;$i++) $result[$i]=1;

        $list = self::getRents($object, $start, $until);
        $j=0; //счетчик букингов
        $i=0; //счетчик дней в букинге
        $k=0; //счетчик текущего дня

        while ($j<count($list) ) {
            //обрабатываем 1-й букинг
            $fromUnix = strtotime($list[$j]->from_date);
            $toUnix = strtotime($list[$j]->until_date);
            if ($current < $fromUnix) {
                $current = $fromUnix;
                $k =  (integer)(($fromUnix - $current) / $day);
            } else {
                $j++;
                $current = $toUnix;
                for ($i=0; $i < (integer)(($current - $from) / $day); $i++) {
                    $result[$i + $k] = 0;
                    $k++;
                }
            }
        }

        for ($i=0; $i<$days ; $i++){
            $row = $row.self::getElementClass($result[$i]);
        }
        return $row;
    }

    public static function getResult( $object, $start, $until ){
        $result=[]; $row="";

        $from = $current = strtotime($start);
        $to = strtotime($until);
        $day = 24*60*60;
        $days =  (integer) (($to - $from) / $day) ;
        for ($i=0;$i<$days;$i++) $result[$i]=1;

        $list = $object->getRents()->inInterval($start,$until)->orderBy('rents.from_date')->all();
        $j=0; //счетчик букингов
        $i=0; //счетчик дней в букинге
        $k=0; //счетчик текущего дня

        while ($j<count($list) ) {
            //обрабатываем 1-й букинг
            $fromUnix = strtotime($list[$j]->from_date);
            $toUnix = strtotime($list[$j]->until_date);
            if ($current < $fromUnix) {
                $current = $fromUnix;
                $k =  (integer)(($fromUnix - $current) / $day);
            } else {
                $j++;
                $current = $toUnix;
                for ($i=0; $i < (integer)(($current - $from) / $day); $i++) {
                    $result[$i + $k] = 0;
                    $k++;
                }
            }
        }
        return $result;
    }

    public static function getAvailabilityIDs ($array,$start,$until) {
        $bookedObjectIDs= [];
        $byObject = ArrayHelper::index($array, null, 'object_id');
        foreach ($byObject as $key => $dataPairs) {
            if (self::daysCount($dataPairs, $start, $until)>0)
                $objectIDs [] = $key;
            else $bookedObjectIDs [] = $key;
        }
        return $bookedObjectIDs;
    }

    private static function getEmptyDaysArray ($datePairs,$start,$until) {

        $result=[]; $row="";

        $from = $current = strtotime($start);
        $to = strtotime($until);
        $day = 24*60*60;
        $days =  (integer) (($to - $from) / $day) ;

        for ($i=0;$i<$days;$i++) $result[$i]=1;

//        $list = $object->getRents()->inInterval($start,$until)->orderBy('rents.from_date')->all();
        $j=0; //счетчик букингов
        $i=0; //счетчик дней в букинге
        $k=0; //счетчик текущего дня

        while ($j<count($datePairs) ) {
            //обрабатываем 1-й букинг
            $fromUnix = strtotime($datePairs[$j]->from_date);
            $toUnix = strtotime($datePairs[$j]->until_date);
            if ($current < $fromUnix) {
                $current = $fromUnix;
                $k =  (integer)(($fromUnix - $current) / $day);
            } else {
                $j++;
                $current = $toUnix;
                for ($i=0; $i < (integer)(($current - $from) / $day); $i++) {
                    $result[$i + $k] = 0;
                    $k++;
                }
            }
        }
        return $result;
    }
//Вернет количесто незанятых дней. На входе интервал и массив пар ["from_date"=>...,"until_date"=>...]
    private static function daysCount($datePairs,$start,$until){
        $count = count($datePairs);
        $current = $start;
        $result = $bookingDuration=0;
        $from = min ( strtotime($datePairs[0]['from_date']),strtotime($start));
        $to = max ( strtotime($datePairs[$count-1]['until_date']),strtotime($until));
        //$allTime = strtotime($datePairs[$count-1]['until_date']) - strtotime($datePairs[0]['from_date']);
//        $intervalTime = strtotime($until) - strtotime($start);
        foreach ($datePairs as $pair) {
            $bookingDuration += strtotime($pair['until_date']) - strtotime($pair['from_date']);
        }
        $result = $to-$from-$bookingDuration;
        return (integer)$result/24/60/60;
    }

    public static function getAvailability($array,  $start, $until){
        $result=[];
//        $byObject = ArrayHelper::index($array, null, 'id');
        $from = $current = strtotime($start);
        $to = strtotime($until);
        $day = 24*60*60;
        $days =  (integer) (($to - $from) / $day) ;
        $r=0; //счетчик объектов
        foreach ($array as $object) {
            $result[$r]['name']=$object['name'];
            $result[$r]['id']=$object['id'];
            $empty = $occupied = 0; //загрузка
            for ($i=0;$i<$days;$i++) $result[$r]['data'][$i]=1;
            $result[$r]['empty'] = "0 from ". $days. " days";
            $result[$r]['load'] =  ($days)?(integer) ($occupied/$days):$occupied;
            $list = self::getRentsForPeriodFromArray($object['rents'],$start, $until); //получаем список букингов
            $j = 0; //счетчик букингов
            $i = 0; //счетчик дней в букинге
            $k = 0; //счетчик текущего дня
            $countOfNight =0;
            $current = strtotime($start); $k=0;
            while ($j < count($list)) { //перебираем все букинги


                    $fromUnix = strtotime($list[$j]['from_date']);
                    $toUnix = strtotime($list[$j]['until_date']);
                    if (! (($fromUnix > $to  && $toUnix > $to ) || ($fromUnix < $from  && $toUnix < $from ) )) {
                        if ($fromUnix <= $current) { //апартмент занят
                            //присвоить 0 ..- $durationOfRent всем ячейкам от $k+1 до $toUnix - крнца букигнга или $to - конца периода
                            //$to - конец букинга
                            //$toUnix -
                            $currentTo = min($toUnix, $to);
                            $durationOfRent = (integer)(($currentTo - $current) / $day);//длина букинга в днях
                            $occupied = $occupied + $durationOfRent;
                            for ($i = 0; $i < $durationOfRent; $i++) {
//пишем сюда отрицательное значение счетчика для возможности потом перебирать два массива сразу (и дни и букинги в календаре)
                                $result[$r]['data'][$i + $k ] = -$i;
                                $countOfNight++;
                            }
                            $k = $k + $durationOfRent;
                            $current = $currentTo;

                            $result[$r]['rent'][$j]['id'] = $list[$j]['id'];
                            $result[$r]['rent'][$j]['note'] = $list[$j]['note'];
                            $result[$r]['rent'][$j]['number'] = $list[$j]['number'];
                            $result[$r]['rent'][$j]['price'] = $list[$j]['price'];
                            $result[$r]['rent'][$j]['paid'] = $list[$j]['paid'];
                            $result[$r]['rent'][$j]['country'] = ($list[$j]['country']['code2']) ? mb_strtolower($list[$j]['country']['code2'], 'UTF-8') . ".png" : "OAR.png";
                            $result[$r]['rent'][$j]['duration'] = $durationOfRent;
                            $result[$r]['rent'][$j]['contact_name'] = $list[$j]['contact_name'];
                            $result[$r]['rent'][$j]['currency'] = $list[$j]['currency']['label'];
                            $result[$r]['rent'][$j]['status']['name'] = $list[$j]['rentsStatus']['name'];
                            $result[$r]['rent'][$j]['status']['color'] = $list[$j]['rentsStatus']['color'];
                            //                    $result[$r]['empty'] = ($empty)? $occupied. " from ". $empty. " days" : "0 from ". $days. " days";
                            $j++; //только тут уходим на следующий букинг
                        } elseif ($fromUnix > $current) { //апартмент свободен
                            //передвигаем  курсор и счетчик дней
                            $durationOfEmpty = (integer)(($fromUnix - $current) / $day);
                            $empty = $empty + $durationOfEmpty;
                            $k = $k + $durationOfEmpty;
                            $current = $fromUnix;
                        }
                    }
                }

            $result[$r]['empty'] =  $countOfNight. " from ". $days;
            $result[$r]['load'] = ($days)?(integer) (100* $countOfNight/$days):100;
            $r++; //следующий объект
            }
        return $result;
    }

    public static function getElementTableClass($free){
        return (!$free) ? "bg-danger" : "bg-success" ;
    }


    public static function getRents($object,$start,$until){
        $rentsList = $object->getRents()->forPeriod($start,$until)->orderBy('rents.from_date')->all();
       return $rentsList;
    }

    public static function emptyDays($object,$from,$to) {

        $fromUnix = strtotime($from);
        $toUnix = strtotime($to);


        if ($fromUnix==$toUnix) return 0;

        //получить все букинги, даты которых находятся в интервале

        $rentsList =$object->getRents()->inInterval($from,$to)->orderBy('rents.from_date')->all();
        $count=0;
        if (count ($rentsList)==0){ return (integer)(($toUnix - $fromUnix)/ 24 / 60 / 60);}
        if (count ($rentsList)>1) {
            for ($i = 0; $i < count($rentsList) - 1; $i++) {
                $count += (integer)((strtotime($rentsList[$i]->until_date) - strtotime($rentsList[$i + 1]->from_date)) / 24 / 60 / 60);
            }
        }
        elseif ( (strtotime($rentsList[0]->from_date) < $fromUnix) ) {
            $count = (integer)(($toUnix - strtotime($rentsList[0]->until_date)) / 24 / 60 / 60);
        }
        else {
            $count = (integer)((- $fromUnix + strtotime($rentsList[0]->from_date)) / 24 / 60 / 60);
        }

        return $count;

    }
    
    private static function getRentsForPeriodFromArray ($array, $start, $until){

        $rentForPeriod =[];
        foreach ($array as $rent){

             $cond1 = (  $rent["from_date"] <  $start) && ($rent["until_date"] >  $until) ;
             $cond2 = ( ($rent["from_date"] >= $start) && ($rent["until_date"] <= $until) ) ;
             $cond3 = ( ($rent["from_date"] <  $start) && ($rent["until_date"] <  $until) && ($rent["from_date"] >=  $start) ) ;
             $cond4 = ( ($rent["from_date"] <  $start) && ($rent["until_date"] >  $until) && ($rent["until_date"]<= $until) );

             $cond = [$cond1,$cond2,$cond3,$cond4];
            
            if ( $rent["active"] == "Y" &&
            ( ($rent["from_date"] <  $start) && ($rent["until_date"] >  $until) ) ||
            ( ($rent["from_date"] >= $start) && ($rent["until_date"] <= $until) ) ||
            ( ($rent["from_date"] <  $start) && ($rent["until_date"] <  $until) && ($rent["from_date"] >=  $start) ) ||
            ( ($rent["from_date"] <  $start) && ($rent["until_date"] >  $until) && ($rent["until_date"]<= $until) )
            )
            {
                $rentForPeriod[]=$rent;
            }
        }
        return $rentForPeriod;
}


}


