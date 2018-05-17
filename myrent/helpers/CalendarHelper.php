<?php
/**
 * Created by PhpStorm.
 * User: superbrodyaga
 * Date: 2/17/18
 * Time: 3:56 PM
 */
namespace myrent\helpers;

use yii\helpers\Html;

class CalendarHelper{

    // получает данные в виде массива на каждый день (или букинг или пусто)
    // должна вернуть готовый тег <tr></tr>
    public static function getOneRow($object, $days, $startDate, $width){
        $string=''; $index =0;
        if ($object['load']==0)
            return self::getEmptyRow( $object, $startDate, $days);
        else {
            for ($i=0;$i<$days;$i++) {

                if($object['data'][$i]==0){
                    $content =  self::getBlockForRent($object['rent'][$index],100*$object['rent'][$index]['duration']."%") ;
                    $string .= self::getElementTable(date("Y-m-d",strtotime($startDate)+$i*24*60*60),
                        $object['id'], 100*$object['rent'][$index]['duration']."%" , $content);
                    $index++;
                }
                else $string.= self::getElementTable(date("Y-m-d",strtotime($startDate)+$i*24*60*60), $object['id']);
            }
        }
        return $string;
    }

    public static function getEmptyRow($object,$startDate,$days) {
        $string = "";
        for ($i=0;$i<$days;$i++) {
            $string .= self::getElementTable(date("Y-m-d",strtotime($startDate)+$i*24*60*60), $object['id']);
        }

        return $string;
    }

    public static function getBlockForRent($rent,$width){
        $string = "";$content ="";





        $content .= Html::tag( "span", "(".
                                Html::tag("i","",["class"=>"fa fa-male", "aria-hidden"=>"true"])."x".  $rent['number'].") ".  $rent['contact_name'].", ".
                                $rent['price']. $rent['currency'],
                            [
                                "style"=>"width: 100%; 
                                        height: 25px; 
                                        float: right;
                                        display:inline-block;
                                        overflow:hidden !important;"
                            ]);
        $content .= Html::tag("i",'',["class"=>"fa fa-hand-paper-o",
            "style"=>"  float: right; width: 15 px;
                                            display: inline-block;
                                            color: black; 
                                            padding-top: 4px; 
                                            padding-right: 2px;"]);
        $content .= Html::tag("img",'',[
            "src"=>($rent['country']=="OAR.png")? "/images/flags/oar_small.png":"https://appt.my-rent.net/assets/images/flags/".$rent['country'],
            "style"=>"padding-left: 2px; 
                            float: right; 
                             display: inline-block;
                            padding-top: 4px;",
            "draggable"=>"false"
        ]);

        $string .= Html::tag('a',$content, [
//                                        'class'=>"hvr-grow-shadow calendar_rent popper",
                                        "data-popbox"=>"pop1",
                                        "data-rent"=>$rent['id'],
                                        "id"=>$rent['id'],
                                        "draggable"=>"true",

                                        "ondragstart"=>"drag(event)",
                                        "onclick"=>"block_main_table();" ,
                            //            "data-toggle"=>"modal",
                            //            "data-target"=>"#modal_rent_edit",
                                        "href"=>"/rents/".$rent['id']."/redirect",
                                        "id"=>"rent:".$rent['id'],
                                        "style"=>"border: 1px solid gray;  height: 25px; 
                                                    color: black; 
                                                    display: inline-block;
                                                    background-color:". $rent['status']["color"].";"
                                        ]);
      return $string;
    }
    public static function getTableHeader($date){
        $month = date("M", strtotime($date));
        $day = date("D", strtotime($date));
        $date = date("d", strtotime($date)); //border-bottom: 2px solid #c7c7c7; text-align: center; width: 40px; background-color: white;
        $contentForA = Html::tag('div',$month, [
            "style"=>"font-weight: 400; 
            background-color: #f8f8f8; 
            border-bottom: dotted 1px silver; "
            ]).
                            Html::tag('div',$date,[]).
                             Html::tag('div',$day,['style'=>"font-weight: 400;"]);
        $content =  Html::tag('a', $contentForA,["class"=>"calendar-row-td-link", "href"=>"/rents/date/".$date, "style"=>"color: black", "onclick"=>'block($("#main_panel"));']);
        $string = ($date== date("Y-m-d",time()))?Html::tag('th',$content,[
            "style"=>"border-bottom: 2px solid #c7c7c7; 
            text-align: center; 
            width: 40px; background-color:#e6ffff; 
            border-top: 3px solid blue;"
        ]):
            Html::tag('th',$content,[
                "style"=>"border-bottom: 2px solid #c7c7c7;
                 text-align: center; 
                 width: 40px; 
                 background-color: white;"
            ]);
        return $string;
    }
    public static function getElementTable($date, $id, $width=null, $rent=null) {
        $content ='';

//ссылка для вызова календаря (модальное окно с букингом)
        $content .= Html::tag('a','',[
//            "class"=>"td-price calendar-row-td-link",
            "ondrop"=>"drop(event)",
            "ondragover"=>"allowDrop(event)",
            "data-date"=>$date,
            "data-object"=>$id,
            "data-toggle"=>"modal",
            "data-target"=>"#modal_rent_add",
           /* "onclick"=>"set_date($(this));",*/
            "style"=>"display: block; 
            height: 25px; 
            font-size: x-small; 
/*           padding-top: 10%; */ 
            color: white;"
        ]
        );
        $content .= ($rent)?
//div с информацией о букинге
            Html::tag('div', $rent, ['id'=>$id."_".$date,
            "style"=>'z-index: 6; 
                      
                      display: inline-block;
                      max-height: 25px;
                      text-align: center;
                      vertical-align: middle;
                      position: absolute;
                      direction: rtl;
                      overflow: hidden;  
                      top: -3%;  
                      left: -50% ; 
                      min-width: '.$width.'; 
                      width: '.$width
            ])
//div просто пустой
            :Html::tag('div','',['id'=>$id."_".$date]);

//td
        $string = ($rent)? Html::tag("td",$content, [
            "style"=>"text-align: center;
            display: inline-block;
            height: 100%; 
            width: 100%;
            vertical-align: middle; 
            min-width: 40px; 
            position: relative;
            overflow: visible;
            z-index: 5"
            ])  :
// td просто пустой
            Html::tag("td",$content, [
                "style"=>"text-align: center; 
                vertical-align: middle; 
                width: 100%;
                min-width: 40px; 
                position: relative; 
                overflow: visible;
                 z-index: -5"
            ]);
//
        return $string ;
    }


}