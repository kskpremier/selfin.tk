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
 * @property integer $lock_id
 * @property string $lock_mac
 * @property string $lock-alias
 * @property string $lock_name
 * @property integer $electric_quantity
 * @property string $last_update_date
 *
 * @property Apartment $apartment
 * @property Key[] $keys
 * @property KeyboardPwd[] $keyboardPwds
 * @property LockVersion[] $lockVersions
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
            [['type', 'lock_mac', 'lock-alias', 'lock_name'], 'string', 'max' => 255],
            [['admin_pin', 'apartment_id', 'lock_id', 'electric_quantity'], 'integer'],
            [['last_update_date'], 'safe'],
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
            'lockId' => Yii::t('app', 'lockId'),
            'admin_pin' => Yii::t('app', 'Admin Pin'),
            'type' => Yii::t('app', 'Type'),
            'apartment_id' => Yii::t('app', 'Apartment ID'),
            'lock_id' => Yii::t('app', 'Lock ID'),
           'lock_mac' => Yii::t('app', 'Lock Mac'),
           'lock-alias' => Yii::t('app', 'Lock Alias'),
           'lock_name' => Yii::t('app', 'Lock Name'),
           'electric_quantity' => Yii::t('app', 'Electric Quantity'),
           'last_update_date' => Yii::t('app', 'Last Update Date'),
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
     * @return \yii\db\ActiveQuery
     */
    public function getKeys()
    {
        return $this->hasMany(Key::className(), ['door_lock_id' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLockVersions() {
        return $this->hasMany(LockVersion::className(), ['door_lock_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKeyboardPwds()
    {
        return $this->hasMany(KeyboardPwd::className(), ['door_lock_id' => 'id']);
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
            'lockId'=>'lockId'
        ];
    }
}
