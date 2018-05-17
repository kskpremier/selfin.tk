<?php

namespace reception\services\eVisitor;

use reception\services\eVisitor\CheckIn;

/**
 * Created by PhpStorm.
 * User: superbrodyaga
 * Date: 1/10/18
 * Time: 2:38 PM
 */

class eVisitor

{
    public const HOST = "https://www.evisitor.hr/testApi/Rest/"; //"https://www.evisitor.hr" - для боевого
    public const HOST_LOGIN = "https://www.evisitor.hr/testApi/Resources/AspNetFormsAuth/Authentication/Login";

    public const USERNAME = "03193939044.mreception";
    public const PASSWORD = "S8mDMAg5";

    public const FACILITY = "0034643";
    public const URL_CheckInTourist = "Htz/CheckInTourist/";
    public const URL_CancelTouristCheckIn = "Htz/CancelTouristCheckIn/";
    public const URL_CheckOutTourist = "Htz/CheckOutTourist/";

    private $cookieContent;

    public function __construct()
    {
        return $this->login();
    }

    public function login() {
    $data = array("UserName" => self::USERNAME, "Password" => self::PASSWORD, "PersistCookie" => "false");
    $data_string = json_encode($data);
    $login_url = self::HOST_LOGIN;
    $ch = curl_init($login_url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_VERBOSE, 1);
    curl_setopt($ch, CURLOPT_HEADER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data_string))
    );

    $response = curl_exec($ch);
    $responseCode = curl_getinfo($ch)['http_code'];
    $this->cookieContent = $this->get_headers_from_curl_response($response)["Set-Cookie"];
    list($header, $body) = explode("\r\n\r\n", $response, 2);
    if ($responseCode == "200" && $body == "true")
        return true;
    else
       return false;

}

public function checkin($booking, $document){
    $checkin = new CheckIn($document, $booking);
    $check_in_data_string = json_encode($checkin->asArray());
    $check_in_url = self::HOST.self::URL_CheckInTourist;
    $ch = curl_init($check_in_url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $check_in_data_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_VERBOSE, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_COOKIE, $this->cookieContent);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json; charset=utf-8',
            'Content-Length: ' . strlen($check_in_data_string))
    );

    $response = curl_exec($ch);
    $responseCode = curl_getinfo($ch)['http_code'];

    return $checkin->ID;
//    if ($responseCode == "200") {
//        echo "OK";
//    } else {
//        echo "Error: ".$response;
//    }


}

    public function checkout($documentGuid, $dataFrom, $timeFrom){

        $check_out_data_string = '{"ID":"'.$documentGuid.'","CheckOutDate":"'.date("Ymd",strtotime($dataFrom)).'","CheckOutTime":"'.date("H:i",strtotime($timeFrom)).'"}';
        $check_out_url = self::URL_CheckOutTourist;
        $ch = curl_init($check_out_url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $check_out_data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_COOKIE, $this->cookieContent);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($check_out_data_string))
        );
        $response = curl_exec($ch);
        $responseCode = curl_getinfo($ch)['http_code'];
        return $response;
    }

 public function get_headers_from_curl_response($response)
    {
        $headers = array();
        $header_text = substr($response, 0, strpos($response, "\r\n\r\n"));
        foreach (explode("\r\n", $header_text) as $i => $line)
            if ($i === 0)
                $headers['http_code'] = $line;
            else
            {
                list ($key, $value) = explode(': ', $line);
                if ($key == "Set-Cookie") {
                    $value = str_replace('HttpOnly', '', $value);
                }

                if (isset($headers[$key])){
                    $headers[$key] = $headers[$key]." ".$value;
                } else {
                    $headers[$key] = $value;
                }
            }
        return $headers;
    }

}