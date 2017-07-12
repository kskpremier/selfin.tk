<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "booking_guest".
 *
 * @property integer $booking_id
 * @property integer $guest_id
 *
 * @property Booking $booking
 * @property Guest $guest
 */
class BookingGuest extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'booking_guest';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['booking_id', 'guest_id'], 'required'],
            [['booking_id', 'guest_id'], 'integer'],
            [['booking_id'], 'exist', 'skipOnError' => true, 'targetClass' => Booking::className(), 'targetAttribute' => ['booking_id' => 'id']],
            [['guest_id'], 'exist', 'skipOnError' => true, 'targetClass' => Guest::className(), 'targetAttribute' => ['guest_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'booking_id' => 'Booking ID',
            'guest_id' => 'Guest ID',
        ];
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
    public function getGuest()
    {
        return $this->hasOne(Guest::className(), ['id' => 'guest_id']);
    }
}
