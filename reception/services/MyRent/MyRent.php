<?php
/**
 * Created by PhpStorm.
 * User: onarskaya
 * Date: 03.08.17
 * Time: 17:11
 */

namespace reception\services\MyRent;

use reception\entities\Booking\Document;
use reception\forms\BookingForm;
use yii\httpclient\Client;
use yii\db\ActiveRecord;

use yii\web\ServerErrorHttpException;


class MyRent extends ActiveRecord
{
    public const MyRent_User_ID = "611";
    public const MyRent_UPDATE_INTERVAL = 600; //10 минут на обновление
    public const MyRent_URL_TO_TOKEN = "https://api.my-rent.net/account/login";
    public const MyRent_URL_TO_GUEST_ADD = "https://api.my-rent.net/guests/add_evizitor/".MyRent::MyRent_User_ID;
    public const MyRent_URL_TO_RENTS_FROM_TO = "https://api.my-rent.net/rents/rents_from_to";
    public const MyRent_URL_TO_BOOKINGS_LIST = "https://api.my-rent.net/rents/list";
    public const MyRent_URL_TO_APARTMENTS_LIST = "https://api.my-rent.net/objects/list";
    public const MyRent_URL_TO_UPDATE_BOOKINGS_FOR_USER = "https://api.my-rent.net/rents/list_change";
    public const MyRent_URL_TO_UPDATE_BOOKINGS_FOR_OWNER = "https://api.my-rent.net/rents/list_change_owner";
    public const MyRent_URL_TO_ARRIVALS_LIST = "https://api.my-rent.net/rents/arrivals";
    public const MyRent_URL_TO_RENT = "https://api.my-rent.net/rents/get";
    public const RENT_TIME_PERIOD = 3600*24;
    public const MyRent_ACCESS_TOKEN = "bc8da49e-2b11-11e7-b171-0050563c3009"; // test

    public const MyRent_SICRET_KEY = "bc8da49e-2b11-11e7-b171-0050563c3009";

    private $_token;
    private $_expires;


    public static function addGuest($document,$booking,$eVisitor=null){
        $token  = MyRent::token();
        $post = $document->fields();
        $post = array_merge ([
            "rent_id"=>$booking->external_id,
            "eVisitor"=>($eVisitor==null or $eVisitor)?true:false,
        ], $post);
        $json = \GuzzleHttp\json_encode($post);
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('post')
            ->setUrl(MyRent::MyRent_URL_TO_GUEST_ADD)
            ->setHeaders([
                'Authorization:'.$token,
                'Content-Type: application/json'])
            ->setContent($json)
            ->send();
        return $response->content;
    }

    public static function getBookingsForOwner($userId,$objectId=null)
    {
        $token = MyRent::token();

        //для всех помещений, где owner числится собственником проверяетсяналичие изменений в букингах

            $post = //[
               // "object_id" => $objectId,
              //  "from_date" => date("Y-m-d", time()),
              //  "until_date" => date("Y-m-d", time() + MyRent::RENT_TIME_PERIOD),
              //  "changed" => date("Y-m-d h:i:s", time())
           // ];

        $json ="{}";// \GuzzleHttp\json_encode($post);
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('post')
            ->setUrl(MyRent::MyRent_URL_TO_ARRIVALS_LIST . "/" . $userId)
            ->setHeaders([
                'Authorization:' . $token,
                'Content-Type: application/json'])
            ->setContent($json)
            ->send();
            //обработка ответа и укладка данных в базу

        return $response->content;
    }

    public static function getBookingsFromTo($userId,$from,$to=null)
    {
//        $token = MyRent::token();
        $from = (isset($from))? date("Y-m-d",time()):$from;
        $to=(isset($to))?$to:$from;
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('get')
            ->setUrl(MyRent::MyRent_URL_TO_RENTS_FROM_TO . "?from=" . $from."&to=".$to."&user_id=".$userId)
//            ->setHeaders([
//                'Authorization:' . $token,
//                'Content-Type: application/json'])
//            ->setData(['﻿from' => $from, '﻿to' => $to])
            ->send();
        //обработка ответа и укладка данных в базу
        return $response->content;
    }

    /**
     * MyRent constructor.
     * @param $_token
     * @param $_expires
     */
    public static function token():string
    {

        return self::MyRent_ACCESS_TOKEN;
    }

    public static function tableName()
    {
        return '{{%MyRent}}';
    }

    public static function getBookingsUpdateForUser($userId,$date=null)
    {
        $client = new Client();
        $date = ($date)? $date : date("Y-m-d H:i:s",time());
        $response = $client->get(MyRent::MyRent_URL_TO_UPDATE_BOOKINGS_FOR_USER . "/".$userId, ['date'=>$date],[],[])->send();
        if ($response->content != "NoContent" && is_array($rentsList = json_decode($response->content, true)))
            return $rentsList;
        else return [];
    }
    public static function getBookingsUpdateForOwner($ownerId,$date=null)
    {
        $client = new Client();
        $date = ($date)? $date : date("Y-m-d H:i:s",time());
        $response = $client->get(MyRent::MyRent_URL_TO_UPDATE_BOOKINGS_FOR_OWNER. "/".$ownerId, ['date'=>$date],[],[])->send();
        if ($response->content != "NoContent" && is_array($rentsList = json_decode($response->content, true)))
            return $rentsList;
        else return [];
    }
    public static function getApartmentsForUser($userId):array
    {
        $client = new Client();
        $response = $client->get(MyRent::MyRent_URL_TO_APARTMENTS_LIST . "/".$userId,[],[],[])->send();
        $result = is_string ($response->content)? json_decode($response->content, true): [];
        return $result;
    }
    public static function getRent($rent_id):array
    {
        $client = new Client();
        $response = $client->get(MyRent::MyRent_URL_TO_RENT . "/".$rent_id,[],[],[])->send();
        if( ($response->content !=="NoContent") && is_array ($result =json_decode($response->content, true) ) )
            return $result;
        return[];
    }
}