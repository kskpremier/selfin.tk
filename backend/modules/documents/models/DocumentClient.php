<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 05.03.17
 * Time: 13:35
 */
namespace backend\modules\faces;

use yii\httpclient\Client;

class DocumentClient extends Client
{
    public $baseUrl = 'http://cloud.ocrsdk.com';
    public $API_KEY = 'fcm3d9fe7b8281bd750d4b852de9a7ab0a5fcm';
    public $password = '1qUEQN09CAKveNT64f+UENVk';
    public $applicationId = 'e-reception';
    public $local_directory;

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