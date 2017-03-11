<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "apartment".
 *
 * @property integer $id
 * @property string $location
 * @property string $name
 * @property integer $door_lock_id
 * @property integer $camera_id
 *
 * @property Camera $camera
 * @property DoorLock $doorLock
 * @property Booking[] $bookings
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
            [['location', 'name'], 'safe'],
            [['door_lock_id', 'camera_id'], 'required'],
            [['door_lock_id', 'camera_id'], 'integer'],
            [['camera_id'], 'exist', 'skipOnError' => true, 'targetClass' => Camera::className(), 'targetAttribute' => ['camera_id' => 'id']],
            [['door_lock_id'], 'exist', 'skipOnError' => true, 'targetClass' => DoorLock::className(), 'targetAttribute' => ['door_lock_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'location' => 'Location',
            'name' => 'Name',
            'door_lock_id' => 'Door Lock ID',
            'camera_id' => 'Camera ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCamera()
    {
        return $this->hasOne(Camera::className(), ['id' => 'camera_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDoorLock()
    {
        return $this->hasOne(DoorLock::className(), ['id' => 'door_lock_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookings()
    {
        return $this->hasMany(Booking::className(), ['apartment_id' => 'id']);
    }
}
