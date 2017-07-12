<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 28.06.17
 * Time: 20:23
 */
use yii\httpclient\Client;

class DocumentRecognition
{
    private $documentImage;

    /**
     * DocumentRecognition constructor.
     * @param $documentImage
     */
    public function __construct(\backend\models\PhotoImage $documentImage)
    {
        $this->documentImage = $documentImage;
        $this->recognize();
    }

    public function recognize()
    {
        $imagePathName = Yii::getAlias('@imagePath').'/'.$this->documentImage->file_name;
        $client = $client = new Client();
        $response = $client->createRequest()
            ->setMethod('post')
            ->setHeaders(['apikey' => 'de07a1dc5088957'])
            ->setUrl('https://api.ocr.space/Parse/Image')
            ->setData(['language' =>"hrv","isOverlayRequired"=>true])
            ->addFile('file', $imagePathName)
            ->send();
        return $response;
    }
}