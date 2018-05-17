<?php
/**
 * Created by PhpStorm.
 * User: superbrodyaga
 * Date: 12/13/17
 * Time: 10:58 PM
 */

namespace reception\entities\Image;

use backend\service\Draw;
use reception\entities\Booking\Document;
use reception\entities\Face;
use reception\entities\Image\ImageInterface;
use reception\services\Facematica\FacematicaService;
use function throwException;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
use yiidreamteam\upload\ImageUploadBehavior;
use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;
use Yii;

/**
    Abstract class for operating with images (selfy, images from cameras, images of documets  etc...)

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
 * @property integer  $document_id
 * @property double   $altitude
 * @property double   $longitude
 * @property double   $latitude
 *
 * @property ActiveQuery $faces
 * @property ActiveQuery $album
 *
 * @mixin SaveRelationsBehavior
 * @mixin ImageUploadBehavior
 */


class AbstractImage extends ActiveRecord implements ImageInterface
{
    public const ALBUM_DOCUMENT = 10;
    public const ALBUM_IMAGES = 20;
    public const ALBUM_FACES = 30;



    public const STATUS_CREATED = 10;
    public const STATUS_RECOGNIZED = 40;
    public const STATUS_NO_FACE = 50;
    public const STATUS_ERROR = 5;


    /**
     * @param UploadedFile $file
     * @param null $album_id
     * @param Document $document
     * @param null $booking_id
     * @param null $user_id
     * @return AbstractImage
     */
    public static function create(UploadedFile $file, $album_id = null, Document $document = null, $booking_id = null, $user_id = null)
    {
        $image = new static();
        $image->file_name =  $file;
        $image->date = date("Y-m-d H:i",time());
        $image->album_id = ($album_id) ? $album_id : self::ALBUM_NOT_RECOGNIZE;
        $image->status = self::STATUS_CREATED;
        $image->document_id = $document->id;
        //$image->booking_id = $booking_id;
        $image->user_id = $user_id;
        return $image;
    }

    /**
     * @param Face $face
     * @param $filename
     * @param null $album_id
     * @param null $document_id
     * @param null $user_id
     * @return AbstractImage
     */
    public static function createFaceImage(Face $face=null, $filename=null, $album_id = null, $document_id = null, $user_id = null)
    {
        $image = new static();
        $image->file_name =  $filename;
        $image->type = "image/jpeg";
        $image->date = date("Y-m-d H:i",time());
        $image->album_id = ($album_id) ? $album_id : self::ALBUM_FACES;
        $image->status = self::STATUS_CREATED;
        $image->faces = $face;
        $image->document_id = $document_id;
        $image->user_id = $user_id;
        return $image;
    }

    /**
     * @param $size
     * @param $uploaded
     * @param $type
     * @param $dimensions
     * @param $facematika_id
     * @param $status
     * @param $altitude
     * @param $longitude
     * @param $latitude
     * @return void
     */
    public function edit($size, $uploaded, $type, $dimensions, $facematika_id, $status, $altitude, $longitude, $latitude ):void
    {
        $this->size =  $size;
        $this->uploaded =  $uploaded;
        $this->type =  $type;
        $this->dimensions =  $dimensions;
        $this->facematika_id =  $facematika_id;
        $this->status =  $status;
        $this->altitude =  $altitude;
        $this->longitude =  $longitude;
        $this->latitude =  $latitude;
    }
    


    /**
     * @return false|int|void
     */
    public function delete(){
        $this->delete();
        //проверить удаляется ли файл и, возможно, все связанное с ним
    }

    /**
     * Move file to folder connected with $album_id
     * @param $album_id
     * @return bool
     */
    public function putImageInAlbum($album_id) :bool
    {
        if (is_exist($oldname = $this->getFileName()) ){
            $this->album_id = $album_id;
            return rename($oldname,$this->getFileName());
        }
        return false;
    }

    /**
     * Create new file for detected Face and save it into Image store
     * @param Face $face
     * @param AbstractImage $parent
     * @return string $filename or false
     */
    public function createFileForFace(Face $face, AbstractImage $parent) {
        //определяем геометрические размеры лица
        $faceWidth = $face->width*100/46; //исходим из того, что расстояние между зрачками равно 46% от ширины лица
        $faceWidth *=1.25; // добавляем 25% на резерв
        $faceHeight= $faceWidth*1.5; // высота лица будет больша на 50%
        //координаты и ширина лица
        $x = $face->x  - $faceWidth/2;
        $y = $face->y - $faceHeight/2;

        switch ($this->type) {
            case 'image/jpeg':
                $imageSrc = imagecreatefromjpeg($parent->getFileName());
                break;
            case 'image/png':
                $imageSrc = imagecreatefromjpeg($parent->getFileName());
                break;
        }
        //готовим изображения для заливки картинки с лицом
        $imgDest  =    imagecreatetruecolor ( $faceWidth, $faceHeight );
        //копируем изображение лица в подготовленную область
        $rectangle = imagecopy( $imgDest, $imageSrc, 0, 0, $x, $y , $faceWidth, $faceHeight);
        //сохраняем полученное в файл
        $fileFullName =       Yii::getAlias('@imagePath') . '/' . self::ALBUM_FACES . '/'.$face->face_id.".jpg";
        $result = ($rectangle)?imagejpeg($imgDest, $fileFullName):false;
        imagedestroy($imgDest);
        imagedestroy($imageSrc);
        return ($result)? $face->face_id.".jpg" : false;
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'image';
    }
    /**
     * @inheritdoc
     */
    public function behaviors(): array
    {
        return ArrayHelper::merge(parent::behaviors(),[
            [   'class' => ImageUploadBehavior::className(),
                'attribute' => 'file_name',
                'createThumbsOnRequest' => true,
                'filePath' => ($this->album_id != self::ALBUM_FACES)?'@imagePath/[[attribute_album_id]]/[[id]].[[extension]]':'@imagePath/[[attribute_album_id]]/[[filename]]',
                'fileUrl' => ($this->album_id != self::ALBUM_FACES)?'@imageUrl/[[attribute_album_id]]/[[id]].[[extension]]':'@imagePath/[[attribute_album_id]]/[[filename]]',
                'thumbPath' => '@imagePath/cache/[[profile]]_[[id]].[[extension]]',
                'thumbUrl' => '@imageUrl/cache/[[profile]]_[[id]].[[extension]]',
                'thumbs' => [
                    'thumb' => ['width' => 150, 'height' => 100],
                ],
            ],
            [
                'class' => SaveRelationsBehavior::className(),
                'relations' => ['faces','album','images'],
            ],
        ]);
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
    public function getFaces()
    {
        return $this->hasMany(Face::className(), ['image_id' => 'id']);
    }

    /**
     * Return absolute path/filename to file for this image
     * @return string
     */
    public function getFileName(){
        $path_info = pathinfo($this->file_name);
        $extension = $path_info['extension'];
        //$mime=($this->type)?$this->type: mime_content_type($this->file_name);
        return Yii::getAlias('@imagePath') . '/' . $this->album_id. '/'. $this->id .'.'. $extension ;
    }
    /**
     * Return absolute path/filename to file for this image
     * @return string
     */
    public function getFaceFileUrl(){
        $path_info = pathinfo($this->file_name);
        $extension = $path_info['extension'];
        //$mime=($this->type)?$this->type: mime_content_type($this->file_name);
        return Yii::getAlias('@imageUrl') . '/' . $this->album_id. '/'.$this->file_name ;
    }
    /**
     * Return path to file for this image
     * @return string
     */
    public function getFilePath(){
        return Yii::getAlias('@imagePath') . '/' . $this->album_id. '/';
    }

    public function isRecognized(){
        return ($this->status > 10)? true : false;
    }

}