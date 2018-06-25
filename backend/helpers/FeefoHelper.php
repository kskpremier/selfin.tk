<?php
/**
 * Created by PhpStorm.
 * User: superbrodyaga
 * Date: 6/5/18
 * Time: 3:41 PM
 */

namespace backend\helpers;

use data;
use kartik\date\DatePicker;
use reception\entities\Feefo\FeefoProducts;
use reception\entities\Feefo\FeefoSales;
use reception\entities\MyRent\FeefoSchedule;
use yii\helpers\Html;

class FeefoHelper {

    public static function getSchedule($id) {
        $string='';
        $schedules = FeefoSchedule::find()->where(['object_id'=>$id])->all();
        if ($schedules) {
            foreach ($schedules as $schedule) {
                $string .= //"<p>" . date("Y-m-d", $schedule->from) . " - " . date("Y-m-d", $schedule->to) ." "
                    "<div class=''></div> <div class='col-md-5'>".
                    DatePicker::widget([
                        'name' => $id."-from",
                        'value'=> date("Y-m-d",$schedule->from),
                        'options' => ['placeholder' => 'from', "data-input_from_id"=>$id, 'class'=>'scheduled_from'],
                        'type' => DatePicker::TYPE_INPUT ,
                        'pluginOptions' => [
                            'format' => 'yyyy-mm-dd',
                            'autoclose' => true,]
                    ]).
                    "</div>
                <div class=\"col-md-5\">".
                    DatePicker::widget([
                        'name' => $id."-to",
                        'value'=>date("Y-m-d",$schedule->to),
                        'options' => ['placeholder' => 'to', "data-input_to_id"=>$id, 'class'=>'scheduled_to'],
                        'type' => DatePicker::TYPE_INPUT ,
                        'pluginOptions' => [
                            'format' => 'yyyy-mm-dd',
                            'autoclose' => true,]
                    ])."</div>"
                    .Html::button('',
                        ['type' => 'button', 'data-name'=>$id.'-button', 'title' =>  'Remove from schedule', 'class' => 'btn btn-danger glyphicon glyphicon-remove-sign scheduled' ,'id'=>$id.'-button',
                            'onclick' =>'removeScheduleObject(this)']). " </p>";
                //'<i id="'.$id.'"-icon" class="glyphicon glyphicon-remove-sign"></i>',
            }
        }
        else {
            $string .=  "<div class=''></div> <div class='col-md-5'>".
                DatePicker::widget([
                    'name' => $id."-from",
                    'options' => ['placeholder' => 'from', "data-input_from_id"=>$id,  'class'=>'unscheduled_from'],
                    'type' => DatePicker::TYPE_INPUT ,
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        'autoclose' => true,]
                ]).
                "</div>
                <div class=\"col-md-5\">".
                DatePicker::widget([
                    'name' => $id."-to",
                    'options' => ['placeholder' => 'to', "data-input_to_id"=>$id, 'class'=>'unscheduled_to'],
                    'type' => DatePicker::TYPE_INPUT ,
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        'autoclose' => true,]
                ])."</div>"
                .Html::button('', ['type' => 'button', 'data-name'=>$id.'-button', 'id'=>$id.'-button',
                'title' =>  'Add to schedule', 'class' => 'btn btn-success glyphicon glyphicon-ok unscheduled', 'onclick' =>'addScheduleObject(this)']);
            //'<i id="'.$id.'"-icon"  class="glyphicon glyphicon-ok"></i>'
        }
        return $string;
    }

    public static function getShortDesription($object)
    {
        $descrpiptions = $object->objectsRealestatesDescriptions;
        if (count($descrpiptions)) {
            foreach ($descrpiptions as $descrpiption) {
                if ($descrpiption->language_id == 1) {
                    $text = strip_tags($descrpiption->short);
//                    $text = htmlentities($text);// &nbsp;
                    $text = str_replace(chr(160), ' ', html_entity_decode(htmlspecialchars_decode($text)));
                    $text = str_replace('&nbsp;', ' ', $text);
                    $text = str_replace('&#39;', "'", $text);
                    $text = self::clearstr($text);
                    return $text;
                }
            }
            $text =strip_tags($descrpiptions[0]->short);
            $text = htmlentities($text);// &nbsp;
            $text = str_replace(chr(160), ' ', html_entity_decode(htmlspecialchars_decode($text)));
            $text = str_replace('&nbsp;', ' ', $text);
            $text = str_replace('&#39;', "'", $text);
            $text = self::clearstr($text);
            return $text;
        }
        else return '';
    }

    public static function getProductName ($id) {
        if ($product = FeefoProducts::find()->where(['object_id'=>$id])->one()){
            $params = json_decode($product->params,true);
            return $params['title'];
        }
        return $id;
    }

    /**
     * Функция была взята с php.net
     **/
    public static function utf8_str_split($str) {
        // place each character of the string into and array
        $split=1;
        $array = array();
        for ( $i=0; $i < strlen( $str ); ){
            $value = ord($str[$i]);
            if($value > 127){
                if($value >= 192 && $value <= 223)
                    $split=2;
                elseif($value >= 224 && $value <= 239)
                    $split=3;
                elseif($value >= 240 && $value <= 247)
                    $split=4;
            }else{
                $split=1;
            }
            $key = NULL;
            for ( $j = 0; $j < $split; $j++, $i++ ) {
                $key .= $str[$i];
            }
            array_push( $array, $key );
        }
        return $array;
    }
    /**
     * Функция вырезки
     * @param <string> $str
     * @return <string>
     */
    public static function clearstr($str){
        $sru = 'ёйцукенгшщзхъфывапролджэячсмитьбю';
        $s1 = array_merge(
            self::utf8_str_split($sru),
            self::utf8_str_split(strtoupper($sru)),
            range('A', 'Z'),
            range('a','z'),
            range('0', '9'),
            array('&',' ','#',';','%','?',':','(',')','-','_','=','+','[',']',',','.','/','\\'));
        $codes = array();
        for ($i=0; $i<count($s1); $i++){
            $codes[] = ord($s1[$i]);
        }
        $str_s = self::utf8_str_split($str);
        for ($i=0; $i<count($str_s); $i++){
            if (!in_array(ord($str_s[$i]), $codes)){
                $str = str_replace($str_s[$i], '', $str);
            }
        }
        return $str;
    }

}