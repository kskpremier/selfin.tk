<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "door_lock".
 *
 * @property integer $id
 * @property integer $admin_pin
 * @property string $type
 *
 * @property Apartment[] $apartments
 */
class DoorLock extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'door_lock';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['admin_pin'], 'integer'],
            [['type'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'admin_pin' => 'Admin Pin',
            'type' => 'Type',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApartments()
    {
        return $this->hasMany(Apartment::className(), ['door_lock_id' => 'id']);
    }
}
