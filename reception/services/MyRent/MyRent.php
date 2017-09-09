<?php
/**
 * Created by PhpStorm.
 * User: onarskaya
 * Date: 03.08.17
 * Time: 17:11
 */

namespace reception\services\MyRent;

use reception\forms\BookingForm;
use yii\httpclient\Client;
use yii\db\ActiveRecord;

use yii\web\ServerErrorHttpException;


class MyRent extends ActiveRecord
{
    public const MyRent_User_ID = "611";
    public const MyRent_URL_TO_TOKEN = "https://api.my-rent.net/account/login";
    public const MyRent_URL_TO_GUEST_ADD = "https://api.my-rent.net/guests/add_evizitor/".MyRent::MyRent_User_ID;
    public const MyRent_URL_TO_BOOKINGS_LIST = "https://api.my-rent.net/rents/list_change";
    public const RENT_TIME_PERIOD = 3600*24;
    public const MyRent_ACCESS_TOKEN = "bc8da49e-2b11-11e7-b171-0050563c3009"; // test

    public const MyRent_SICRET_KEY = "bc8da49e-2b11-11e7-b171-0050563c3009";

    private $_token;
    private $_expires;


    public static function addGuest($document,$booking){
        $token  = MyRent::token();
        $post = $document->fields();
        $post = array_merge ([
            "rent_id"=>$booking->external_id,
            //"object_id"=>$booking->apartment->external_id,
           // "date_from"=>  date("Y-m-d",  strtotime($booking->start_date)),
           // "date_until"=> date("Y-m-d",  strtotime($booking->end_date)),
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

    public static function getBookingsForOwner($userId,$objectId)
    {
        $token = MyRent::token();

        //для всех помещений, где owner числится собственником проверяетсяналичие изменений в букингах

            $post = [
                "object_id" => $objectId,
                "from_date" => date("Y-m-d", time()),
                "until_date" => date("Y-m-d", time() + MyRent::RENT_TIME_PERIOD),
                "changed" => date("y-m-d h:i:s", time())
            ];

        $json = \GuzzleHttp\json_encode($post);
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('post')
            ->setUrl(MyRent::MyRent_URL_TO_BOOKINGS_LIST . "/" . $userId)
            ->setHeaders([
                'Authorization:' . $token,
                'Content-Type: application/json'])
            ->setContent($json)
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
//        $token = new static();
//        $expiresString = $token->find()->max('expires');
//        $expires = (!$expiresString)?0:strtotime($expiresString);
//        if ($expires < time()+6000) {
//
//            $client = $client = new Client();
//            $response = $client->createRequest()
//                ->setMethod('post')
//                ->setUrl(self::MyRent_URL_TO_TOKEN)
//                ->setData(['api_key' => self::FASEMATIKA_API_KEY])
//                ->send();
//            $data = json_decode($response->getContent(),true);
//            if (is_array($data)) {
//                if (array_key_exists('token', $data)) {
//                    $token->token = $data["token"];
//                    $token->expires = $data["expires"];
//                    $token->status = 1;
//                    $token->type =$data["type"];
//                    $token->save();
//                    return $token->token;
//                }
//                throw new ServerErrorHttpException("Can not renew token!");
//            }
//        }
//        else return $token->findOne(['expires'=>$expiresString])->token;

        return self::MyRent_ACCESS_TOKEN;
    }

    public static function tableName()
    {
        return '{{%MyRent}}';
    }
}