<?php
/**
 * Created by PhpStorm.
 * User: superbrodyaga
 * Date: 2/17/18
 * Time: 3:56 PM
 */
namespace backend\helpers;

use data;
use function key_exists;
use yii\helpers\Html;

class CalendarHelper{

    // получает данные в виде массива на каждый день (или букинг или пусто)
    // должна вернуть готовый тег <tr></tr>
    public static function getOneRow($object, $days, $startDate, $width){
        $string=''; $index =0;
        if ($object['load']==0)
            //генерируем пустую ячейку
            return self::getEmptyRow( $object, $startDate, $days);
        else {
            for ($i=0;$i<$days;$i++) {
                if($object['data'][$i]==0){
                    $content = self::getBlockForRent($object['rent'][$index],100*$object['rent'][$index]['duration']."%");
                    $string .= self::getElementTable(date("Y-m-d",strtotime($startDate)+$i*24*60*60),
                        $object['id'], 100*$object['rent'][$index]['duration']."%" , $content);
                    $index++;

                }
                else {
                    $string .= self::getElementTable(date("Y-m-d", strtotime($startDate) + $i * 24 * 60 * 60), $object['id']);
                }
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
        $data=$date;
        $month = date("M", strtotime($data));
        $day = date("D", strtotime($data));
        $date = date("d", strtotime($data)); //border-bottom: 2px solid #c7c7c7; text-align: center; width: 40px; background-color: white;
        $classTh = ($day == 'Sat'|| $day == "Sun")?'weekend':'';
        $contentForA = Html::tag('div',$month, [
                "class"=>  $classTh,
            "style"=>"font-weight: 400; 
            background-color: #f8f8f8; 
            border-bottom: dotted 1px silver; "
            ]).
            Html::tag('div',$date,[  "class"=>  $classTh]).
            Html::tag('div',$day,[  "class"=>  $classTh, 'style'=>"font-weight: 400;"]);


        $content =  Html::tag('a', $contentForA,["class"=>"calendar-row-td-link", "href"=>"/rents/date/".$data, "style"=>"color: black", "onclick"=>'block($("#main_panel"));']);

        $string = ($date == date("Y-m-d",time())) ? Html::tag('th',$content, [
            "class"=>  $classTh,
            "style"=>"border-bottom: 2px solid #c7c7c7; 
            text-align: center; 
             min-width: 40px; 
            width: 40px; background-color:#e6ffff; 
            border-top: 3px solid blue;"
        ]):
            Html::tag('th',$content,[
                "class"=>  $classTh,
                "style"=>"border-bottom: 2px solid #c7c7c7;
                 text-align: center;
                 min-width: 40px; 
                 width: 40px; 
                 background-color: white;"
            ]);
        return $string;
    }

    public static function getTableHeaderMonth($date) {
        $data = $date;
        $month = date("M", strtotime($data));
        $day = date("D", strtotime($data));
        $date = date("d", strtotime($data)); //border-bottom: 2px solid #c7c7c7; text-align: center; width: 40px; background-color: white;
        $classTh = ($day == 'Sat'|| $day == "Sun")?'weekend':'';
        $contentForA = Html::tag('div', $month, [
                "class"=>  $classTh,
                "style"=>"font-weight: 400;"
            ]);
//            .
//            Html::tag('div',$date,[  "class"=>  $classTh]).
//            Html::tag('div',$day,[  "class"=>  $classTh, 'style'=>"font-weight: 400;"]);


        $content =  Html::tag('a', $contentForA,["class"=>"calendar-row-td-link", "href"=>"/rents/date/".$data, "style"=>"color: black", "onclick"=>'block($("#main_panel"));']);

        $string = ($date == date("Y-m-d", time()) ) ? Html::tag('th',$content, [
            "class"=>  $classTh,
            "style"=>"border-bottom: 2px solid #c7c7c7; 
            text-align: center; 
             min-width: 40px; 
            width: 40px; background-color:#e6ffff; 
            border-top: 3px solid blue;"
        ]):
            Html::tag('th',$content,[
                "class"=>  $classTh,
                "style"=>"border-bottom: 2px solid #c7c7c7;
                 text-align: center;
                 min-width: 40px; 
                 width: 40px; 
                 background-color: white;"
            ]);
        return $string;
    }
    public static function getTableHeaderDate($date) {
        $data = $date;
        $month = date("M", strtotime($data));
        $day = date("D", strtotime($data));
        $date = date("d", strtotime($data)); //border-bottom: 2px solid #c7c7c7; text-align: center; width: 40px; background-color: white;
        $classTh = ($day == 'Sat'|| $day == "Sun")?'weekend':'';
        $contentForA = Html::tag('div', $date, [
            "class"=>  $classTh,
            "style"=>"font-weight: 400; 
            background-color: #f8f8f8; 
            border-bottom: dotted 1px silver; "
        ]);
//            .
//            Html::tag('div',$date,[  "class"=>  $classTh]).
//            Html::tag('div',$day,[  "class"=>  $classTh, 'style'=>"font-weight: 400;"]);


        $content =  Html::tag('a', $contentForA,["class"=>"calendar-row-td-link", "href"=>"/rents/date/".$data, "style"=>"color: black", "onclick"=>'block($("#main_panel"));']);

        $string = ($date == date("Y-m-d", time()) ) ? Html::tag('th',$content, [
            "class"=>  $classTh,
            "style"=>"border-bottom: 2px solid #c7c7c7; 
            text-align: center; 
             min-width: 40px; 
            width: 40px; background-color:#e6ffff; 
            border-top: 3px solid blue;"
        ]):
            Html::tag('th',$content,[
                "class"=>  $classTh,
                "style"=>"border-bottom: 2px solid #c7c7c7;
                 text-align: center;
                 min-width: 40px; 
                 width: 40px; 
                 background-color: white;"
            ]);
        return $string;
    }
    public static function getTableHeaderDay($date) {
        $data = $date;
        $month = date("M", strtotime($data));
        $day = date("D", strtotime($data));
        $date = date("d", strtotime($data)); //border-bottom: 2px solid #c7c7c7; text-align: center; width: 40px; background-color: white;
        $classTh = ($day == 'Sat'|| $day == "Sun")?'weekend':'';
        $contentForA = Html::tag('div', $day, [
            "class"=>  $classTh,
            "style"=>"font-weight: 400; 
            background-color: #f8f8f8; 
            border-bottom: dotted 1px silver; "
        ]);
//            .
//            Html::tag('div',$date,[  "class"=>  $classTh]).
//            Html::tag('div',$day,[  "class"=>  $classTh, 'style'=>"font-weight: 400;"]);


        $content =  Html::tag('a', $contentForA,["class"=>"calendar-row-td-link", "href"=>"/rents/date/".$data, "style"=>"color: black", "onclick"=>'block($("#main_panel"));']);

        $string = ($date == date("Y-m-d", time()) ) ? Html::tag('th',$content, [
            "class"=>  $classTh,
            "style"=>"border-bottom: 2px solid #c7c7c7; 
            text-align: center; 
             min-width: 40px; 
            width: 40px; background-color:#e6ffff; 
            border-top: 3px solid blue;"
        ]):
            Html::tag('th',$content,[
                "class"=>  $classTh,
                "style"=>"border-bottom: 2px solid #c7c7c7;
                 text-align: center;
                 min-width: 40px; 
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

    public static function getSimpleRow ($object, $days, $date, $prices) {
        $result = "";
        for ($i=0;$i<$days;$i++) {
            $day = date("D",$date+$i*60*60*24);
            $classTh = ($day == 'Sat'|| $day == "Sun")?'weekend':'';
            $content = (key_exists($i,$prices['price']))?$prices['price'][$i]:'-';
            $content .= ' ';
            $content .= (key_exists($i,$prices['min_stay']))?$prices['min_stay'][$i]: '-';
            if($object['data'][$i]==1) $result.= Html::tag('td', Html::tag('div',$content, ['style'=>"background-color: white; min-width: 40px",'class'=>'text-center '.$classTh]));
            else $result .= Html::tag('td', Html::tag('div',$content,['style'=>"background-color: 	#FFB6C1;min-width: 40px;",'class'=>'text-center '.$classTh]),['class'=>'booked']);
        }
        return $result;
    }

    public static function getRowForPrice ($object, $days, $start, $id) {
        $content='';
        $classes='';
        $string='';
        for ($i=0; $i<$days; $i++) {
            $day = date("D",$start);
            $classes = ($day == 'Sat'|| $day == "Sun")?'info':'success';
            if (key_exists('availability',$object[$i]) && $object[$i]['availability']==0)
                $classes.= ' danger';
//            $content = Html::tag('h3', $object[$i]['price'],['class'=>'price']);
//            $content .= Html::tag('h6', $object[$i]['min_stay'],['class'=>'minimum_stay']);
            $content = Html::tag('input', $object[$i]['price'],
                ['type'=>"text", 'id'=>'table_price_'.$id.'_'.$i, 'class'=>"form-control yielding text-center ".$classes, 'name'=>"PriceTableSetForm[price]", 'placeholder'=>$object[$i]['price'],'value'=>$object[$i]['price'], 'aria-invalid'=>"false"]);
//            $content .= Html::tag('h6', $object[$i]['min_stay'],[]);
            $string .= Html::tag('td',$content,['class'=>'yielding text-center '.$classes,  'data-id'=>$id, 'data-index'=>$i, 'id'=>'price_'.$id.'_'.$i]);
        }
        return  $string;
    }

    public static function getRowForMinStay ($object, $days, $start, $id) {
        $content='';
        $classes='';
        $string='';
        for ($i=0; $i<$days; $i++) {
            $day = date("D",$start);
            $classes = ($day == 'Sat'|| $day == "Sun")?'info':'success';
            if (key_exists('availability',$object[$i]) && $object[$i]['availability']==0)
                $classes.= ' danger';
//            $content = Html::tag('h3', $object[$i]['price'],['class'=>'price']);
//            $content .= Html::tag('h6', $object[$i]['min_stay'],['class'=>'minimum_stay']);
//            $content = Html::tag('h4', $object[$i]['price'],[]);
            if ($object[$i]['holeAlert']==1) {
                $content = Html::tag('h6', (key_exists('min_stay', $object[$i])) ? $object[$i]['min_stay'] : '-', ['class'=>'blink']);
                $string .= Html::tag('td', $content, ['class' => 'yielding text-center ' . $classes, 'data-id'=>$id, 'data-index'=>$i, 'id'=>'min_stay_'.$id.'_'.$i]);
            }
            else {
            $content = Html::tag('h6', (key_exists('min_stay', $object[$i]))?$object[$i]['min_stay']:'-',[]);
            $string .= Html::tag('td',$content,['class'=>'yielding text-center '.$classes, 'data-id'=>$id, 'data-index'=>$i, 'id'=>'min_stay_'.$id.'_'.$i]);
            }
        }
        return  $string;
    }


}