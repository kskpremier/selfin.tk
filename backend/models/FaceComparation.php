<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "face_comparation".
 *
 * @property integer $origin_id
 * @property string $face_id
 * @property double $probability
 * @property string $created_at
 *
 * @property Face $origin
 */
class FaceComparation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'face_comparation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['origin_id', 'face_id'], 'required'],
            [['origin_id'], 'integer'],
            [['probability'], 'safe'],
            [['created_at'], 'safe'],
            [['face_id'], 'string', 'max' => 255],
            [['origin_id'], 'exist', 'skipOnError' => true, 'targetClass' => Face::className(), 'targetAttribute' => ['origin_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'origin_id' => Yii::t('app', 'Origin ID'),
            'face_id' => Yii::t('app', 'Face ID'),
            'probability' => Yii::t('app', 'Probability'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrigin()
    {
        return $this->hasOne(Face::className(), ['id' => 'origin_id']);
    }

    public static function isMatched(Face $face, Face $faceImage) {

            $faceComparation = FaceComparation::find()->where(['origin_id'=>$faceImage->id, 'face_id'=>$face->face_id])
                                        ->orWhere(['origin_id'=>$face->id, 'face_id'=>$faceImage->face_id])
                                        ->all();
            return isset($faceComparation);
    }
}
