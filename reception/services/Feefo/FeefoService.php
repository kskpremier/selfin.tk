<?php
namespace reception\services\Feefo;

class FeefoService {
    //The Feefo URL
    public const FEEFO_URL_ENTER_SALES = 'https://api.feefo.com/api/entersaleremotely';
    public const FEEFO_API_KEY = "41ff84ad-80e8-4d7a-bea9-a4dd4cb03632";
    public const FEEFO_MERCHANT_ID = "vip-holiday-booker";

//The parameters
    public static function enterSalesRemotely ($params)
    {
        if (!self::isNotInList($params ['email'])) {
            $params = array(
                'apikey' => FeefoService::FEEFO_API_KEY,
                'merchantidentifier' => FeefoService::FEEFO_MERCHANT_ID,
                'orderref' => $params['orderref'],
                'productsearchcode' => $params['productsearchcode'],
                'date' => $params['date'],
                'name' => $params['name'],
                'email' => $params['email'],
                'description' => $params['description'],
                'tags' => $params['tags'],
                'amount' => $params['amount'],
                'currency' => $params['currency'],
                'productattributes' => $params['productattributes'],
                'feedbackdate' => $params['feedbackdate'],
                'locale' => $params['locale'],
                'productlink' => $params['productlink'],
            );

            //Build up the query and use curl to execute it.
            $data = http_build_query($params, '', '&');
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, FeefoService::FEEFO_URL_ENTER_SALES);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $reply = curl_exec($ch);
            curl_close($ch);
        }
        else $reply = "Not sent. Email is in stop list!";
       return $reply;
    }

    public static function recordToExcel ($filename,$list,$headers)
    {

        $hand = fopen($filename, 'w');

        fputcsv($hand,$headers);//implode(',',$headers)
        $i=0;
        foreach($list as $element)
        {
            if ($element['name']!=''&& $element ['email']!='' && !self::isNotInList($element ['email'])) {
                fputcsv($hand, $element);
                $i++;
            }
        }
        fclose($hand);

        return $i;
    }
    public static function recordProductsToCSV ($filename,$list,$headers)
    {

        $hand = fopen($filename, 'w');

        fputcsv($hand,$headers);
        $i=0;
        foreach($list as $element)
        {
                fputcsv($hand, $element);
                $i++;
        }
        fclose($hand);

        return $i;
    }

    public static function isNotInList ($email)
    {

        $list = ["@guest.booking.com","@guest.airbnb.com","@luxuryretreats.com","@bm.holidaylettings.co.uk","@oliverstravels.com", "@qualityvillas.com", "@orgon.travel.agency@gmail.com"];

        foreach($list as $element){
            if (strpos($email, $element))
                return true;
        }
        return false;
    }

}