<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "booking".
 *
 * @property integer $id
 * @property string $arrival_date
 * @property string $depature_date
 * @property integer $apartment_id
 * @property integer $number_of_tourist
 * @property integer $guest_id
 *
 * @property Apartment $apartment
 * @property Guest $guest
 */
class Booking extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'booking';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['arrival_date', 'depature_date', 'guest_id'], 'required'],
            [['arrival_date', 'depature_date'], 'safe'],
            [['apartment_id', 'number_of_tourist', 'guest_id'], 'integer'],
            [['apartment_id'], 'exist', 'skipOnError' => true, 'targetClass' => Apartment::className(), 'targetAttribute' => ['apartment_id' => 'id']],
            [['guest_id'], 'exist', 'skipOnError' => true, 'targetClass' => Guest::className(), 'targetAttribute' => ['guest_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'arrival_date' => 'Arrival Date',
            'depature_date' => 'Depature Date',
            'apartment_id' => 'Apartment ID',
            'number_of_tourist' => 'Number Of Tourist',
            'guest_id' => 'Guest ID',
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
    public function getGuest()
    {
        return $this->hasOne(Guest::className(), ['id' => 'guest_id']);
    }
}
