<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "key".
 *
 * @property integer $id
 * @property string $from
 * @property string $till
 * @property integer $pin
 * @property string $e_key
 * @property integer $booking_id
 *
 * @property Booking $booking
 */
class Key extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'key';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pin', 'booking_id'], 'integer'],
            [['from', 'till'], 'string', 'max' => 20],
            [['e_key'], 'string', 'max' => 15],
            [['booking_id'], 'exist', 'skipOnError' => true, 'targetClass' => Booking::className(), 'targetAttribute' => ['booking_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'from' => Yii::t('app', 'From'),
            'till' => Yii::t('app', 'Till'),
            'pin' => Yii::t('app', 'Pin'),
            'e_key' => Yii::t('app', 'E Key'),
            'booking_id' => Yii::t('app', 'Booking ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBooking()
    {
        return $this->hasOne(Booking::className(), ['id' => 'booking_id']);
    }
}
