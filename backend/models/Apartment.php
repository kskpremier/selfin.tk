<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "apartment".
 *
 * @property integer $id
 * @property string $location
 * @property string $name
 *
 * @property Booking[] $bookings
 * @property Camera[] $cameras
 * @property DoorLock[] $doorLocks
 */
class Apartment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'apartment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['location', 'name'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'location' => Yii::t('app', 'Location'),
            'name' => Yii::t('app', 'Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookings()
    {
        return $this->hasMany(Booking::className(), ['apartment_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCameras()
    {
        return $this->hasMany(Camera::className(), ['apartment_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDoorLock()
    {
        return $this->hasOne(DoorLock::className(), ['apartment_id' => 'id']);
    }
}
