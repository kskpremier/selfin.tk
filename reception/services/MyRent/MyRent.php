<?php
/**
 * Created by PhpStorm.
 * User: onarskaya
 * Date: 03.08.17
 * Time: 17:11
 */

namespace reception\services\MyRent;

use function is_array;
use function key_exists;
use reception\entities\Booking\Booking;
use reception\entities\Booking\Document;
use reception\entities\User\User;
use reception\forms\BookingForm;
use reception\forms\MyRent\PriceSetForm;
use reception\helpers\MyRentHelper;
use superuser\entities\Price\ObjectsPricesDays;
use userAgent;
use yii\httpclient\Client;
use yii\db\ActiveRecord;

use yii\web\ServerErrorHttpException;


class MyRent extends ActiveRecord
{
    public const MyRent_User_ID = "611";
    public const MyRent_USER_UPDATE_INTERVAL = 6000; // 1 раз в месяц
    public const MyRent_UPDATE_INTERVAL = 600; //10 минут на обновление
    public const MyRent_URL_TO_TOKEN = "https://api.my-rent.net/account/login";
    public const MyRent_URL_TO_GUEST_ADD = "https://api.my-rent.net/guests/add_evizitor/";
    public const MyRent_URL_TO_RENTS_FROM_TO = "https://api.my-rent.net/rents/rents_from_to";
    public const MyRent_URL_TO_BOOKINGS_LIST = "https://api.my-rent.net/rents/list";
    public const MyRent_URL_TO_APARTMENTS_LIST = "https://api.my-rent.net/objects/list";
    public const MyRent_URL_TO_UPDATE_BOOKINGS_FOR_USER = "https://api.my-rent.net/rents/list_change";
    public const MyRent_URL_TO_UPDATE_BOOKINGS_FOR_OWNER = "https://api.my-rent.net/rents/list_change_owner";
    public const MyRent_URL_TO_GUEST_LIST = "https://api.my-rent.net/guests/list_rent/";
    public const MyRent_URL_TO_ARRIVALS_LIST = "https://api.my-rent.net/rents/arrivals";
    public const MyRent_URL_APARTMENTS_GET = "https://api.my-rent.net//objects/get/";
    public const MyRent_URL_TO_RENT = "https://api.my-rent.net/rents/get";
    public const MyRent_b2b_id = "185";
    public const RENT_TIME_PERIOD = 3600*24;
    public const MyRent_ACCESS_TOKEN = "bc8da49e-2b11-11e7-b171-0050563c3009"; // testname;guid
//Demo user;f4e08415-c6e7-11e5-b7cf-0050563c3009
//Neven Palčec;f4e088c1-c6e7-11e5-b7cf-0050563c3009
//Rona Barbariga;555d208a-2b11-11e7-b171-0050563c3009
//Rona Zaglav;68e7ba9d-2b11-11e7-b171-0050563c3009
//Rona Gajac;8900c86d-2b11-11e7-b171-0050563c3009
//Rona Kvarner;bc8da49e-2b11-11e7-b171-0050563c3009
//Rona Savudrija;d9ddc81c-2b11-11e7-b171-0050563c3009
//Demo MyRentReception;5dc7a80b-e254-11e7-b893-0050563c3009


    public const MyRent_SICRET_KEY = "bc8da49e-2b11-11e7-b171-0050563c3009";

    private $_token;
    private $_expires;


    public static function addGuest(Document $document, $bookingId, $eVisitor=null, User $user){
//        $user = User::findOne($userId);
        $token  = MyRent::tokenMyrent($user->id);
        $post = $document->fieldsForMyRent();
        $post = array_merge ([
            "rent_id"=>$bookingId,
            "eVisitor"=>($eVisitor==null or $eVisitor)?true:false,
            "b2b_id"=>self::MyRent_b2b_id
        ], $post);
        $json = \GuzzleHttp\json_encode($post);
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('post')
            ->setUrl(MyRent::MyRent_URL_TO_GUEST_ADD.$user->external_id)
            ->setHeaders([
                'Authorization:'.$token,
                'Content-Type:application/json'])
            ->setContent($json)
            ->send();
        return $response->content;
    }

    public static function getGuestsForBooking(Booking $booking){
        $client = new Client();
        $response = $client->createRequest()->setMethod('get')
            ->setUrl(MyRent::MyRent_URL_TO_GUEST_LIST.$booking->external_id)
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
              //  "until_date" => date("Y-m-d", time() + MyRentReception::RENT_TIME_PERIOD),
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
//        $token = MyRentReception::token();
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
     * MyRentReception constructor.
     * @param $_token
     * @param $_expires
     */
    public static function tokenMyrent($userId):string
    {
        $tokenRow = MyRent::find()->where(["user_id"=>$userId])->one();

        return  ($tokenRow)?$tokenRow->token:"5dc7a80b-e254-11e7-b893-0050563c3009";
    }

    public static function tableName()
    {
        return '{{%myrent}}';
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User ::className(), ['id' => 'user_id']);
    }

    public static function getBookingsUpdateForUser($userId, $date = null)
    {
        $client = new Client();
        $date = ($date)? date("Y-m-d H:i:s",$date):"2018-06-01";
        $response = $client->get(MyRent::MyRent_URL_TO_UPDATE_BOOKINGS_FOR_USER . "/".$userId, ['date'=>$date],[],[])->send();
        if ($response->content != "NoContent" && is_array($rentsList = json_decode($response->content, true))) {
            if (!key_exists("Message", $rentsList))
                return $rentsList;
        }
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
        if( ($response->content !=="NoContent") && is_array ($result = json_decode($response->content, true) ) )
            return $result;
        return[];
    }

    public static function getApartmentsById($id):array
    {
        $client = new Client();
        $response = $client->get(MyRent::MyRent_URL_APARTMENTS_GET . "/".$id,[],[],[])->send();
        $result = is_string ($response->content)? json_decode($response->content, true): [];
        return $result;
    }

    public static function getVacationObjects()
    {
        $client = new Client();

        $response = $client->get('https://apit.my-rent.net/vacationkey/list/653', [],[],[])->send();
        if ($response->content != "NoContent" && is_array($vacationkey = json_decode($response->content, true)))
            return $vacationkey;
        else return [];
    }

    public static function getVacationObjectXML($id)
    {
        $client = new Client();

        $response = $client->get('https://apit.my-rent.net/vacationkey/get/'.$id, [],[],[])->send();
        if ($response->content != "NoContent" && $vacationkey = simplexml_load_string($response->content))
            return $vacationkey;
        else return false;
    }
    public static function priceSet($objectId, $reception, $from, $to, $price, $min_stay)
    {
        $client = new Client();
         $data['price']= $price;
         $data['min_stay'] = $min_stay;
        $data['from']=$from;
        $data['until']=$to;
        $data['item_id']='';
        $response = $client->createRequest()
                    ->setMethod('get')
                    ->setData($data)
                    ->setHeaders(['Authorization'=>MyRentHelper::getGuidForReception($reception)])
                    ->setUrl('https://api.my-rent.net/object_prices/update_price/'.$objectId)//.'?from='.$from.'&amp;until='.$to.'&price='.$price.'&min_stay='.$min_stay)
                    ->send();
        if ($response->content == '"ok"')
            return true;
        else return false;
    }

    public static function getVacationLinkObject($file)
    {
        $client = new Client();

        $response =  $client->createRequest()
            ->setMethod('post')
            ->setUrl('http://api.vacationkey.com/2.0.1/2565/sendXMLProducts')
            ->setHeaders([
                'Authorization: Basic T1JHT046T1IjR09ONDU=',
                'User-Agent: ORGON,PARTNER_ID:2565'])
            ->addFile('XML', $file)
            ->send();
        if ($vacationkey = simplexml_load_string($response->content))
            return $vacationkey;
        else return false;
    }

    public static function sendXML($file)
    {
        if (!file_exists($file)) return "$file not found";
        $cfile = curl_file_create($file,'text/xml','PRODUCTS_PARTNER_ID_2565.XML');
        $payload = array('XML' => $cfile); $url="https://api.vacationkey.com/2.0.1/2565/sendXMLProducts";
        $process = curl_init();
        curl_setopt($process,CURLOPT_URL,$url);
        curl_setopt($process,CURLOPT_HTTPHEADER, array( "Content-Type: multipart/form-data")); 
        curl_setopt($process,CURLOPT_USERAGENT, "ORGON, PARTNER_ID: 2565");
        curl_setopt($process,CURLOPT_HEADER, 0);
        curl_setopt($process,CURLOPT_SAFE_UPLOAD, 1);
        curl_setopt($process,CURLOPT_USERPWD, "ORGON:OR#GON45"); 
        curl_setopt($process,CURLOPT_TIMEOUT, 30);
        curl_setopt($process,CURLOPT_POST, 1);
        curl_setopt($process,CURLOPT_POSTFIELDS, $payload);
        curl_setopt($process,CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($process,CURLOPT_VERBOSE, FALSE);
        $return = curl_exec($process);
        $info = curl_getinfo($process);
        curl_close($process);
        return $return;
    }
}