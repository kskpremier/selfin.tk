<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 02.06.17
 * Time: 8:55
 */
namespace backend\service;

use reception\entities\ImageInterface;
use Yii;
use backend\models\PhotoImage;
use reception\entities\Face;
use yii\web\ServerErrorHttpException;
class Draw {

    public $photoImage;
    public $mime;
    public $filename;

    /**
     * Draw constructor.
     * @param $photo
     */
    public function __construct(ImageInterface $photo, $document=null, $filename=null, $mime=null)
    {
        $this->photoImage = $photo;
        $this->filename = $filename;
        $this->mime = $mime;
    }


    public function DrawRectangleFaceDetected()  {
        $mime = ($this->mime)?$this->mime : mime_content_type(Yii::getAlias('@imagePath').'/'.$this->photoImage->file_name);
        if ($mime == 'image/jpeg') {
            $imageSrc = imagecreatefromjpeg($this->filename);
        }
        elseif ($mime == 'image/png') {
            $imageSrc = imagecreatefrompng($this->filename);
        }
        elseif ($mime == 'image/bmp') {
            $imageSrc = imagecreatefromwbmp($this->filename);
        }
        else {
            throw new ServerErrorHttpException('Unknown file mime type.');
        }
        //рисуем рамку

        // рисуем рамки вокруг лиц - пока не умею определять цвет
        foreach($this->photoImage->faces as $face ) {
            imageLine($imageSrc, $face->x, $face->y, $face->x + $face->width - 1, $face->y, 200);
        }
        return imagesavealpha($imageSrc,true);
    }

    public function getFaceRectangleImage(Face $face) {
        //определяем геометрические размеры лица
        $faceWidth = $face->width*100/46; //исходим из того, что расстояние между зрачками равно 46% от ширины лица
        $faceWidth *=1.15; // добавляем 15% на резерв
        $faceHeight= $faceWidth*1.4; // высота лица будет больша на 40%
        //координаты и ширина лица
         $x = $face->x  - $faceWidth/2; //+$face->width/2
         $y = $face->y - $faceHeight/2;

        //создаем файл или октрываем существующий для изменения
        $mime = ($this->mime)?$this->mime : mime_content_type($this->photoImage->getThumbFilePath('file_name'));

        if ($mime == 'image/jpeg') {
            $imageSrc = imagecreatefromjpeg($this->filename);
        }
        elseif ($mime == 'image/png') {
            $imageSrc = imagecreatefrompng($this->filename);
        }
        elseif ($mime == 'image/bmp') {
            $imageSrc = imagecreatefromwbmp($this->filename);
        }
        else {
            throw new ServerErrorHttpException('Unknown file mime type.');
        }
        //рисуем рамку и заливаем туда лицо
        $imgDest  =    imagecreatetruecolor ( $faceWidth, $faceHeight );
        $rectangle = imagecopy( $imgDest, $imageSrc, 0, 0, $x, $y , $faceWidth, $faceHeight);
        return ($rectangle)? $imgDest: false;
    }
}