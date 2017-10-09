<?php
/**
 * Created by PhpStorm.
 * User: superbrodyaga
 * Date: 10/4/17
 * Time: 10:01 PM
 */


namespace reception\entities\Booking;
use reception\Face;


/**
 * This is the model class for table "face".
 *
 * @property integer $id
 * @property string $face_id
 * @property double $x
 * @property double $y
 * @property double $width
 * @property double $angle
 * @property integer $photo_document_id
 * @property integer $photo_image_id
 * @property integer $face_image_id
 * @property integer isChecked
 *
 * @property PhotoImage $faceImage
 */
class RealFace extends Face
{

    public static function create($face_id,$x,$y,$width,$angle,$photoImage): self
    {
        $face = new static();
        $face->face_id = $face_id;
        $face->x = $x;
        $face->y = $y;
        $face->width = $width;
        $face->angle = $angle;
        $face->photo_image_id = $photoImage->id;

        return $face;

    }

    public function edit(Face $face, $face_id,$x,$y,$width, $angle, $photoImage): self
    {
        $face->face_id = $face_id;
        $face->x = $x;
        $face->y = $y;
        $face->width = $width;
        $face->angle = $angle;
        $face->photo_image_id = $photoImage->id;
//        $face->photo_document_id = $photo_document_id;

        return $face;
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhotoImage()
    {
        return $this->hasOne(Photo::className(), ['id' => 'photo_image_id']);
    }
}
