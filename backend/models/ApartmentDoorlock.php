<?php

namespace backend\models;

use backend\models\query\AparmentDoorlockQuery;
use Yii;

/**
 * This is the model class for table "apartment_doorlock".
 *
 * @property int $doorlock_id
 * @property int $apartment_id
 *
 * @property Apartment $apartment
 * @property DoorLock $doorlock
 */
class ApartmentDoorlock extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'apartment_doorlock';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['doorlock_id', 'apartment_id'], 'required'],
            [['doorlock_id', 'apartment_id'], 'integer'],
            [['apartment_id'], 'exist', 'skipOnError' => true, 'targetClass' => Apartment::className(), 'targetAttribute' => ['apartment_id' => 'id']],
            [['doorlock_id'], 'exist', 'skipOnError' => true, 'targetClass' => DoorLock::className(), 'targetAttribute' => ['doorlock_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'doorlock_id' => 'Doorlock ID',
            'apartment_id' => 'Apartment ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApartment()
    {
        return $this->hasOne(Apartment::className(), ['id' => 'apartment_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDoorlock()
    {
        return $this->hasOne(DoorLock::className(), ['id' => 'doorlock_id']);
    }

    /**
     * @inheritdoc
     * @return AparmentDoorlockQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AparmentDoorlockQuery(get_called_class());
    }
}
