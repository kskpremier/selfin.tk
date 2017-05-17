<?php

namespace backend\models;
use yii\httpclient\Client;
use common\models\User;

use Yii;

/**
 * This is the model class for table "photo_image".
 *
 * @property integer $id
 * @property string $date
 * @property integer $camera_id
 * @property integer $album_id
 * @property string $file_name
 * @property integer $booking_id
 * @property integer $user_id
 *
 * @property Album $album
 * @property PhotoRealFace[] $photoRealFaces
 */
class PhotoImage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'photo_image';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['booking_id','album_id'], 'safe'],
            [['date'], 'safe'],
            [['camera_id', 'album_id','user_id','booking_id'], 'integer'],
            [['file_name'], 'string', 'max' => 255],
            [['album_id'], 'exist', 'skipOnError' => true, 'targetClass' => Album::className(), 'targetAttribute' => ['album_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Date',
            'camera_id' => 'Camera ID',
            'album_id' => 'Album ID',
            'file_name' => 'File Name',
        ];
    }

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
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBooking()
    {
        return $this->hasOne(Booking::className(), ['id' => 'booking_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCamera()
    {
        return $this->hasOne(Camera::className(), ['id' => 'camera_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhotoRealFaces()
    {
        return $this->hasMany(PhotoRealFace::className(), ['photo_image_id' => 'id']);
    }

    public function behaviors()
    {
        return [
            'image' => [
                'class' => 'rico\yii2images\behaviors\ImageBehave',
            ]
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
            'file_name'=>'file_name',
            'album' => 'album_id',
            'uploaded'=> 'date',
            'booking'=>'booking_id',
            'user'=>'user_id'
        ];
    }

    /*
* Этот вызов будет дергать наш api контроллер и добавлять фотку
* */
    public function postPhotoImage(){
        //тут надо сформировать запрос и послать его на китайский рестапи

        $imagePath = Yii::getAlias('@imagePath').'/'.$this->file_name;
        $client = $client = new Client();
        $response = $client->createRequest()
                            ->setMethod('post')
                            ->setHeaders(['Authorization' => 'Bearer cWADri54WVNIs_ammPUDmwQSuuhDTw6-'])
                            ->setUrl('http://api.domouprav.local/photoimage')
                            ->setData(['user_id' => $this->user_id,
                                'album_id' =>$this->album_id,
                                'booking_id' =>$this->booking_id,
                                'file_name'=>$this->file_name])
                            ->addFile($this->file_name, $imagePath)
                            ->send();
        if ($response->isOk) {
//            $this-> = $response->data['E-key'];
            return true;
        }
        else return false;
    }
}
