<?php
/**
 * Created by PhpStorm.
 * User: SAS
 * Date: 02.06.17
 * Time: 8:55
 */
namespace backend\service;

use Yii;
use backend\models\PhotoImage;
use backend\models\Face;
use yii\web\ServerErrorHttpException;
class Draw {

    public $photoImage;

    /**
     * Draw constructor.
     * @param $photo
     */
    public function __construct(PhotoImage $photo)
    {
        $this->photoImage = $photo;
    }


    public function DrawRectangleFaceDetected()  {
        $mime = mime_content_type(Yii::getAlias('@imagePath').'/'.$this->photoImage->file_name);
        if ($mime == 'image/jpeg') {
            $imageSrc = imagecreatefromjpeg(Yii::getAlias('@imagePath') . '/' . $this->photoImage->file_name);
        }
        elseif ($mime == 'image/png') {
            $imageSrc = imagecreatefrompng(Yii::getAlias('@imagePath') . '/' . $this->photoImage->file_name);
        }
        elseif ($mime == 'image/bmp') {
            $imageSrc = imagecreatefromwbmp(Yii::getAlias('@imagePath') . '/' . $this->photoImage->file_name);
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
        $faceHieght= $faceWidth*1.4; // высота лица будет больша на 40%

        //координаты и ширина лица

         $x = $face->x  - $faceWidth/2; //+$face->width/2
         $y = $face->y - $faceHieght/2;

        //создаем файл или октрываем существующий для изменения
//        $info = new SplFileInfo(Yii::getAlias('@imagePath').'/'.$this->photoImage->file_name);
        $mime = mime_content_type(Yii::getAlias('@imagePath').'/'.$this->photoImage->file_name);
        if ($mime == 'image/jpeg') {
            $imageSrc = imagecreatefromjpeg(Yii::getAlias('@imagePath') . '/' . $this->photoImage->file_name);
        }
        elseif ($mime == 'image/png') {
            $imageSrc = imagecreatefrompng(Yii::getAlias('@imagePath') . '/' . $this->photoImage->file_name);
        }
        elseif ($mime == 'image/bmp') {
            $imageSrc = imagecreatefromwbmp(Yii::getAlias('@imagePath') . '/' . $this->photoImage->file_name);
        }
        else {
            throw new ServerErrorHttpException('Unknown file mime type.');
        }
        //рисуем рамку
        $imgDest  =    imagecreatetruecolor ( $faceWidth, $faceHieght );
        $rectangle = imagecopy( $imgDest, $imageSrc, 0, 0, $x, $y , $faceWidth, $faceHieght);
        return ($rectangle)?$imgDest:false;
    }
}