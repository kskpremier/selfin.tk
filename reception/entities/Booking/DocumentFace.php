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
class DocumentFace extends Face
{

    public static function create($face_id,$x,$y,$width,$angle,$documentPhoto): self
    {
        $face = new static();
        $face->face_id = $face_id;
        $face->x = $x;
        $face->y = $y;
        $face->width = $width;
        $face->angle = $angle;
        $face->photo_document_id = $documentPhoto->id;
        return $face;

    }
    public function edit(Face $face, $face_id,$x,$y,$width, $angle, $documentPhoto ): self
    {
        $face->face_id = $face_id;
        $face->x = $x;
        $face->y = $y;
        $face->width = $width;
        $face->angle = $angle;
        $face->photo_document_id = $documentPhoto->id;
        return $face;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocumentImage()
    {
        return $this->hasOne(DocumentPhoto::className(), ['id' => 'photo_document_id']);
    }

}
