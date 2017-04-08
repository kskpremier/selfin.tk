<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "token".
 *
 * @property integer $id
 * @property string $token
 * @property integer $expires
 * @property string $type
 * @property integer $door_lock_id
 *
 * @property DoorLock $doorLock
 */
class Token extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'token';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['token', 'expires', 'type'], 'required'],
            [['expires', 'door_lock_id'], 'integer'],
            [['token', 'type'], 'string', 'max' => 255],
            [['door_lock_id'], 'exist', 'skipOnError' => true, 'targetClass' => DoorLock::className(), 'targetAttribute' => ['door_lock_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'token' => Yii::t('app', 'Token'),
            'expires' => Yii::t('app', 'Expires'),
            'type' => Yii::t('app', 'Type'),
            'door_lock_id' => Yii::t('app', 'Door Lock ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDoorLock()
    {
        return $this->hasOne(DoorLock::className(), ['id' => 'door_lock_id']);
    }
}
