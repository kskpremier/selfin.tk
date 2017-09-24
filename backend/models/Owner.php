<?php

namespace backend\models;

use Yii;
use reception\entities\User\User;

/**
 * This is the model class for table "owner".
 *
 * @property integer $id
 * @property string $external_id
 * @property integer $user_id
 *
 * @property Apartment[] $apartments
 * @property Users $user
 */
class Owner extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'owner';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['external_id'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'external_id' => 'External ID',
            'user_id' => 'User ID',

        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApartments()
    {
        return $this->hasMany(Apartment::className(), ['owner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }
}
