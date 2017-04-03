<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 05.03.17
 * Time: 13:29
 */

namespace backend\modules\faces\models;

use yii\httpclient\Client;

class FaceClient extends Client
{
    public $baseUrl = 'https://api.facematica.vocord.ru';
    public $API_KEY = 'fcm3d9fe7b8281bd750d4b852de9a7ab0a5fcm';
    public $local_directory; // = dirname(__FILE__).'/../web/assets/images/real_photos/';
    private $Token;

//    /**
//     * FaceClient constructor.
//     * @param $Token
//     */
//    public function __construct($Token)
//    {
//        $this->Token = new Token();
//        parent::__construct();
//    }


//
//
//    public function addUser(array $data)
//    {
//        $response = $this->post('users', $data)->send();
//        if (!$response->isOk) {
//            throw new \Exception('Unable to add user.');
//        }
//        return $response->data['id'];
//    }

}
