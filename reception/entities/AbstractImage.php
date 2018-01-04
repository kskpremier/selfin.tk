<?php

namespace reception\entities;

use reception\entities\Image\Album;
use backend\service\Draw;
use reception\entities\Booking\FaceComparation;
use reception\entities\Face;
use backend\service\FACEMATIKA;
use reception\entities\Booking\DocumentPhoto;
use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;
use reception\entities\ImageInterface;
use reception\services\WaterMarker;
use yii\db\ActiveRecord;
use yii\httpclient\Client;
use reception\entities\User\User;
use yiidreamteam\upload\ImageUploadBehavior;
use yii\web\ServerErrorHttpException;
//use Yii;

/**

 * @property integer  $id
 * @property string   $date
 * @property integer  $album_id
 * @property string   $file_name
 * @property integer  $status
 * @property integer  $user_id
 * @property integer  $size
 * @property string   $uploaded
 * @property string   $type
 * @property string   $dimensions
 * @property string   $facematika_id
 * @property int   $document_id
 * @property double   $altitude
 * @property double   $longitude
 * @property double   $latitude
 *
 * @property ActiveQuery $faces
 * @property ActiveQuery $user
 * @property ActiveQuery $album
 *
 * @mixin SaveRelationsBehavior
 */

abstract class AbstractImage  extends ActiveRecord implements ImageInterface
{
//    public $file_name ;
//    public $user_id;
//    public $date;
//    public $album_id;
//    public $status;
//    public $size;
//    public $uploaded;
//    public $type;
//    public $dimensions;
//    public $facematika_id;
//    public $altitude;
//    public $longitude;
//    public $latitude;
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlbum()
    {
        return $this->hasOne(Album::className(), ['id' => 'album_id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne( User::className(), ['id' => 'user_id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    abstract public function getFaces();

    public function behaviors(): array
    {
        return [
            //   MetaBehavior::className(),
            [
                'class' => SaveRelationsBehavior::className(),
                'relations' => ['faces','document','booking'],
            ],
        ];
    }

    /**
     * For REST/API controller
     * @return array
     */
    public function fields()
    {
        return [
            'id' => 'id',
            //'filePath'=> $this->getImagePath(),//Yii::getAlias('@imagePath').'/'.$this->album_id.'/'.$this->booking_id.'/'.$this->id.'.jpg',
            'url'=> $this->getImageUrl(),
            'upload'=> 'date',
        ];
    }
/**
 * Using Facematica service detect all faces on Image , create sets of Face with new image of face, link them all with Image
 * @return array
 * */

    public function extractFace() : array //
    {
        $faces=[];
        $document = ($this instanceof DocumentPhoto)? true: false;
        //вызов сервиса фейсматики для определения лиц на фотографии
        $respond=$this->detectFace($this->getFileName());
        if ( is_array($data = json_decode($respond->content, true)) && !array_key_exists('ErrorCode', $data)) {
                    $this->size = $data['filename']['size'];
                    $this->dimensions = $data['filename']['dimensions'];
                    $this->uploaded = $data['filename']['uploaded'];
                    $this->facematika_id = $data['filename']['id'];
                    $this->status = ImageInterface::IMAGE_RECOGNIZED;
                    //создаем записи в таблице лиц
                    foreach ($data['filename']['faces'] as $face) {
                        $newFace = Face ::create (
                            $face['faceid'], $face['faceid'] . '.jpg', $face['coordinates']['x'], $face['coordinates']['y'], $face['coordinates']['width'], $face['coordinates']['angle'], ($document) ? $this : null);
                        //вырезание квадрата лица в новый Image
                        $draw = new Draw($this,$document,$this->getFileName(),mime_content_type($this->getFileName()));
                        $face_image = $draw->getFaceRectangleImage($newFace);
                        $this->status = (imagejpeg($face_image, $newFace->getImageNameWithPath()))?ImageInterface::IMAGE_RECOGNIZED:ImageInterface::IMAGE_RAW;
                        imagedestroy($face_image);
                        $faces[] = $newFace;
                    }
                    //сохраняем связь Image и Faces
                    $this->faces = $faces;
        } else throw new ServerErrorHttpException('Wrong result of face recognition =>' . $respond);
        return $this->faces;
    }
    public function  getTheMostSimilarFaceMatchedProbability($image, $repositoryComparation) {
        $probability = 0;
        foreach ($this->faces as $face){
            foreach ($image->faces as $imageFace)
                $comparation = $repositoryComparation->findMax($face->id, $imageFace->face_id);
            if ($comparation && $comparation->probability < $probability)
                $probability = $comparation->probability;
        }
        return $probability;
    }

    /**
     * @param $filename
     * @return mixed
     */
    public function detectFace(string $filename)
    {
        $token  = FACEMATIKA::token();
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('post')
            ->setUrl(FACEMATIKA::FACEMATIKA_URL_TO_FACE_DETECT)
            ->setHeaders([
                'Authorization: bearer '. $token,
                'Content-Type: multipart/form-data;'])
            ->addFile('filename', $filename)
            ->send();
        return $response;
    }

    public function faceMatch(array $listOfFaces)
    {
        $result=[];
        foreach ($this->faces as $originFace) {
            $post = '[';
            foreach ($listOfFaces as $face) {
                $face_string = '{"faceid":"' . $face->face_id . '"}';
                $post .= $face_string;
                $post .= ',';
            }
            $token = FACEMATIKA::token();
            $post = substr($post, 0, -1);
            $post .= ']';
            $client = new Client();
            $response = $client->createRequest()
                ->setMethod('post')
                ->setUrl(FACEMATIKA::FACEMATIKA_URL_TO_FACE_MATCH . '/' . $originFace->face_id . '/match')
                ->setHeaders([
                    'Authorization: bearer ' . $token,
                    'Content-Type: application/json'])
                ->setContent($post)
                ->send();
            $result[] = $response->content;
        }
        return $result;
    }
}