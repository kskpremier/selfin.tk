<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "door_lock".
 *
 * @property integer $id
 * @property integer $admin_pin
 * @property string $type
 * @property integer $apartment_id
 *
 * @property Apartment $apartment
 * @property Token[] $tokens
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
            [['admin_pin', 'apartment_id'], 'integer'],
            [['type'], 'string', 'max' => 255],
            [['apartment_id'], 'exist', 'skipOnError' => true, 'targetClass' => Apartment::className(), 'targetAttribute' => ['apartment_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'admin_pin' => Yii::t('app', 'Admin Pin'),
            'type' => Yii::t('app', 'Type'),
            'apartment_id' => Yii::t('app', 'Apartment ID'),
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
    public function getTokens()
    {
        return $this->hasMany(Token::className(), ['door_lock_id' => 'id']);
    }
    /**
     * For REST/API controller
     * @return array
     */
    public function fields()
    {
        return [
            'id' => 'id',
            'admin_pin'=>'admin_pwd',
            'apartment_id'=>'apartment_id',
            'type' => 'type',

        ];
    }
}
