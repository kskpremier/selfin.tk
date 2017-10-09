<?php
/**
 * Created by PhpStorm.
 * User: superbrodyaga
 * Date: 10/4/17
 * Time: 10:06 PM
 */
/**
 * This is the model class for table "face_comparation".
 *
 * @property integer $origin_id
 * @property string $face_id
 * @property double $probability
 * @property string $created_at
 *
 * @property Face $origin
 * @property ActiveQuery $face
 */
namespace reception\entities\Booking;


use reception\entities\Face;

class FaceComparation extends \yii\db\ActiveRecord
{
//    public $face_id;
//    public $origin_id;
//    public $probability;
//    public $created_at;

    /**
     * @inheritdoc
     */

    public static function create($origin_id, $face_id, $probability): self
    {
        $faceComparation = FaceComparation::find()->where([
            'origin_id'=>$origin_id,
            'face_id'=>$face_id,
        ])->one();
        if (!isset($faceComparation)) {
            $faceComparation = new static();
            $faceComparation->face_id = $face_id;
            $faceComparation->origin_id = $origin_id;
            $faceComparation->probability = $probability;
            $faceComparation->created_at = date('Y-m-d H:i:s', time());
        }
        return $faceComparation;
    }
    public function edit()
    {
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'face_comparation';
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrigin()
    {
        return $this->hasOne(Face::className(), ['id' => 'origin_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFace()
    {
        return $this->hasOne(Face::className(), ['id' => 'face_id']);
    }

    public static function isMatched(Face $face, Face $faceImage) {
        $faceComparation = FaceComparation::find()->where(['origin_id'=>$faceImage->id, 'face_id'=>$face->face_id])
            ->orWhere(['origin_id'=>$face->id, 'face_id'=>$faceImage->face_id])
            ->all();
        return isset($faceComparation);
    }
}
