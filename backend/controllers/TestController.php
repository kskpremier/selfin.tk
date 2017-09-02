<?php

namespace backend\controllers;

use reception\entities\Booking\Document;
use Yii;
use yii\web\Controller;
use yii\httpclient\Client;

class TestController extends Controller
{


    public function actionDocumentAdd()
    {
        $document = new Document();
        $document->images = [];
        $client = $client = new Client([
            'baseUrl' => "http://restapi.domouprav.local/document/add",
            'requestConfig' => [
                //'format' => Client::FORMAT_JSON
            ],
            'responseConfig' => [
               // 'format' => Client::FORMAT_JSON
            ],
        ]);
        $response = $client->createRequest()
            ->setMethod('post')
            ->setHeaders(['content-type' => 'multipart/form-data',
                            'Authorization' => 'Bearer 2c29a1829945bd3ff8efd3b8de5851c48ee1a1ce'])
            ->setData([
                     "firstName"=>"serg",
                    "secondName"=>"serginio",
                     "identityData"=>"027",
                     "numberOfDocument"=>"123456",
                     "gender"=>"male",
                      "country"=>"syr",
                      "city"=>"Damask",
                    "countryOfBirth"=>"syr",
                     "dateOfBirth"=>"1972-10-08",
                     "citizenshipOfBirth"=>"rus",
                    "bookingId"=>"616297"
            ])
            ->addFile('files', '/Users/superbrodyaga/Sites/public_html/backend/uploads/images/real_photos')
            ->send();
        if ($response->isOk) {
            // $this->e_key = $response->data['E-key'];
            return $response->data['id'];
        }
        else return false;
    }
}